<?php

namespace App\Mcp\Tools;

use App\Mcp\Tools\Concerns\TeachersOnly;
use App\Models\Material;
use App\Support\MaterialAccess;
use App\Support\MaterialPayload;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Facades\Storage;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Title;
use Laravel\Mcp\Server\Tool;

#[Name('get_material')]
#[Title('Get one material')]
#[Description('Read one material: its details plus the text for a plain-text file, or a short-lived signed download URL for anything else.')]
class GetMaterial extends Tool
{
    use TeachersOnly;

    /**
     * A bounded read: one call must not be able to spend a model's whole
     * context, and the app must not hold a whole file in memory.
     */
    public const MAX_TEXT_BYTES = 200_000;

    public function handle(Request $request): Response|ResponseFactory
    {
        $teacher = $this->teacherOr($request);

        if ($teacher instanceof Response) {
            return $teacher;
        }

        $material = Material::find((int) $request->get('id'));

        // A hidden material and a missing one are indistinguishable, the
        // same rule the HTTP surface follows.
        if ($material === null || ! MaterialAccess::canView($teacher, $material)) {
            return Response::error('Not found.');
        }

        $payload = MaterialPayload::summary($material) + ['description' => $material->description];

        if ($material->mime_type === 'text/plain') {
            $disk = Storage::disk(config('materials.disk'));
            $stream = $disk->exists($material->path) ? $disk->readStream($material->path) : null;

            if (! is_resource($stream)) {
                return Response::error('Not found.');
            }

            // Read a few bytes past the cap: mb_strcut() only trims a
            // trailing partial character when the source is LONGER than the
            // target length, so a buffer capped at exactly MAX_TEXT_BYTES
            // would let an incomplete multibyte sequence through unchanged.
            // The longest UTF-8 character is 4 bytes.
            $buffer = (string) fread($stream, self::MAX_TEXT_BYTES + 4);
            fclose($stream);

            // mb_strcut, not substr: the read may have stopped in the
            // middle of a multibyte character.
            $text = mb_strcut($buffer, 0, self::MAX_TEXT_BYTES, 'UTF-8');

            // mb_strcut only fixes a split character; it does nothing for
            // bytes that were never valid UTF-8 (finfo happily calls a
            // latin-1 .txt file text/plain). Response::structured() json
            // encodes with JSON_THROW_ON_ERROR, so invalid sequences must be
            // dropped here rather than surfacing as a thrown exception.
            $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');

            return Response::structured($payload + [
                'text' => $text,
                // The buffer was read with +4 bytes of headroom, so a
                // full-length read (plus anything beyond it) means the file
                // was longer than the cap. size_bytes is not used here: it
                // reflects the whole file, not what mb_strcut kept.
                'truncated' => strlen($buffer) > self::MAX_TEXT_BYTES,
            ]);
        }

        return Response::structured($payload + [
            // C2's signed URL: 15 minutes, viewer = this teacher, and the
            // permissions are re-evaluated when it is used.
            'download_url' => MaterialPayload::downloadUrl($material, $teacher),
        ]);
    }

    /** @return array<string, \Illuminate\JsonSchema\Types\Type> */
    public function schema(JsonSchema $schema): array
    {
        return [
            'id' => $schema->integer()
                ->required()
                ->description('The material id, from list_materials.'),
        ];
    }
}

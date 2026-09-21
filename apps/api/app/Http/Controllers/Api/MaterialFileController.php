<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\User;
use App\Support\MaterialAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * The signed, viewer-bound, 15-minute download link. No `auth`, no `active`:
 * the signed `viewer` parameter IS the identity, re-evaluated against the
 * CURRENT row and connection state on every use, so unpublishing, unsharing,
 * disconnecting and deleting all revoke it within its lifetime.
 *
 * `int $material`, NOT `Material $material`, on purpose. `ValidateSignature`
 * is not in the framework's middleware priority list, so with a bound model
 * `SubstituteBindings` would run FIRST and a tampered probe would get 404 for
 * a missing id and 403 for an existing one -- the /admin/users/{user} oracle
 * that bootstrap/app.php exists to prevent. Binding is done here, by hand,
 * after the signature has been checked.
 */
class MaterialFileController extends Controller
{
    public function __invoke(Request $request, int $material): StreamedResponse
    {
        $viewer = $this->viewer($request);

        $model = Material::find($material);
        abort_if($model === null, 404);
        MaterialAccess::assertViewer($viewer, $model);

        $disk = Storage::disk(config('materials.disk'));

        // download() computes Content-Length with an unguarded size() call, so
        // a file removed out of band would 500 -- with the storage path in the
        // message under APP_DEBUG -- instead of 404ing.
        abort_unless($disk->exists($model->path), 404);

        return $disk->download($model->path, $model->original_name, [
            'Content-Type' => $model->mime_type,
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    /**
     * `viewer=0` means logged out. A deactivated viewer resolves to null as
     * well: a deactivated account is a guest here, which still reaches public
     * materials but never a shared one.
     */
    private function viewer(Request $request): ?User
    {
        $id = (int) $request->query('viewer', 0);

        if ($id <= 0) {
            return null;
        }

        $user = User::find($id);

        return $user?->isActive() ? $user : null;
    }
}

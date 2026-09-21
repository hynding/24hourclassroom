<?php

namespace App\Http\Requests;

use App\Enums\GradeLevel;
use App\Enums\Role;
use App\Enums\Subject;
use App\Support\MaterialAccess;
use App\Support\MaterialQuota;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

/**
 * One class for create and update, following SaveTestRequest.
 *
 * `authorize()` runs AFTER prepareForValidation() but BEFORE the rules, so it
 * is the only hook that can keep a malformed body from producing a 422 before
 * the role is settled. On update a `material` is route-bound and ownership was
 * already asserted as 404/403 in prepareForValidation, so `true`.
 */
class SaveMaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->route('material')) {
            return true;
        }

        return $this->user()?->role === Role::Teacher;
    }

    public function rules(): array
    {
        $rules = [
            'description' => ['nullable', 'string', 'max:5000'],
            'subject' => ['required', Rule::enum(Subject::class)],
            'grade_level' => ['required', Rule::enum(GradeLevel::class)],
        ];

        if ($this->route('material')) {
            // Metadata only. A posted `file` part is simply not a rule here,
            // so it is ignored and the stored file is never touched.
            return $rules + ['title' => ['required', 'string', 'max:160']];
        }

        return $rules + [
            'title' => ['nullable', 'string', 'max:160'],
            // `bail` matters: an UPLOAD_ERR_INI_SIZE upload fails every one of
            // these at once, and without it errors.file is a five-element
            // array instead of the one message the SPA renders.
            'file' => [
                'bail',
                'required',
                'file',
                'extensions:'.implode(',', config('materials.extensions')),
                'mimetypes:'.implode(',', config('materials.mimetypes')),
                'max:'.config('materials.max_file_kb'),
            ],
        ];
    }

    /**
     * Built from the config value, never hardcoded. An upload over
     * upload_max_filesize arrives as an invalid UploadedFile; the validator
     * short-circuits it into the implicit "uploaded" rule before
     * required/file/extensions run, so that key carries the size message.
     */
    public function messages(): array
    {
        $mb = intdiv((int) config('materials.max_file_kb'), 1024);

        return [
            'file.required' => "Choose a file under {$mb} MB.",
            'file.max' => "Choose a file under {$mb} MB.",
            'file.file' => "Choose a file under {$mb} MB.",
            'file.uploaded' => "Choose a file under {$mb} MB.",
            'file.extensions' => 'That file type is not supported.',
            'file.mimetypes' => 'That file type is not supported.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Ownership before validation: a non-author must get 404 (private) or
        // 403 (public), never a 422 that confirms the route exists for them.
        if ($material = $this->route('material')) {
            MaterialAccess::assertAuthor($this->user(), $material);
        }
    }

    /** The friendly quota pass. The authoritative one is inside the store transaction. */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($this->route('material') || $validator->errors()->has('file')) {
                return;
            }

            $file = $this->file('file');
            if (! $file instanceof UploadedFile || ! $file->isValid()) {
                return;
            }

            if ($error = MaterialQuota::errorFor($this->user(), (int) $file->getSize())) {
                $validator->errors()->add('file', $error);
            }
        });
    }
}

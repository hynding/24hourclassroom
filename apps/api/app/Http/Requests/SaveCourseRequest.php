<?php

namespace App\Http\Requests;

use App\Enums\GradeLevel;
use App\Enums\Role;
use App\Enums\Subject;
use App\Enums\Visibility;
use App\Models\Material;
use App\Models\Test;
use App\Support\CourseAccess;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class SaveCourseRequest extends FormRequest
{
    public const MAX_ITEMS = 300;

    /**
     * The same split as SaveTestRequest: on update, ownership was asserted
     * as a 404 in prepareForValidation(); on create, an allowlisted
     * non-teacher gets 403 before the rules ever look at the body.
     */
    public function authorize(): bool
    {
        if ($this->route('course')) {
            return true;
        }

        return $this->user()?->role === Role::Teacher;
    }

    protected function prepareForValidation(): void
    {
        if ($this->route('course')) {
            CourseAccess::assertAuthor($this->user(), $this->route('course'));
        }
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string', 'max:5000'],
            'subject' => ['required', Rule::enum(Subject::class)],
            'grade_level' => ['required', Rule::enum(GradeLevel::class)],
            'items' => ['present', 'array', 'max:'.self::MAX_ITEMS],
            'items.*' => ['array'],
            'items.*.kind' => ['required', Rule::in(['test', 'material'])],
            'items.*.id' => ['required', 'integer'],
            'items.*.section' => ['nullable', 'string', 'max:160'],
        ];
    }

    /**
     * Ownership and duplicates, per item. One message for "not yours" and
     * "does not exist": a distinguishable error would let a teacher walk
     * the id space for other people's private tests.
     *
     * The one exception to "your own": a material that is ALREADY in this
     * course and is another teacher's public one -- what a branch keeps from
     * its original. It can be kept, moved or removed, never newly added
     * here, and only while it would still be shown (CourseAccess::showsItem).
     *
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->isNotEmpty()) {
                    return;
                }

                $items = (array) $this->input('items', []);
                $owner = $this->user()->id;
                $ids = fn (string $kind) => collect($items)->where('kind', $kind)->pluck('id')->map(fn ($id) => (int) $id)->all();
                $kept = $this->route('course')
                    ? Material::query()
                        ->whereIn('id', $this->route('course')->items()->reorder()->whereNotNull('material_id')->select('material_id'))
                        ->where('user_id', '!=', $owner)
                        ->where('visibility', Visibility::Public)
                        ->whereHas('author', fn ($q) => $q->whereNull('deactivated_at'))
                        ->pluck('id')->all()
                    : [];
                $own = [
                    'test' => Test::where('user_id', $owner)->whereIn('id', $ids('test'))->pluck('id')->all(),
                    'material' => [
                        ...Material::where('user_id', $owner)->whereIn('id', $ids('material'))->pluck('id')->all(),
                        ...$kept,
                    ],
                ];

                $seen = [];
                foreach ($items as $i => $item) {
                    $key = $item['kind'].':'.(int) $item['id'];
                    if (! in_array((int) $item['id'], $own[$item['kind']], true)) {
                        $validator->errors()->add("items.{$i}.id", $item['kind'] === 'test'
                            ? 'Choose one of your own tests.'
                            : 'Choose one of your own materials.');
                    } elseif (isset($seen[$key])) {
                        $validator->errors()->add("items.{$i}.id", 'This is already in the course.');
                    }
                    $seen[$key] = true;
                }
            },
        ];
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ProfileModerated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UserAdminController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->validate(['q' => ['nullable', 'string', 'max:100']]);
        $term = $filters['q'] ?? null;

        $users = User::query()
            ->when($term, fn ($query, $q) => $query->where(
                fn ($group) => $group
                    ->where('name', 'like', '%'.addcslashes($q, '\\%_').'%')
                    ->orWhere('email', 'like', '%'.addcslashes($q, '\\%_').'%'),
            ))
            ->orderBy('name')
            ->orderBy('id')
            ->paginate(20)
            ->withQueryString()
            ->through(fn (User $user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'verified' => $user->hasVerifiedEmail(),
                'active' => $user->isActive(),
            ]);

        return Inertia::render('admin/users', ['users' => $users, 'filters' => ['q' => $term]]);
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $this->refuseSelf($request, $user);

        $validated = $request->validate([
            // Admin is granted by hand on purpose. Allowing it here would let
            // one compromised admin session mint more admins.
            'role' => ['required', Rule::in([Role::Teacher->value, Role::Student->value])],
        ]);

        $user->update(['role' => $validated['role']]);

        return back();
    }

    public function deactivate(Request $request, User $user): RedirectResponse
    {
        $this->refuseSelf($request, $user);

        // forceFill, not update(): `deactivated_at` is deliberately absent from
        // User::$fillable so it cannot be mass-assigned through a profile
        // update. update() would therefore silently no-op here and ship a
        // deactivate button that does nothing.
        $user->forceFill(['deactivated_at' => now()])->save();

        return back();
    }

    public function reactivate(Request $request, User $user): RedirectResponse
    {
        $user->forceFill(['deactivated_at' => null])->save();

        return back();
    }

    public function clearProfileContent(User $user): RedirectResponse
    {
        $profile = $user->profile;

        if ($profile) {
            if ($profile->avatar_path) {
                Storage::disk('public')->delete($profile->avatar_path);
            }

            // forceFill, not update(): `avatar_path` is deliberately absent
            // from Profile::$fillable (see ProfileAvatarController, which
            // sets it via direct property assignment). update() would
            // silently drop the avatar_path key and leave the file cleared
            // from disk but still referenced by the profile.
            $profile->forceFill(['bio' => null, 'specialties' => null, 'avatar_path' => null])->save();
        }

        $user->notify(new ProfileModerated);

        return back();
    }

    /** An admin removing their own access has no recovery short of tinker. */
    private function refuseSelf(Request $request, User $user): void
    {
        abort_if($user->id === $request->user()->id, 403);
    }
}

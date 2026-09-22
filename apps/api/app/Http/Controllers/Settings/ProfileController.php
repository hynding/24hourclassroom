<?php

namespace App\Http\Controllers\Settings;

use App\Ai\IntegrationTeardown;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ProfileUpdateRequest;
use App\Models\Material;
use App\Services\MaterialDeleter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Show the user's profile settings page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('settings/profile', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Update the user's profile settings.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return to_route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Tear down third-party state (Anthropic agent, environment, sessions,
        // uploaded files) outside the transaction: it takes a cache lock on the
        // database connection and makes 60 s gateway calls, neither of which
        // belongs inside an open transaction. The call has its own best-effort
        // error handling and needs no atomicity with the local deletes below.
        app(IntegrationTeardown::class)->forUser($user);

        // One unit, as the spec's data-model section requires. The
        // notifications table's notifiable_id is polymorphic and carries no
        // foreign key, so nothing else ties these two writes together: a
        // failure between them would lose the user's notifications while
        // leaving the account standing.
        DB::transaction(function () use ($user) {
            $user->notifications()->delete();

            $user->materials()->cursor()->each(fn (Material $m) => MaterialDeleter::delete($m));

            $user->tokens()->delete();

            $user->delete();
        });

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\AgeScreen;
use App\Support\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class OAuthCompletionController extends Controller
{
    public function __invoke(Request $request): Response
    {
        Registration::assertOpen();

        $request->validate(['role' => ['required', Rule::in(Role::selfAssignableValues())], ...AgeScreen::rules()]);

        $google = $request->session()->get('oauth.google');

        if (! $google) {
            throw ValidationException::withMessages([
                'role' => __('Your Google sign-in expired. Please sign in with Google again.'),
            ]);
        }

        try {
            AgeScreen::assertAllowed($request, Role::from($request->role));
        } catch (ValidationException $e) {
            // Refused for age: drop the Google name and email held for this
            // sign-up rather than keep a child's details in the session.
            if (! AgeScreen::oldEnough(max(1, $request->integer('birth_year')), min(12, max(1, $request->integer('birth_month'))))) {
                $request->session()->forget('oauth.google');
            }
            throw $e;
        }

        if (User::where('email', $google['email'])->exists()) {
            throw ValidationException::withMessages([
                'role' => __('An account with this email already exists. Log in with your password instead.'),
            ]);
        }

        $user = User::create([
            'name' => $google['name'],
            'email' => $google['email'],
            'password' => null,
            'role' => $request->role,
        ]);

        $user->forceFill([
            'google_id' => $google['id'],
            'email_verified_at' => now(),
        ])->save();

        $request->session()->forget('oauth.google');
        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        return response()->noContent();
    }
}

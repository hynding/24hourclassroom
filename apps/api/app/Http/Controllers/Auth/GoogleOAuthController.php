<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\FrontendRedirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleOAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable) {
            return redirect(FrontendRedirect::spaOrigin().'/login?error=oauth');
        }

        $user = User::where('google_id', $googleUser->getId())->first();

        if (! $user && $this->emailVerified($googleUser)) {
            $candidate = User::where('email', $googleUser->getEmail())->first();

            if ($candidate && $candidate->google_id === null) {
                $candidate->forceFill([
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => $candidate->email_verified_at ?? now(),
                ])->save();

                $user = $candidate;
            }
        }

        if ($user) {
            Auth::guard('web')->login($user);
            $request->session()->regenerate();

            return redirect(FrontendRedirect::spaOrigin());
        }

        $request->session()->put('oauth.google', [
            'id' => $googleUser->getId(),
            'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'New User',
            'email' => $googleUser->getEmail(),
        ]);

        return redirect(FrontendRedirect::spaOrigin().'/register/role');
    }

    private function emailVerified(object $googleUser): bool
    {
        return filter_var($googleUser->user['email_verified'] ?? false, FILTER_VALIDATE_BOOLEAN);
    }
}

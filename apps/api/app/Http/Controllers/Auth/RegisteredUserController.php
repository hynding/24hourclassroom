<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\FrontendRedirect;
use App\Support\Registration;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(Request $request): Response
    {
        if ($url = FrontendRedirect::validate($request->query('redirect'))) {
            $request->session()->put('url.intended', $url);
        }

        $open = Registration::isOpen();

        return Inertia::render('auth/register', [
            // The draft message is a public prop only while closed, as on /api/site.
            'registration' => ['open' => $open, 'message' => $open ? null : Registration::closedMessage()],
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Redirect, never abort(403, $text): the create() page renders the closed
        // state, and Laravel's 403 view would echo the admin's text unescaped.
        if (! Registration::isOpen()) {
            return redirect()->route('register');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::in([Role::Teacher->value, Role::Student->value])],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}

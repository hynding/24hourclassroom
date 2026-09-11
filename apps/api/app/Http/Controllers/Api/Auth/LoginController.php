<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): Response
    {
        $request->authenticate();

        if (! $request->user()->isActive()) {
            Auth::guard('web')->logout();

            throw ValidationException::withMessages([
                'email' => __('This account has been deactivated.'),
            ]);
        }

        $request->session()->regenerate();

        return response()->noContent();
    }
}

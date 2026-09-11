<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Connection;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render('dashboard', [
            'metrics' => $request->user()->role === Role::Admin ? $this->metrics() : null,
        ]);
    }

    /** @return array<string, mixed> */
    private function metrics(): array
    {
        $total = User::count();

        return [
            'users_by_role' => [
                Role::Teacher->value => User::where('role', Role::Teacher)->count(),
                Role::Student->value => User::where('role', Role::Student)->count(),
                Role::Admin->value => User::where('role', Role::Admin)->count(),
            ],
            'verified_percentage' => $total === 0
                ? 0
                : (int) round(User::whereNotNull('email_verified_at')->count() / $total * 100),
            'follows' => Follow::count(),
            'connections' => Connection::count(),
        ];
    }
}

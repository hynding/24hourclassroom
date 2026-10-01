<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Support\AdminMetrics;
use App\Support\Registration;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $isAdmin = $request->user()->role === Role::Admin;

        return Inertia::render('dashboard', [
            // Null, not zeroes, for everyone else: a teacher must not learn
            // the platform's counts from a prop the page chose not to render.
            'metrics' => $isAdmin ? AdminMetrics::build() : null,
            // Same shape rule, even though the switch is public via /api/site.
            'registration' => $isAdmin ? ['open' => Registration::isOpen()] : null,
        ]);
    }
}

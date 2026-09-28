<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Support\AdminMetrics;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render('dashboard', [
            // Null, not zeroes, for everyone else: a teacher must not learn
            // the platform's counts from a prop the page chose not to render.
            'metrics' => $request->user()->role === Role::Admin ? AdminMetrics::build() : null,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Layout;
use App\Enums\Palette;
use App\Enums\Typeset;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class SiteThemeController extends Controller
{
    public function edit(): Response
    {
        $values = fn (string $enum) => array_map(
            fn ($case) => ['value' => $case->value, 'label' => ucfirst($case->value)],
            $enum::cases(),
        );

        return Inertia::render('admin/site-theme', [
            'theme' => SiteSetting::current()->theme(),
            'options' => [
                'layouts' => $values(Layout::class),
                'palettes' => $values(Palette::class),
                'typesets' => $values(Typeset::class),
            ],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        // Rule::enum is safe here, unlike for Role: no theme value is
        // privileged, so there is nothing to escalate to.
        $validated = $request->validate([
            'layout' => ['required', Rule::enum(Layout::class)],
            'palette' => ['required', Rule::enum(Palette::class)],
            'typeset' => ['required', Rule::enum(Typeset::class)],
        ]);

        SiteSetting::current()->update($validated);

        return back();
    }
}

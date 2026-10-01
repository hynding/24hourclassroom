<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingsController extends Controller
{
    public function edit(): Response
    {
        $row = SiteSetting::current();

        // The raw columns, deliberately not config(): config() hides the closed
        // message while open and the banner text while disabled, which is
        // exactly the draft the admin is editing.
        return Inertia::render('admin/site', [
            'site' => [
                'name' => $row->name,
                'tagline' => $row->tagline,
                'registration_open' => $row->registration_open,
                'registration_message' => $row->registration_message,
                'banner_enabled' => $row->banner_enabled,
                'banner_text' => $row->banner_text,
            ],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        // TrimStrings + ConvertEmptyStringsToNull already turned blank strings
        // into null, so a cleared field stores null.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:60'],
            'tagline' => ['nullable', 'string', 'max:160'],
            'registration_open' => ['required', 'boolean'],
            'registration_message' => ['nullable', 'string', 'max:300'],
            'banner_enabled' => ['required', 'boolean'],
            // Rule::requiredIf with $request->boolean(): required_if:banner_enabled,true
            // only fires for a JSON boolean and skips "1"/"true" from a form post.
            'banner_text' => ['nullable', 'string', 'max:300', Rule::requiredIf(fn () => $request->boolean('banner_enabled'))],
        ]);

        SiteSetting::current()->update($validated);

        return back();
    }
}

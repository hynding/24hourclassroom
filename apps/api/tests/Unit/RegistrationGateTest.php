<?php

use Illuminate\Support\Facades\File;

test('every path that creates a users row goes through the registration gate', function () {
    // Allowlist, not denylist: a fourth creator fails here until it is gated.
    // Seeders and factories live outside app/ and are deliberately ungated
    // (shell provisioning must work while sign-ups are closed). Console
    // commands ARE scanned: a future provisioning command that creates users
    // joins the allowlist below, it does not get gated.
    // app/Models is excluded because SiteSetting::forceCreate is unrelated.
    $creators = collect(File::allFiles(app_path()))
        ->filter(fn ($file) => ! str_starts_with($file->getRelativePathname(), 'Models/'))
        ->filter(fn ($file) => str_contains($file->getContents(), 'User::create('))
        ->map(fn ($file) => $file->getRelativePathname())
        ->sort()->values()->all();

    expect($creators)->toBe([
        'Http/Controllers/Api/Auth/OAuthCompletionController.php',
        'Http/Controllers/Api/Auth/RegisterController.php',
        'Http/Controllers/Auth/RegisteredUserController.php',
    ]);

    foreach ($creators as $path) {
        expect(file_get_contents(app_path($path)))->toContain('Registration::');
    }
});

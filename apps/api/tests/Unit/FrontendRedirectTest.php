<?php

use App\Support\FrontendRedirect;

beforeEach(function () {
    config(['app.frontend_urls' => 'https://24hourclassroom.com,http://localhost:3333']);
});

test('allows urls on an allowlisted origin', function () {
    expect(FrontendRedirect::validate('https://24hourclassroom.com/lesson-plans'))
        ->toBe('https://24hourclassroom.com/lesson-plans');
    expect(FrontendRedirect::validate('http://localhost:3333/'))
        ->toBe('http://localhost:3333/');
});

test('rejects foreign, malformed, and empty urls', function () {
    expect(FrontendRedirect::validate('https://evil.example/phish'))->toBeNull();
    expect(FrontendRedirect::validate('https://24hourclassroom.com.evil.example/'))->toBeNull();
    expect(FrontendRedirect::validate('javascript:alert(1)'))->toBeNull();
    expect(FrontendRedirect::validate('/relative/path'))->toBeNull();
    expect(FrontendRedirect::validate(null))->toBeNull();
    expect(FrontendRedirect::validate(''))->toBeNull();
});

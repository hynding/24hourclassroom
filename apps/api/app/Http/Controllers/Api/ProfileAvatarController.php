<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\ProfilePayload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProfileAvatarController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate(
            ['avatar' => ['required', 'image', 'max:1024']],
            [
                'avatar.required' => 'Choose an image file under 1MB.',
                'avatar.max' => 'Choose an image file under 1MB.',
                'avatar.image' => 'That file is not an image.',
            ],
        );

        $profile = $request->user()->profile()->firstOrNew();

        if ($profile->avatar_path) {
            Storage::disk('public')->delete($profile->avatar_path);
        }

        $profile->avatar_path = $request->file('avatar')->store('avatars', 'public');
        $profile->save();

        return response()->json(ProfilePayload::for($profile));
    }

    public function destroy(Request $request): Response
    {
        $profile = $request->user()->profile;

        if ($profile?->avatar_path) {
            Storage::disk('public')->delete($profile->avatar_path);
            $profile->avatar_path = null;
            $profile->save();
        }

        return response()->noContent();
    }
}

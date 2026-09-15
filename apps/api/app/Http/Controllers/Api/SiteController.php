<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;

class SiteController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(['theme' => SiteSetting::current()->theme()]);
    }
}

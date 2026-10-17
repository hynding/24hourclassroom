<?php

use App\Http\Controllers\Api\AnswerGradeController;
use App\Http\Controllers\Api\AnthropicKeyController;
use App\Http\Controllers\Api\AssignmentController;
use App\Http\Controllers\Api\AttemptController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\OAuthCompletionController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationNotificationController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ConnectionController;
use App\Http\Controllers\Api\CourseBranchController;
use App\Http\Controllers\Api\CourseCandidatesController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseLibraryController;
use App\Http\Controllers\Api\CoursePracticeController;
use App\Http\Controllers\Api\CoursePublishController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\GenerationCancelController;
use App\Http\Controllers\Api\GenerationController;
use App\Http\Controllers\Api\IntegrationsController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\MaterialFileController;
use App\Http\Controllers\Api\MaterialPublishController;
use App\Http\Controllers\Api\MaterialShareController;
use App\Http\Controllers\Api\MaterialShowController;
use App\Http\Controllers\Api\MaterialsLibraryController;
use App\Http\Controllers\Api\McpTokenController;
use App\Http\Controllers\Api\MyAssignmentsController;
use App\Http\Controllers\Api\MyAttemptsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ProfileAvatarController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PublicProfileController;
use App\Http\Controllers\Api\SharedMaterialController;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\SitemapController;
use App\Http\Controllers\Api\StudentAssignmentsController;
use App\Http\Controllers\Api\TeacherDirectoryController;
use App\Http\Controllers\Api\TestAttemptsController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\TestCopyController;
use App\Http\Controllers\Api\TestPublishController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'session-only', 'active'])->get('/user', UserController::class);

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class)->middleware('throttle:6,1');
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class)->middleware('auth');
    Route::post('forgot-password', PasswordResetLinkController::class)->middleware('throttle:6,1');
    Route::post('reset-password', NewPasswordController::class)->middleware('throttle:6,1');
    Route::post('verification-notification', VerificationNotificationController::class)
        ->middleware(['auth:sanctum', 'session-only', 'active', 'throttle:6,1']);
    Route::post('oauth/complete', OAuthCompletionController::class)->middleware('throttle:6,1');
});

// throttle:60,1 -- deliberately the same limit the public group below already
// carries, so this is a consistency fix rather than a new product decision.
// The group had none, which is what let the review's enumeration sweeps run at
// full speed; each POST /api/connections/{id} probe also writes a row and
// fires a notification, so an uncapped census doubled as inbox spam. The
// limiter keys on the user id, so it caps an individual rather than the host.
Route::middleware(['auth:sanctum', 'session-only', 'verified', 'active', 'throttle:60,1'])->group(function () {
    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::post('profile/avatar', [ProfileAvatarController::class, 'store']);
    Route::delete('profile/avatar', [ProfileAvatarController::class, 'destroy']);

    Route::post('users/{user}/follow', [FollowController::class, 'store']);
    Route::delete('users/{user}/follow', [FollowController::class, 'destroy']);

    Route::get('connections', [ConnectionController::class, 'index']);
    Route::get('connections/pending', [ConnectionController::class, 'pending']);
    // `user` has no Route::pattern, so connections/code must never be a POST:
    // it would bind "code" as a user id. Hence rotation is a PUT.
    Route::get('connections/code', [ConnectionController::class, 'code']);
    Route::put('connections/code', [ConnectionController::class, 'rotateCode']);
    Route::post('connections/code/{code}', [ConnectionController::class, 'storeByCode']);
    Route::post('connections/{user}', [ConnectionController::class, 'store']);
    Route::patch('connections/{connection}', [ConnectionController::class, 'update']);
    Route::delete('connections/{connection}', [ConnectionController::class, 'destroy']);

    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('notifications/unread-count', [NotificationController::class, 'unreadCount']);
    Route::post('notifications/read', [NotificationController::class, 'read']);

    Route::get('tests', [TestController::class, 'index']);
    Route::post('tests', [TestController::class, 'store']);
    Route::put('tests/{test}', [TestController::class, 'update']);
    Route::delete('tests/{test}', [TestController::class, 'destroy']);
    Route::post('tests/{test}/publish', [TestPublishController::class, 'publish']);
    Route::post('tests/{test}/unpublish', [TestPublishController::class, 'unpublish']);
    Route::post('tests/{test}/copy', TestCopyController::class);

    Route::get('tests/{test}/assignments', [AssignmentController::class, 'index']);
    Route::post('tests/{test}/assignments', [AssignmentController::class, 'store']);
    Route::delete('tests/{test}/assignments/{assignment}', [AssignmentController::class, 'destroy']);
    Route::get('assignments', MyAssignmentsController::class);
    Route::get('students/{user}/assignments', StudentAssignmentsController::class);

    Route::get('attempts', MyAttemptsController::class);
    Route::post('tests/{test}/attempts', [AttemptController::class, 'store']);
    Route::get('attempts/{attempt}', [AttemptController::class, 'show']);
    Route::put('attempts/{attempt}', [AttemptController::class, 'update']);
    Route::post('attempts/{attempt}/submit', [AttemptController::class, 'submit']);
    Route::put('attempts/{attempt}/answers/{answer}', AnswerGradeController::class);
    Route::get('tests/{test}/attempts', TestAttemptsController::class);

    Route::get('materials', [MaterialController::class, 'index']);
    Route::post('materials', [MaterialController::class, 'store']);
    // Registered before the {material} routes for readability; Route::pattern
    // in AppServiceProvider is what actually guarantees the literal wins.
    Route::get('materials/shared', SharedMaterialController::class);
    Route::put('materials/{material}', [MaterialController::class, 'update']);
    Route::delete('materials/{material}', [MaterialController::class, 'destroy']);
    Route::post('materials/{material}/publish', [MaterialPublishController::class, 'publish']);
    Route::post('materials/{material}/unpublish', [MaterialPublishController::class, 'unpublish']);
    Route::get('materials/{material}/shares', [MaterialShareController::class, 'index']);
    Route::post('materials/{material}/shares', [MaterialShareController::class, 'store']);
    Route::delete('materials/{material}/shares/{share}', [MaterialShareController::class, 'destroy']);

    Route::get('courses', [CourseController::class, 'index']);
    Route::post('courses', [CourseController::class, 'store']);
    // The literal is safe from {course} for the same reason as
    // materials/shared: Route::pattern in AppServiceProvider.
    Route::get('courses/candidates', CourseCandidatesController::class);
    Route::put('courses/{course}', [CourseController::class, 'update']);
    Route::delete('courses/{course}', [CourseController::class, 'destroy']);
    Route::post('courses/{course}/publish', [CoursePublishController::class, 'publish']);
    Route::post('courses/{course}/unpublish', [CoursePublishController::class, 'unpublish']);
    Route::post('courses/{course}/branch', CourseBranchController::class);

    // Comments on a test, a question, a material or a course. Signed-in
    // only, reading included: a discussion names people, and who may see
    // whose name is decided per viewer (CommentAccess).
    Route::get('comments', [CommentController::class, 'index']);
    Route::post('comments', [CommentController::class, 'store']);
    Route::patch('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
    // A public course's discussion is moderated: its author, a connected
    // teacher assistant and admins approve or deny each comment.
    Route::post('comments/{comment}/approve', [CommentController::class, 'approve']);
    Route::post('comments/{comment}/deny', [CommentController::class, 'deny']);
    Route::put('comments/{comment}/reaction', [CommentController::class, 'react']);

    // Teacher-only, and grouped so plan 2's anthropic-key and generation
    // routes join the same gate. `teacher` sits ahead of SubstituteBindings
    // in the priority list, so a bound {generation} id is never an oracle.
    Route::middleware('teacher')->group(function () {
        Route::get('integrations', [IntegrationsController::class, 'show']);
        Route::post('integrations/mcp-tokens', [McpTokenController::class, 'store']);
        Route::delete('integrations/mcp-tokens/{id}', [McpTokenController::class, 'destroy']);
        Route::put('integrations/anthropic-key', [AnthropicKeyController::class, 'update']);
        Route::delete('integrations/anthropic-key', [AnthropicKeyController::class, 'destroy']);

        Route::get('generations', [GenerationController::class, 'index']);
        Route::post('generations', [GenerationController::class, 'store']);
        Route::get('generations/{generation}', [GenerationController::class, 'show']);
        Route::post('generations/{generation}/cancel', GenerationCancelController::class);
    });
});

// `active` here too. These two routes are reachable by guests -- the
// middleware passes a null user straight through -- but a DEACTIVATED session
// must not keep the authenticated-viewer privileges the payload carries
// (a student's name behind an accepted connection, is_following, connection).
Route::middleware(['throttle:60,1', 'active'])->group(function () {
    Route::get('teachers', TeacherDirectoryController::class);
    Route::get('users/{user}', PublicProfileController::class);
    Route::get('library', LibraryController::class);
    Route::get('library/materials', MaterialsLibraryController::class);
    Route::get('tests/{test}', [TestController::class, 'show']);
    Route::get('materials/{material}', MaterialShowController::class);
    Route::get('library/courses', CourseLibraryController::class);
    Route::get('courses/{course}', [CourseController::class, 'show']);
    // Practice mode: guests included, nothing recorded. `check` is a POST
    // only because a run's responses do not fit a query string; it writes
    // nothing.
    Route::get('courses/{course}/tests/{test}', [CoursePracticeController::class, 'show']);
    Route::post('courses/{course}/tests/{test}/check', [CoursePracticeController::class, 'check']);
});

// Site configuration: no `auth`, no `active`. The public group above carries
// `active` because its payloads hold viewer-dependent privileges; this one
// has none, and the SPA fetches it at boot -- it must never be the request
// that 401s a deactivated session. Sanctum's stateful pipeline still runs on
// the whole api group, which is fine: AuthenticateSession only ends a session
// whose password changed, correct on any route.
Route::middleware('throttle:60,1')->get('site', SiteController::class);

// Every page a guest can open, as SPA URLs; the SPA's robots.txt names it.
// No `active`: it carries nothing viewer-dependent.
Route::middleware('throttle:60,1')->get('sitemap.xml', SitemapController::class);

// The file stream: `signed:relative` and its own limiter, deliberately with
// NO `auth` and NO `active`. The signature covers path and query only, so a
// scheme or host difference between APP_URL and what the shared host's proxy
// presents to PHP cannot 403 every production download.
Route::middleware(['signed:relative', 'throttle:downloads'])
    ->get('materials/{material}/file', MaterialFileController::class)
    ->name('materials.file');

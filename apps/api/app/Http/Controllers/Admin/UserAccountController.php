<?php

namespace App\Http\Controllers\Admin;

use App\Ai\AnthropicKeyRemover;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\IntegrationModerated;
use App\Services\AccountDeleter;
use App\Support\AdminMessages;
use App\Support\AdminMetrics;
use App\Support\AdminTarget;
use App\Support\AdminUserPayload;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

/**
 * The account-level support actions. AdminTarget::assertActionable is the
 * first statement of every method, ahead of validation, so a 403 is never
 * rendered as a 422. Split from UserAdminController by churn, not meaning.
 */
class UserAccountController extends Controller
{
    public function resendVerification(Request $request, User $user): RedirectResponse
    {
        AdminTarget::assertActionable($request->user(), $user);

        if ($user->hasVerifiedEmail()) {
            return back()->with('notice', AdminMessages::ALREADY_VERIFIED);
        }

        $user->sendEmailVerificationNotification();

        return back();
    }

    public function forceVerify(Request $request, User $user): RedirectResponse
    {
        AdminTarget::assertActionable($request->user(), $user);

        if ($user->hasVerifiedEmail()) {
            return back()->with('notice', AdminMessages::ALREADY_VERIFIED);
        }

        $user->markEmailAsVerified();
        // Parity with VerifyEmailController; no listener exists today.
        event(new Verified($user));
        // deactivated_at is deliberately untouched: Reactivate is its own action.

        Log::info('Admin force-verified a user', ['admin_id' => $request->user()->id, 'user_id' => $user->id]);
        Cache::forget(AdminMetrics::CACHE_KEY);

        return back();
    }

    public function clearAnthropicKey(Request $request, User $user, AnthropicKeyRemover $remover): RedirectResponse
    {
        AdminTarget::assertActionable($request->user(), $user);

        // Before any teardown: on a keyless account the teardown would still
        // cancel every live run.
        if (! AdminUserPayload::hasKey($user)) {
            return back()->with('notice', AdminMessages::NO_KEY);
        }

        $result = $remover->forUser($user);
        $user->notify(new IntegrationModerated);

        Log::info('Admin removed an Anthropic key', ['admin_id' => $request->user()->id, 'user_id' => $user->id, ...$result]);

        if ($result['cancelled'] > 0) {
            Cache::forget(AdminMetrics::CACHE_KEY);
        }

        $notice = AdminMessages::keyRemoved($result['cancelled'], $result['skipped']);

        return $notice === null ? back() : back()->with('notice', $notice);
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        AdminTarget::assertActionable($request->user(), $user);

        // Deactivation is the reversible first stop for every case delete is
        // reached for; delete is only offered on a deactivated account.
        if ($user->isActive()) {
            return back()->with('notice', AdminMessages::DEACTIVATE_FIRST);
        }

        // is_string() first: trim() on an array ("confirmation[]=x") would
        // raise instead of failing validation with a clean 422.
        $confirmation = $request->input('confirmation');
        $request->merge(['confirmation' => is_string($confirmation) ? trim($confirmation) : $confirmation]);
        $request->validate(
            ['confirmation' => ['required', 'string', Rule::in([$user->email])]],
            ['confirmation.in' => 'That is not this account\'s email address.'],
        );

        if (! AccountDeleter::delete($user)) {
            return redirect('/admin/users')->with('notice', AdminMessages::ALREADY_DELETING);
        }

        Log::info('Admin deleted an account', ['admin_id' => $request->user()->id, 'user_id' => $user->id, 'email' => $user->email]);
        Cache::forget(AdminMetrics::CACHE_KEY);

        return redirect('/admin/users');
    }
}

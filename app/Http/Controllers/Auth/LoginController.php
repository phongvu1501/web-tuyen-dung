<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use RuntimeException;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $authenticated = Auth::attempt($request->only('email', 'password'), $request->boolean('remember'));
        } catch (RuntimeException) {
            // A manually imported account may contain a valid Argon/PHP hash while
            // this application is configured to use bcrypt. Verify it generically
            // and upgrade it after login instead of exposing a hashing exception.
            $authenticated = $this->attemptCompatibleHash($request);
        }

        if (! $authenticated) {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => 'Email hoặc mật khẩu không chính xác.',
            ]);
        }

        $request->session()->regenerate();

        if (! $request->user()->is_admin) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors(['email' => 'Tài khoản không có quyền truy cập trang quản trị.']);
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    private function attemptCompatibleHash(LoginRequest $request): bool
    {
        $user = User::query()->where('email', $request->input('email'))->first();

        if (! $user) {
            return false;
        }

        $storedHash = $user->getRawOriginal($user->getAuthPasswordName());

        if (! is_string($storedHash)) {
            return false;
        }

        if (password_get_info($storedHash)['algo'] !== null) {
            if (! password_verify($request->input('password'), $storedHash)) {
                return false;
            }
        } elseif (
            ! config('auth.legacy_plaintext_passwords')
            || ! hash_equals($storedHash, $request->input('password'))
        ) {
            return false;
        }

        $user->forceFill([
            $user->getAuthPasswordName() => Hash::make($request->input('password')),
        ])->save();

        Auth::login($user, $request->boolean('remember'));

        return true;
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return to_route('login');
    }
}

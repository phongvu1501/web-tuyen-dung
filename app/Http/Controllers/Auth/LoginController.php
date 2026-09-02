<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
        } catch (RuntimeException $exception) {
            report($exception);

            return back()->withInput($request->only('email'))->withErrors([
                'email' => 'Tài khoản chưa được cấu hình mật khẩu hợp lệ. Vui lòng liên hệ quản trị viên.',
            ]);
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

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return to_route('login');
    }
}

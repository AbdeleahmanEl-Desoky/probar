<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the admin login view.
     */
    public function create()//: View
    {
        if (auth('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
            // This will return the login form view
        return view('admin::auth.login');
    }

    /**
     * Handle an incoming admin authentication request.
     */
    public function store(Request $request)//: RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log in using the 'admin' guard
        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect to the intended protected page, or the dashboard by default
            return redirect()->intended(route('admin.dashboard'));
        }
        // If authentication fails, redirect back to the login form with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session (logout).
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect to the login page after logging out
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // =========================
    // Show Login Form
    // =========================
    public function showLoginForm(Request $request)
    {
        // Save login URL segment
        session(['login_from' => $request->segment(1)]);

        return view('auth.login');
    }

    // =========================
    // Login
    // =========================
   public function login(Request $request)
{
    $request->validate([
        'email'      => 'required|email',
        'password'   => 'required',
        'login_from' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->with('error', 'Email or password is incorrect.');
    }

    $user = Auth::user();

    $roleMap = [
        '61ap0-91kjdser-Ediuf82391' => 1, // Admin
        '70af9-83mbrdsg-Djpqf23141' => 3, // HR
        '90fh9-83kjsdf-Fjsdfl9231'  => 4, // Sales
        'P0A61-k9JDSER-EdIuF381'    => 5, // Technical
    ];

    if (!isset($roleMap[$request->login_from])) {
        Auth::logout();
        return back()->with('error', 'Invalid login URL.');
    }

    if ($user->role_id != $roleMap[$request->login_from]) {   // ← was is_admin
        Auth::logout();

        Log::warning('Role mismatch login attempt', [
            'email' => $user->email,
            'role'  => $user->role_id,                         // ← was is_admin
            'url'   => $request->login_from,
        ]);

        return back()->with('error', 'You are not authorized to login here.');
    }

    session(['login_from' => $request->login_from]);

    // Role-based landing page
    return match ((int) $user->role_id) {                      // ← was is_admin
        1 => redirect()->route('admin.admin_home'),                      // Admin → Dashboard
        3 => redirect()->route('admin.career_details'),                  // HR    → Careers
        4 => redirect()->route('admin.show_add_brochure'),               // Sales → Add Brochure
        5 => redirect()->route('admin.show_add_brands_and_products'),    // Tech  → Add Brands & Products
        default => redirect()->route('admin.admin_home'),
    };
}

    // =========================
    // Logout (SINGLE SOURCE)
    // =========================
    public function logout(Request $request)
    {
        $loginFrom = session('login_from', '61ap0-91kjdser-Ediuf82391');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ IMPORTANT: redirect using STRING path only
        return redirect('/' . $loginFrom);
    }
}

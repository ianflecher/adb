<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the admin login page.
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * Handle the admin login.
     */
    public function login(Request $request)
{
    // Validate login credentials
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Retrieve the admin by email
    $admin = Admin::where('email', $request->email)->first();

    // Manually hash the input password using SHA-256 and compare it with the stored password
    if ($admin && hash('sha256', $request->password) === $admin->password) {
        session(['admin_name' => $admin->name]);
        // Redirect to the admin dashboard with a success message
        return redirect()->route('admin.dashboard');
    }

    // If login fails, return back with an error message
    return back()->with('error', 'Invalid credentials');
}


    /**
     * Show the admin dashboard after login.
     */
    public function dashboard()
    {
        // Return the dashboard view
        return view('admin.dashboard');
    }

    /**
     * Handle logout functionality.
     */
    public function logout()
    {
        // Clear the session and redirect to the login page after logout
        session()->forget('admin_name');
        return redirect()->route('admin.login');
    }
}

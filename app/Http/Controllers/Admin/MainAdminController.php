<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MainAdminController extends Controller
{
    public function home()
    {
        return view('admin.index');
    }

    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.home');
        }

        toastr()->error(__('auth.failed'));
        return back()->withInput();
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        toastr()->success(__('Logged out successfully'));
        return redirect()->route('admin.login');
    }

    public function profile()
    {
        $profile = Auth::user();
        return view('admin.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
        return redirect()->route('admin.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}

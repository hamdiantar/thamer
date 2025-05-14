<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'code' => 'nullable|string|unique:users,code|max:50',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,head_department,teacher,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'code' => $request->code,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        toastr()->success('تم إنشاء المستخدم بنجاح');
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'code' => 'nullable|string|unique:users,code,'.$user->id.'|max:50',
            'role' => 'required|in:admin,head_department,teacher,user',
        ]);
        $user->update($request->all());
        toastr()->success('تم تحديث المستخدم بنجاح');
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        toastr()->success('تم حذف المستخدم بنجاح');
        return back();
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
        return redirect()->route('main_admin.my_profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('head')->get();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        $heads = User::where('role', 'head_department')->get();
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.departments.create', compact('heads', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments|max:255',
            'description' => 'nullable|string',
            'head_id' => 'nullable|exists:users,id',
            'teachers' => 'nullable|array',
            'teachers.*' => 'exists:users,id',
        ]);

        $department = Department::create($request->only(['name', 'description', 'head_id']));
        $department->teachers()->sync($request->teachers);

        toastr()->success('تم إنشاء القسم بنجاح');
        return redirect()->route('admin.departments.index');
    }

    public function edit(Department $department)
    {
        $heads = User::where('role', 'head_department')->get();
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.departments.edit', compact('department', 'heads', 'teachers'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|max:255|unique:departments,name,' . $department->id,
            'description' => 'nullable|string',
            'head_id' => 'nullable|exists:users,id',
            'teachers' => 'nullable|array',
            'teachers.*' => 'exists:users,id',
        ]);

        $department->update($request->only(['name', 'description', 'head_id']));
        $department->teachers()->sync($request->teachers);

        toastr()->success('تم تحديث القسم بنجاح');
        return redirect()->route('admin.departments.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        toastr()->success('تم حذف القسم بنجاح');
        return back();
    }
}

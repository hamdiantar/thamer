<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::get();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments|max:255',
            'description' => 'nullable|string'
        ]);

        Department::create($request->all());
        toastr()->success('تم إنشاء القسم بنجاح');
        return redirect()->route('admin.departments.index');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|max:255|unique:departments,name,'.$department->id,
            'description' => 'nullable|string'
        ]);

        $department->update($request->all());
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

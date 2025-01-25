<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Department;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::with('departments')->paginate(10);
        return view('admin.instructors.index', compact('instructors'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.instructors.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:instructors|max:50',
            'name' => 'required|max:255',
            'departments' => 'required|array'
        ]);

        $instructor = Instructor::create($request->only('code', 'name'));
        $instructor->departments()->sync($request->departments);

        toastr()->success('تم إنشاء المحاضر بنجاح');
        return redirect()->route('admin.instructors.index');
    }

    public function edit(Instructor $instructor)
    {
        $departments = Department::all();
        return view('admin.instructors.edit', compact('instructor', 'departments'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $request->validate([
            'code' => 'required|max:50|unique:instructors,code,'.$instructor->id,
            'name' => 'required|max:255',
            'departments' => 'required|array'
        ]);

        $instructor->update($request->only('code', 'name'));
        $instructor->departments()->sync($request->departments);

        toastr()->success('تم تحديث المحاضر بنجاح');
        return redirect()->route('admin.instructors.index');
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->departments()->detach();
        $instructor->delete();
        toastr()->success('تم حذف المحاضر بنجاح');
        return back();
    }
}

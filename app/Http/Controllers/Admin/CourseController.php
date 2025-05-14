<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('level')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $allCourses = Course::all();
        $levels = Level::all();
        return view('admin.courses.create', compact('allCourses', 'levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:courses|max:50',
            'title' => 'required|max:255',
            'level_id' => 'required|exists:levels,id',
            'sch' => 'required|integer',
            'lecture_hours' => 'required|integer',
            'practical_hours' => 'required|integer',
            'clinical_hours' => 'required|integer',
        ]);

        $course = Course::create($request->all());
        $course->prerequisites()->sync($request->prerequisites);
        $course->corequisites()->sync($request->corequisites);

        toastr()->success('تم إنشاء المقرر بنجاح');
        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        $course = Course::with(['prerequisites', 'corequisites'])->findOrFail($course->id);
        $allCourses = Course::where('id', '!=', $course->id)->get();
        $levels = Level::all();

        return view('admin.courses.edit', compact('course', 'allCourses', 'levels'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code' => 'required|max:50|unique:courses,code,'.$course->id,
            'title' => 'required|max:255',
            'level_id' => 'required|exists:levels,id',
            'sch' => 'required|integer',
            'lecture_hours' => 'required|integer',
            'practical_hours' => 'required|integer',
            'clinical_hours' => 'required|integer',
        ]);

        $course->update($request->all());
        $course->prerequisites()->sync($request->prerequisites);
        $course->corequisites()->sync($request->corequisites);

        toastr()->success('تم تحديث المقرر بنجاح');
        return redirect()->route('admin.courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        toastr()->success('تم حذف المقرر بنجاح');
        return back();
    }
}

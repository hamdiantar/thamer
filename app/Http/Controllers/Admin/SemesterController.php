<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Year;
use App\Models\Level;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::with(['year', 'level'])->latest()->paginate(10);
        return view('admin.semesters.index', compact('semesters'));
    }

    public function create()
    {
        $years = Year::orderBy('year', 'desc')->get();
        $levels = Level::orderBy('name')->get();
        return view('admin.semesters.create', compact('years', 'levels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year_id' => 'required|exists:years,id',
            'level_id' => 'required|exists:levels,id',
            'semester_number' => 'required|integer|min:1|max:3',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $exists = Semester::where('year_id', $validated['year_id'])
            ->where('semester_number', $validated['semester_number'])
            ->exists();

        if ($exists) {
            toastr()->error('رقم الفصل الدراسي هذا موجود بالفعل للسنة المحددة.');
            return back()->withErrors(['semester_number' => 'رقم الفصل الدراسي هذا موجود بالفعل للسنة المحددة.']);
        }

        Semester::create($validated);
        toastr()->success('تم إضافة الفصل الدراسي بنجاح');
        return redirect()->route('admin.semesters.index');
    }

    public function edit(Semester $semester)
    {
        $years = Year::orderBy('year', 'desc')->get();
        $levels = Level::orderBy('name')->get();
        return view('admin.semesters.edit', compact('semester', 'years', 'levels'));
    }

    public function update(Request $request, Semester $semester)
    {
        $validated = $request->validate([
            'year_id' => 'required|exists:years,id',
            'level_id' => 'required|exists:levels,id',
            'semester_number' => 'required|integer|min:1|max:3',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date'
        ]);
        $exists = Semester::where('year_id', $validated['year_id'])
            ->where('semester_number', $validated['semester_number'])
            ->where('id', '!=', $semester->id)
            ->exists();
        if ($exists) {
            toastr()->error('رقم الفصل الدراسي هذا موجود بالفعل للسنة المحددة.');
            return back()->withErrors(['semester_number' => 'رقم الفصل الدراسي هذا موجود بالفعل للسنة المحددة.']);
        }
        $semester->update($validated);
        toastr()->success('تم تحديث الفصل الدراسي بنجاح');
        return redirect()->route('admin.semesters.index');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();
        toastr()->success('تم حذف الفصل الدراسي بنجاح');
        return redirect()->route('admin.semesters.index');
    }
}

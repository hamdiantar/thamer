<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::latest()->paginate(10);
        return view('admin.semesters.index', compact('semesters'));
    }

    public function create()
    {
        return view('admin.semesters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|digits:4|integer|min:1901|max:2155',
            'season' => 'required|in:Fall,Spring,Summer',
            'semester_number' => 'required|integer|min:1|max:3',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date'
        ]);
        $validated['semester_number'] = (int)$validated['semester_number'];
        $exists = Semester::where('year', $validated['year'])
            ->where('semester_number', $validated['semester_number'])
            ->exists();
        if($exists) {
            return back()->withErrors(['semester_number' => 'This semester number already exists for selected year']);
        }
        Semester::create($validated);
        return redirect()->route('admin.semesters.index')
            ->with('success', 'Semester created successfully');
    }

    public function edit(Semester $semester)
    {
        return view('admin.semesters.edit', compact('semester'));
    }

    public function update(Request $request, Semester $semester)
    {
        $validated = $request->validate([
            'year' => 'required|digits:4|integer|min:1901|max:2155',
            'season' => 'required|in:Fall,Spring,Summer',
            'semester_number' => 'required|integer|min:1|max:3',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date'
        ]);
        $exists = Semester::where('year', $validated['year'])
            ->where('semester_number', $validated['semester_number'])
            ->where('id', '!=', $semester->id)
            ->exists();
        if($exists) {
            return back()->withErrors(['semester_number' => 'This semester number already exists for selected year']);
        }
        $semester->update($validated);

        return redirect()->route('admin.semesters.index')
            ->with('success', 'Semester updated successfully');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();
        return redirect()->route('admin.semesters.index')
            ->with('success', 'Semester deleted successfully');
    }
}

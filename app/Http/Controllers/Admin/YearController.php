<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Year;

class YearController extends Controller
{
    public function index()
    {
        $years = Year::orderBy('year', 'desc')->get();
        return view('admin.years.index', compact('years'));
    }

    public function create()
    {
        return view('admin.years.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|unique:years,year|min:1900|max:2100',
        ]);

        Year::create($request->all());

        return redirect()->route('admin.years.index')->with('success', 'تم إضافة السنة بنجاح');
    }

    public function edit(Year $year)
    {
        return view('admin.years.edit', compact('year'));
    }

    public function update(Request $request, Year $year)
    {
        $request->validate([
            'year' => 'required|integer|unique:years,year,' . $year->id . '|min:1900|max:2100',
        ]);

        $year->update($request->all());

        return redirect()->route('admin.years.index')->with('success', 'تم تحديث السنة بنجاح');
    }

    public function destroy(Year $year)
    {
        $year->delete();
        return redirect()->route('admin.years.index')->with('success', 'تم حذف السنة بنجاح');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::orderBy('number')->get();
        return view('admin.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.periods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer|min:1|max:10|unique:periods',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time'
        ]);

        Period::create($request->all());
        toastr()->success('تم إنشاء الفترة بنجاح');
        return redirect()->route('admin.periods.index');
    }

    public function edit(Period $period)
    {
        return view('admin.periods.edit', compact('period'));
    }

    public function update(Request $request, Period $period)
    {
        $request->validate([
            'number' => 'required|integer|min:1|max:10|unique:periods,number,'.$period->id,
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time'
        ]);

        $period->update($request->all());
        toastr()->success('تم تحديث الفترة بنجاح');
        return redirect()->route('admin.periods.index');
    }

    public function destroy(Period $period)
    {
        $period->delete();
        toastr()->success('تم حذف الفترة بنجاح');
        return back();
    }
}

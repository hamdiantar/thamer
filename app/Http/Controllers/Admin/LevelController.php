<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::orderBy('name')->get();
        return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
        return view('admin.levels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:levels,name|max:255',
        ]);

        Level::create($request->all());
        toastr()->success('تم إضافة المستوى بنجاح');
        return redirect()->route('admin.levels.index');
    }

    public function edit(Level $level)
    {
        return view('admin.levels.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $request->validate([
            'name' => 'required|string|unique:levels,name,' . $level->id . '|max:255',
        ]);

        $level->update($request->all());
        toastr()->success('تم تحديث المستوى بنجاح');
        return redirect()->route('admin.levels.index');
    }

    public function destroy(Level $level)
    {
        $level->delete();
        toastr()->success('تم حذف المستوى بنجاح');
        return redirect()->route('admin.levels.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        return view('admin.groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:groups|max:50',
            'description' => 'nullable|max:255'
        ]);

        Group::create($request->all());
        toastr()->success('تم إنشاء المجموعة بنجاح');
        return redirect()->route('admin.groups.index');
    }

    public function edit(Group $group)
    {
        return view('admin.groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|max:50|unique:groups,name,'.$group->id,
            'description' => 'nullable|max:255'
        ]);

        $group->update($request->all());
        toastr()->success('تم تحديث المجموعة بنجاح');
        return redirect()->route('admin.groups.index');
    }

    public function destroy(Group $group)
    {
        $group->delete();
        toastr()->success('تم حذف المجموعة بنجاح');
        return back();
    }
}

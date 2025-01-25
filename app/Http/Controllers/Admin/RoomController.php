<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:rooms|max:50',
            'location' => 'nullable|max:255'
        ]);

        Room::create($request->all());
        toastr()->success('تم إنشاء القاعة بنجاح');
        return redirect()->route('admin.rooms.index');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'code' => 'required|max:50|unique:rooms,code,'.$room->id,
            'location' => 'nullable|max:255'
        ]);

        $room->update($request->all());
        toastr()->success('تم تحديث القاعة بنجاح');
        return redirect()->route('admin.rooms.index');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        toastr()->success('تم حذف القاعة بنجاح');
        return back();
    }
}

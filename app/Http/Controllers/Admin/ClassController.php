<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ClassModel, Course, Department, Instructor, Room, Group, Period, Semester, User};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with(['course', 'instructor', 'room', 'group', 'period'])
            ->orderBy('day')
            ->orderBy('period_id')
            ->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $data = [
            'courses' => Course::all(),
            'instructors' => Instructor::all(),
            'rooms' => Room::all(),
            'groups' => Group::all(),
            'periods' => Period::orderBy('number')->get(),
            'days' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'],
            'types' => ['lecture', 'lab', 'clinical', 'practical', 'self_learning']
        ];

        return view('admin.classes.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:instructors,id',
            'room_id' => 'required|exists:rooms,id',
            'group_id' => 'required|exists:groups,id',
            'period_id' => 'required|exists:periods,id',
            'day' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday',
            'type' => 'required|in:lecture,lab,clinical,practical,self_learning'
        ]);

        // التحقق من عدم وجود تعارضات
        $conflict = ClassModel::where('day', $request->day)
            ->where('period_id', $request->period_id)
            ->where(function($query) use ($request) {
                $query->where('room_id', $request->room_id)
                    ->orWhere('instructor_id', $request->instructor_id)
                    ->orWhere('group_id', $request->group_id);
            })->exists();
        if ($conflict) {
            toastr()->error('هناك تعارض في الجدول الزمني');
            return back()->withInput();
        }
        ClassModel::create($request->all());
        toastr()->success('تمت إضافة الحصة بنجاح');
        return redirect()->route('admin.classes.index');
    }

    public function edit(ClassModel $class)
    {

        $data = [
            'class' => $class,
            'courses' => Course::all(),
            'instructors' => Instructor::all(),
            'rooms' => Room::all(),
            'groups' => Group::all(),
            'periods' => Period::orderBy('number')->get(),
            'days' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'],
            'types' => ['lecture', 'lab', 'clinical', 'practical', 'self_learning']
        ];

        return view('admin.classes.edit', $data);
    }

    public function update(Request $request, ClassModel $class)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:instructors,id',
            'room_id' => 'required|exists:rooms,id',
            'group_id' => 'required|exists:groups,id',
            'period_id' => 'required|exists:periods,id',
            'day' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday',
            'type' => 'required|in:lecture,lab,clinical,practical,self_learning'
        ]);
        // التحقق من التعارضات مع استثناء الحصة الحالية
        $conflict = ClassModel::where('id', '!=', $class->id)
            ->where('day', $request->day)
            ->where('period_id', $request->period_id)
            ->where(function($query) use ($request) {
                $query->where('room_id', $request->room_id)
                    ->orWhere('instructor_id', $request->instructor_id)
                    ->orWhere('group_id', $request->group_id);
            })->exists();

        if ($conflict) {
            toastr()->error('هناك تعارض في الجدول الزمني');
            return back()->withInput();
        }

        $class->update($request->all());

        toastr()->success('تم تحديث الحصة بنجاح');
        return redirect()->route('admin.classes.index');
    }

    public function destroy(ClassModel $class)
    {
        try {
            $class->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'حدث خطأ أثناء الحذف'], 500);
        }
    }

    public function timetable($departmentId = null, $groupId = null, $semesterId = null)
    {
        $group = null;
        $semester = null;
        $department = null;
        $classes = collect();
        $periods = Period::orderBy('number')->get();
        $instructors = [];

        if ($departmentId) {
            $department = Department::find($departmentId);
            $instructors = User::where('role', 'teacher')->whereHas('departments', function ($q) use ($departmentId){
                $q->where('department_id', $departmentId);
            })->get();
        }

        if ($groupId && $semesterId) {
            $group = Group::find($groupId);

            $semester = Semester::find($semesterId);

            if ($group && $semester) {

                $classes = ClassModel::with(['course', 'room', 'department'])
                    ->where('group_id', $groupId)
                    ->where('semester_id', $semesterId)
                    ->where('department_id', $departmentId)
                    ->get();

            }

        }

        $courses = Course::where('level_id', optional($semester)->level_id)->get();
        $groups = Group::all();
        $semesters = Semester::all();
        $rooms = Room::all();

        $departments = Department::all();
        return view('admin.timetable', compact(
            'group', 'semester', 'classes', 'periods', 'groups',
            'semesters', 'departments', 'department', 'courses', 'instructors', 'rooms'
        ));
    }


    public function updateTimeTable(Request $request)
    {
        try {
            // التحقق من صحة البيانات المدخلة
            $validated = $request->validate([
                'id' => 'nullable|exists:classes,id',
                'course_id' => 'required|exists:courses,id',
                'instructor_id' => 'required|exists:instructors,id',
                'room_id' => 'required|exists:rooms,id',
                'group_id' => 'required|exists:groups,id',
                'period_id' => 'required|exists:periods,id',
                'semester_id' => 'required|exists:semesters,id',
                'department_id' => 'required|exists:departments,id',
                'day' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday',
                'type' => 'required|in:lecture,lab,clinical,practical,self_learning'
            ]);
            // بناء استعلام التحقق من التعارضات
            $conflictQuery = ClassModel::where('day', $validated['day'])
                ->where('period_id', $validated['period_id'])
                ->where('semester_id', $validated['semester_id'])
                ->where('department_id', $validated['department_id']); // إضافة شرط القسم

            // إضافة شروط التعارضات
            $conflictQuery->where(function($query) use ($validated) {
                $query->where('room_id', $validated['room_id'])
                    ->orWhere('instructor_id', $validated['instructor_id'])
                    ->orWhere('group_id', $validated['group_id']);
            });

            // استثناء الحصة الحالية في حالة التحديث
            if (isset($validated['id'])) {
                $conflictQuery->where('id', '!=', $validated['id']);
            }

            // التنفيذ والتحقق من النتيجة
            if ($conflictQuery->exists()) {
                return response()->json([
                    'error' => 'تعارض في الجدول الزمني:
            - حصة موجودة بنفس الوقت/القاعة/المحاضر/المجموعة
            - في نفس القسم والفصل الدراسي'
                ], 422);
            }
            ClassModel::updateOrCreate(
                ['id' => $request->id],
                $validated
            );
            return response()->json([
                'success' => true,
                'message' => 'تم حفظ الجدول بنجاح'
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function getCoursesAndTeachers(Request $request): JsonResponse
    {
        $semesterId = $request->semester_id;
        $departmentId = $request->department_id;

        if (!$semesterId || !$departmentId) {
            return response()->json(['courses' => [], 'teachers' => []]);
        }

        // Get courses related to semester via level
        $semester = Semester::find($semesterId);
        $courses = Course::where('level_id', $semester->level_id)->get();

        // Get teachers related to department
        $teachers = User::where('role', 'teacher')
            ->whereHas('departments', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->get();

        return response()->json(['courses' => $courses, 'teachers' => $teachers]);
    }

}

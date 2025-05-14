@extends('admin.main')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/time.css')}}">
@endpush

@section('content')
    <main class="app-content">
    <div class="app-title">
        <h1><i class="fa fa-calendar-alt"></i> Timetable - Group {{ $group->name ?? 'N/A' }}</h1>
        <button class="btn btn-primary float-right" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
    </div>
    <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">

                        <div class="card-body">
                            <form id="timetableFilter">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>السنه / الفصل الدراسي </label>
                                            <select name="semester_id" class="form-control select2" required>
                                                <option value=""> اختر</option>
                                                @foreach($semesters as $s)
                                                    <option value="{{ $s->id }}"
                                                        {{ ($semester && $s->id == $semester->id) ? 'selected' : '' }}>
                                                        {{ optional($s->year)->year }} - {{ optional($s->level)->name }} [{{ $s->semester_number }}]
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>الاقسام</label>
                                            <select name="department_id" class="form-control select2" required>
                                                <option value="">اختر </option>
                                                @foreach($departments as $d)
                                                    <option value="{{ $d->id }}" {{ ($department && $d->id == $department->id) ? 'selected' : '' }}>
                                                        {{ $d->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>المجموعات</label>
                                            <select name="group_id" class="form-control select2" required>
                                                <option value="">اختر </option>
                                                @foreach($groups as $g)
                                                    <option value="{{ $g->id }}"
                                                        {{ ($group && $g->id == $group->id) ? 'selected' : '' }}>
                                                        {{ $g->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-2 ">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                @if($group && $semester && $department)
                <!-- Header Section -->
                <div class="timetable-header text-center mb-4">
{{--                    <h3 class="text-primary">PRINCE SULTAN MILITARY COLLEGE OF HEALTH SCIENCES DHAHRAN</h3>--}}
                    <h5>Office of the Registrar - Group Semester Schedule</h5>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            @include('admin.course-table', ['courses' => $courses])

                        </div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-4 timeCourde">
                            <p class="mb-0"><strong>Program:</strong> {{ $group->name ?? 'N/A' }}</p>
                            <p class="mb-0"><strong>Speciality:</strong> {{ $department->name ?? 'N/A' }}</p>
                            <p class="mb-0"><strong>Semester:</strong> {{ optional($semester->level)->level }} {{ optional($semester->year)->year }}</p>
                            <p class="mb-0"><strong>Duration:</strong>{{ $semester->start_date->format('m/d/Y') }} - {{ $semester->end_date->format('m/d/Y') }}</p>
                        </div>

                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered timetable">
                        <thead class="timetable-head">
                        <tr>
                            <th style="width: 12%">Period/Day</th>
                            @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'] as $day)
                                <th>{{ $day }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($periods as $period)
                            <tr class="{{ $period->is_break ? 'break-row' : '' }}">
                                <td class="period-cell bg-light">
                                    <div class="period-time">
                                        {{ date('h:i A', strtotime($period->start_time)) }} - {{ date('h:i A', strtotime($period->end_time)) }}
                                    </div>
                                    @if(!$period->is_break)
                                        <div class="period-number">Period {{ $period->number }}</div>
                                    @endif
                                </td>
                                @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'] as $day)
                                    <td class="clickable-cell {{ $classes->where('day', $day)->where('period_id', $period->id)->count() ? 'has-class' : '' }}"
                                        data-day="{{ $day }}"
                                        data-period="{{ $period->id }}"
                                        data-toggle="modal"
                                        data-target="#editModal"
                                        style="min-height: 80px; {{ $period->is_break ? 'background: #fff3cd;' : '' }}">
                                        @if($period->is_break)
                                            <div class="text-center text-muted">Break</div>
                                        @else
                                            @foreach($classes->where('day', $day)->where('period_id', $period->id) as $class)
                                                <div class="course-info p-2" data-class="{{$class->id}}">
                                                    <strong class="d-block text-primary">{{ $class->course->code }}</strong>
                                                    <small class="text-muted">{{ $class->course->title }}</small>
                                                    <div class="details mt-1">
                                                        <span class="badge
                                                            @if($class->type == 'clinical') badge-danger
                                                            @elseif($class->type == 'lab') badge-warning
                                                            @elseif($class->type == 'practical') badge-success
                                                            @else badge-info @endif">
                                                            {{ ucfirst($class->type) }}
                                                        </span>
                                                        <div class="text-sm">
                                                            <i class="fa fa-map-marker"></i> {{ $class->room->code }}
                                                            <br>
                                                            <i class="fa fa-user"></i> {{ $class->instructor->name }}
                                                        </div>

                                                    </div>
                                                    <button class="btn btn-sm btn-danger float-right delete-class"
                                                            data-class-id="{{ $class->id }}"
                                                            data-semester-id="{{ $class->semester_id }}"
                                                            title="حذف الحصة">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            الرجاء تحديد المجموعة والفصل الدراسي لعرض الجدول الزمني.
                        </div>
                @endif
                <!-- Legend -->
                <div class="legend mt-4 p-3 border-top">
                    <h6>Legend:</h6>
                    <span class="badge badge-info mr-2">Lecture</span>
                    <span class="badge badge-danger mr-2">Clinical</span>
                    <span class="badge badge-warning mr-2">Lab</span>
                    <span class="badge badge-success mr-2">Practical</span>
                </div>
            </div>
        </div>
    </div>
    </main>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="classForm">
                    @csrf
                    <input type="hidden" name="day" id="modalDay">
                    <input type="hidden" name="period_id" id="modalPeriod">
                    <input type="hidden" name="id" id="modalClassId">

                    <input type="hidden" name="group_id" value="{{ $group->id ?? null}}">
                    <input type="hidden" name="semester_id" value="{{ $semester->id ?? null }}">
                    <input type="hidden" name="department_id" value="{{ $department->id ?? null }}">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>المقرر</label>
                                    <select name="course_id" class="form-control" required>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->code }} - {{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>المحاضر</label>
                                    <select name="instructor_id" class="form-control" required>
                                        @foreach($instructors as $instructor)
                                            <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>القاعة</label>
                                    <select name="room_id" class="form-control" required>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->code }} ({{ $room->location }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>نوع الحصة</label>
                                    <select name="type" class="form-control" required>
                                        <option value="lecture">محاضرة</option>
                                        <option value="lab">معمل</option>
                                        <option value="clinical">سريري</option>
                                        <option value="practical">عملي</option>
                                        <option value="self_learning">تعلم ذاتي</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <!-- Keep existing scripts with translated labels -->
    <script>
        // Print functionality
        function printTimetable() {
            window.print();
        }
        document.getElementById('timetableFilter').addEventListener('submit', function(e) {
            e.preventDefault();
            const departmentId = document.querySelector('[name="department_id"]').value;

            const groupId = document.querySelector('[name="group_id"]').value;
            const semesterId = document.querySelector('[name="semester_id"]').value;
            if (!departmentId || !groupId || !semesterId) {
                alert('الرجاء تحديد القسم والمجموعة والفصل الدراسي!');
                return;
            }
            window.location.href = "{{ route('admin.timetable', ['departmentId' => ':departmentId', 'groupId' => ':groupId', 'semesterId' => ':semesterId']) }}"
                .replace(':departmentId', departmentId)
                .replace(':groupId', groupId)
                .replace(':semesterId', semesterId);

        });
        $(document).ready(function() {
            $('.clickable-cell').click(function() {
                const classDataINFO = $(this).find('.course-info').data('class');
                const day = $(this).data('day');
                const periodId = $(this).data('period');
                const classData = $(this).data('class');
                $('#modalClassId').val(classDataINFO);
                if (classData) {

                    $('#classForm').find('[name="semester_id"]').val(classData.semester_id);
                    $('#classForm').find('[name="department_id"]').val(classData.department_id);
                    $('#classForm').find('[name="course_id"]').val(classData.course_id);
                    $('#classForm').find('[name="instructor_id"]').val(classData.instructor_id);
                    $('#classForm').find('[name="room_id"]').val(classData.room_id);
                    $('#classForm').find('[name="type"]').val(classData.type);
                }
                $('#modalDay').val(day);
                $('#modalPeriod').val(periodId);
            });

            $('#classForm').submit(function(e) {
                e.preventDefault();
                const $btn = $(this).find('button[type="submit"]');
                $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> جاري الحفظ...');
                $.ajax({
                    url: "{{ route('admin.classes.store2') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#editModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.error || 'حدث خطأ غير متوقع');
                    }
                });
            });
        });

        // حذف الحصة مع التأكيد
        $(document).on('click', '.delete-class', function(e) {
            e.stopPropagation();
            const $btn = $(this);
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            const classId = $(this).data('class-id');

            if (confirm('هل أنت متأكد من رغبتك في حذف هذه الحصة؟')) {
                $.ajax({
                    url: `/admin/classes/${classId}`,
                    method: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('حدث خطأ أثناء الحذف');
                    }
                });
            }
        });
    </script>
@endpush

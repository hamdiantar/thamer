@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-calendar-alt"></i> {{ __('إنشاء الجدول الزمني') }}</h1>
        </div>

        <form method="POST" action="{{ route('admin.timetables.store') }}">
            @csrf

            <div class="form-group">
                <label>المجموعة</label>
                <select name="group_id" class="form-control select2" required>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>الفصل الدراسي</label>
                <select name="semester_id" id="semesterSelect" class="form-control select2" required>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>القسم</label>
                <select name="department_id" id="departmentSelect" class="form-control select2" required>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>المقرر</th>
                    <th>اليوم</th>
                    <th>الفترة</th>
                    <th>الغرفة</th>
                    <th>المعلم</th>
                </tr>
                </thead>
                <tbody id="scheduleTable">
                <!-- Rows will be generated dynamically -->
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">حفظ الجدول</button>
        </form>
    </main>

@endsection

@push('js')
    <script>
        $('#semesterSelect').change(function() {
            $.post('{{ route("admin.timetables.getCourses") }}',
                {semester_id: $(this).val(), _token: '{{ csrf_token() }}'},
                function(data) {
                    let coursesHtml = '';
                    data.forEach(course => {
                        coursesHtml += `<tr>
                                            <td>${course.title}</td>
                                            <td>
                                                <select name="schedules[][day]" class="form-control">
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="schedules[][period_id]" class="form-control">
                                                    @foreach($periods as $period)
                        <option value="{{ $period->id }}">{{ $period->start_time }} - {{ $period->end_time }}</option>
                                                    @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="schedules[][room_id]" class="form-control">
                            <option value="">-- اختر الغرفة --</option>
@foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->code }}</option>
                                                    @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="schedules[][instructor_id]" class="form-control">
                            <option value="">-- اختر المعلم --</option>
                        </select>
                    </td>
                </tr>`;
                    });
                    $('#scheduleTable').html(coursesHtml);
                }
            );
        });

        $('#departmentSelect').change(function() {
            $.post('{{ route("admin.timetables.getTeachers") }}',
                {department_id: $(this).val(), _token: '{{ csrf_token() }}'},
                function(data) {
                    let teacherOptions = '<option value="">-- اختر المعلم --</option>';
                    data.forEach(teacher => {
                        teacherOptions += `<option value="${teacher.id}">${teacher.name}</option>`;
                    });
                    $('select[name="schedules[][instructor_id]"]').html(teacherOptions);
                }
            );
        });
    </script>
@endpush

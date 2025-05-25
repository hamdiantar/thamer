@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-calendar-alt"></i> Timetable - Group {{ $group->name ?? 'N/A' }}</h1>
            <button class="btn btn-primary float-right" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
        </div>
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <!-- إضافة هذا الجزء فوق الجدول -->
                    @if($group != null || $semester != null)
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            الرجاء تحديد المجموعة والفصل الدراسي لعرض الجدول الزمني.
                        </div>
                    @else
                        <div class="card-body">
                            <form id="timetableFilter">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select name="semester_id" class="form-control" required>
                                                <option value="">Select Semester</option>
                                                @foreach($semesters as $s)
                                                    <option value="{{ $s->id }}"
                                                        {{ ($semester && $s->id == $semester->id) ? 'selected' : '' }}>
                                                        {{ $s->year }} - {{ $s->season }} (Sem {{ $s->semester_number }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Group</label>
                                            <select name="group_id" class="form-control" required>
                                                <option value="">Select Group</option>
                                                @foreach($groups as $g)
                                                    <option value="{{ $g->id }}"
                                                        {{ ($group && $g->id == $group->id) ? 'selected' : '' }}>
                                                        {{ $g->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-2 align-self-end">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fa fa-refresh"></i> تحميل الجدول
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <!-- Header Section -->
                    <div class="timetable-header text-center mb-4">
                        {{--                    <img src="{{ asset('img/college-logo.png') }}" alt="College Logo" class="logo mb-3" style="height: 80px;">--}}
                        <h3 class="text-primary">Prince Sultan Military College of Health Sciences Dhahran</h3>
                        <h5>Second Semester Schedule 2024-2025</h5>
                        <p class="text-muted">Bachelor of Anesthesia Technology | Group: {{ $group->name ?? 'N/A' }}</p>
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
                                                    <div class="course-info p-2">fffffffffffff
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
                    <input type="hidden" name="group_id" value="{{ $group->id ?? null}}">

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

@push('css')
    <style>
        .timetable {
            border: 2px solid #002F5F;
        }

        .timetable th {
            background: #002F5F;
            color: white;
            text-align: center;
            font-size: 1.1em;
        }

        .period-cell {
            background: #f8f9fa !important;
            text-align: center;
        }

        .course-info {
            border-radius: 4px;
            margin: 2px;
            background: rgba(255, 255, 255, 0.9);
        }

        .has-class {
            background: #e3f2fd !important;
        }

        .break-row td {
            background: #fff3cd !important;
            font-weight: bold;
        }
        .card {
            border: 1px solid #002F5F;
            border-radius: 8px;
        }
        .card-body {
            padding: 1.5rem;
        }
        @media print {
            body {
                padding: 20px;
                font-size: 12px;
            }

            .app-title, .legend, .modal {
                display: none !important;
            }

            .timetable-header {
                display: block !important;
                text-align: center;
                margin-bottom: 15px;
            }

            .logo {
                height: 60px !important;
            }

            .timetable {
                page-break-inside: avoid;
            }

            .course-info {
                background: white !important;
            }

            .badge {
                border: 1px solid #000;
                background: white !important;
                color: black !important;
            }
        }
    </style>
@endpush

@push('js')
    <!-- Keep existing scripts with translated labels -->
    <script>
        // Print functionality
        function printTimetable() {
            window.print();
        }
        document.getElementById('timetableFilter').addEventListener('submit', function(e) {
            e.preventDefault();

            const groupId = document.querySelector('[name="group_id"]').value;
            const semesterId = document.querySelector('[name="semester_id"]').value;
            if (!groupId || !semesterId) {
                alert('الرجاء تحديد المجموعة والفصل الدراسي!');
                return;
            }
            window.location.href = "{{ route('admin.timetable', ['groupId' => ':groupId', 'semesterId' => ':semesterId']) }}"
                .replace(':groupId', groupId)
                .replace(':semesterId', semesterId);

        });
        $(document).ready(function() {
            $('.clickable-cell').click(function() {
                const day = $(this).data('day');
                const periodId = $(this).data('period');
                const classData = $(this).data('class');
                if (classData) {
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
    </script>
@endpush

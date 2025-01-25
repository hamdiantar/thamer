@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-calendar-alt"></i> الجدول الزمني</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">قائمة الحصص</h3>
                        <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> إضافة حصة
                        </a>
                    </div>

                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>المقرر</th>
                            <th>المحاضر</th>
                            <th>القاعة</th>
                            <th>المجموعة</th>
                            <th>الفترة</th>
                            <th>اليوم</th>
                            <th>النوع</th>
                            <th>الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <td>{{ $class->course->title }}</td>
                                <td>{{ $class->instructor->name }}</td>
                                <td>{{ $class->room->code }}</td>
                                <td>{{ $class->group->name }}</td>
                                <td>{{ $class->period->number }}</td>
                                <td>{{ $class->day }}</td>
                                <td>{{ $class->type }}</td>
                                <td>
                                    <a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form class="d-inline" action="{{ route('admin.classes.destroy', $class) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

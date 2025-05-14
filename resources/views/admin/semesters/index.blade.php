@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-calendar-alt"></i> {{ __('إدارة الفصول الدراسية') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('قائمة الفصول الدراسية') }}</h3>
                        <a href="{{ route('admin.semesters.create') }}" class="btn float-right btn-primary">
                            <i class="fa fa-plus"></i> {{ __('إضافة فصل دراسي') }}
                        </a>
                    </div>
                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('السنة') }}</th>
                            <th>{{ __('المستوى') }}</th>
                            <th>{{ __('رقم الفصل') }}</th>
                            <th>{{ __('تاريخ البداية') }}</th>
                            <th>{{ __('تاريخ النهاية') }}</th>
                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($semesters as $index=>$semester)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $semester->year->year }}</td>
                                <td>{{ $semester->level->name }}</td>
                                <td>{{ $semester->semester_number }}</td>
                                <td>{{ $semester->start_date->format('Y-m-d') }}</td>
                                <td>{{ $semester->end_date->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.semesters.edit', $semester->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.semesters.destroy', $semester->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">
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

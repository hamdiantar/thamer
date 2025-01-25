@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-book"></i> {{ __('المقررات الدراسية') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('قائمة المقررات') }}</h3>
                        <a href="{{ route('admin.courses.create') }}" class="btn float-right btn-primary">
                            <i class="fa fa-plus"></i> {{ __('إضافة مقرر') }}
                        </a>
                    </div>
                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('الكود') }}</th>
                            <th>{{ __('اسم المقرر') }}</th>
                            <th>{{ __('المستوى') }}</th>
                            <th>{{ __('الساعات') }}</th>
                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($courses as $index=>$course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $course->code }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->level }}</td>
                                <td>{{ $course->sch }}</td>
                                <td>
                                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a onclick="confirmation('deleteForm{{$course->id}}', '')" class="btn btn-danger btn-sm" href="#">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form id="deleteForm{{$course->id}}" method="post" action="{{ route('admin.courses.destroy', $course->id) }}">
                                        @csrf @method('DELETE')
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

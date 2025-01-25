@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-chalkboard-teacher"></i> {{ __('إدارة المحاضرين') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('قائمة المحاضرين') }}</h3>
                        <a href="{{ route('admin.instructors.create') }}" class="btn float-right btn-primary">
                            <i class="fa fa-plus"></i> {{ __('إضافة محاضر') }}
                        </a>
                    </div>
                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('الكود') }}</th>
                            <th>{{ __('الاسم') }}</th>
                            <th>{{ __('التخصصات') }}</th>
                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($instructors as $index=>$instructor)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $instructor->code }}</td>
                                <td>{{ $instructor->name }}</td>
                                <td>
                                    @foreach($instructor->departments as $department)
                                        <span class="badge badge-primary">{{ $department->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.instructors.edit', $instructor->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.instructors.destroy', $instructor->id) }}" method="POST" class="d-inline">
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

@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-sitemap"></i> {{ __('إدارة الأقسام') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('قائمة الأقسام') }}</h3>
                        <a href="{{ route('admin.departments.create') }}" class="btn float-right btn-primary">
                            <i class="fa fa-plus"></i> {{ __('إضافة قسم') }}
                        </a>
                    </div>
                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('اسم القسم') }}</th>
                            <th>{{ __('رئيس القسم') }}</th>
                            <th>{{ __('الوصف') }}</th>
                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($departments as $index=>$department)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->head ? $department->head->name : 'غير معين' }}</td>
                                <td>{{ Str::limit($department->description, 50) }}</td>
                                <td>
                                    <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.departments.destroy', $department) }}" method="POST" class="d-inline">
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

@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-list"></i> {{ __('إدارة المستويات') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('قائمة المستويات') }}</h3>
                        <a href="{{ route('admin.levels.create') }}" class="btn btn-primary ml-auto">
                            <i class="fa fa-plus"></i> {{ __('إضافة مستوى') }}
                        </a>
                    </div>
                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>{{ __('رقم') }}</th>
                            <th>{{ __('المستوى') }}</th>
                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($levels as $level)
                            <tr>
                                <td>{{ $level->id }}</td>
                                <td>{{ $level->name }}</td>
                                <td>
                                    <a href="{{ route('admin.levels.edit', $level->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.levels.destroy', $level->id) }}" method="POST" class="d-inline">
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

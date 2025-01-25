@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-clock"></i> {{ __('إدارة الفترات الزمنية') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('جدول الفترات') }}</h3>
                        <a href="{{ route('admin.periods.create') }}" class="btn float-right btn-primary">
                            <i class="fa fa-plus"></i> {{ __('إضافة فترة') }}
                        </a>
                    </div>
                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>{{ __('الرقم') }}</th>
                            <th>{{ __('وقت البدء') }}</th>
                            <th>{{ __('وقت الانتهاء') }}</th>
                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($periods as $period)
                            <tr>
                                <td>{{ $period->number }}</td>
                                <td>{{ date('h:i A', strtotime($period->start_time)) }}</td>
                                <td>{{ date('h:i A', strtotime($period->end_time)) }}</td>
                                <td>
                                    <a href="{{ route('admin.periods.edit', $period) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.periods.destroy', $period) }}" method="POST" class="d-inline">
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

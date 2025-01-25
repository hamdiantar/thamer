@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-plus-circle"></i> {{ __('إضافة فترة جديدة') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">إضافة فترة</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('بيانات الفترة') }}</h3>
                        <a href="{{ route('admin.periods.index') }}" class="btn btn-danger ml-auto">
                            <i class="fa fa-arrow-left"></i> رجوع
                        </a>
                    </div>

                    <div class="tile-body">
                        <form action="{{ route('admin.periods.store') }}" method="POST">
                            @csrf
                            @include('admin.periods.form')
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> {{ __('حفظ') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

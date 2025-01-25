@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-plus-circle"></i> {{ __('إضافة مقرر جديد') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">إضافة مقرر</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('تفاصيل المقرر الجديد') }}</h3>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-danger ml-auto">
                            <i class="fa fa-arrow-left"></i> رجوع للقائمة
                        </a>
                    </div>

                    <div class="tile-body">
                        @include('admin.courses.form')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

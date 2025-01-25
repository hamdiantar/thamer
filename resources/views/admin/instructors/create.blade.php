@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-user-plus"></i> {{ __('إضافة محاضر جديد') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">إضافة محاضر</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('بيانات المحاضر') }}</h3>
                        <a href="{{ route('admin.instructors.index') }}" class="btn btn-danger ml-auto">
                            <i class="fa fa-arrow-left"></i> رجوع
                        </a>
                    </div>

                    <div class="tile-body">
                        <form action="{{ route('admin.instructors.store') }}" method="POST">
                            @csrf
                            @include('admin.instructors.form')
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

@push('scripts')
    <script>
        $('.select2').select2({
            placeholder: "اختر التخصصات",
            dir: "rtl"
        });
    </script>
@endpush

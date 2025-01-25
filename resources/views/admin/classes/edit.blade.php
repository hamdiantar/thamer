@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> {{ __('تعديل الحصة') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="breadcrumb-item active">تعديل حصة</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form action="{{ route('admin.classes.update', $class) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('admin.classes.form')

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-warning btn-lg">
                                    <i class="fa fa-edit"></i> {{ __('تحديث') }}
                                </button>
                                <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fa fa-times"></i> {{ __('إلغاء') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "اختر",
                dir: "rtl"
            });
        });
    </script>
@endpush

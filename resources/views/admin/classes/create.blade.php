@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-plus-circle"></i> {{ __('إضافة حصة جديدة') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="breadcrumb-item active">إضافة حصة</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form action="{{ route('admin.classes.store') }}" method="POST">
                            @csrf
                        @include('admin.classes.form')

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fa fa-save"></i> {{ __('حفظ') }}
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

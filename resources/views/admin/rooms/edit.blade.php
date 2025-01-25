@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> {{ __('تعديل بيانات القاعة') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">تعديل قاعة</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('تحديث البيانات') }}</h3>
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-danger ml-auto">
                            <i class="fa fa-arrow-left"></i> رجوع
                        </a>
                    </div>

                    <div class="tile-body">
                        <form action="{{ route('admin.rooms.update', $room) }}" method="POST">
                            @csrf @method('PUT')
                            @include('admin.rooms.form')
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-edit"></i> {{ __('تحديث') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-plus-circle"></i> {{ __('إضافة مستوى جديد') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <form action="{{ route('admin.levels.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('اسم المستوى') }}</label>
                            <input type="text" name="name" class="form-control" required>
                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ __('حفظ') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

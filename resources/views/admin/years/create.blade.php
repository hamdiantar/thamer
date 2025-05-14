@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-plus-circle"></i> {{ __('إضافة سنة جديدة') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <form action="{{ route('admin.years.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('السنة') }}</label>
                            <input type="number" name="year" class="form-control" min="1900" max="2100" required>
                            @error('year')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ __('حفظ') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

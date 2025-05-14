@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-edit"></i> {{ __('تعديل السنة') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <form action="{{ route('admin.years.update', $year->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>{{ __('السنة') }}</label>
                            <input type="number" name="year" class="form-control" value="{{ old('year', $year->year) }}" min="1900" max="2100" required>
                            @error('year')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{ __('تحديث') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

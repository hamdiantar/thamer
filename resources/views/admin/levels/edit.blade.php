@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1><i class="fa fa-edit"></i> {{ __('تعديل المستوى') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <form action="{{ route('admin.levels.update', $level->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>{{ __('اسم المستوى') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $level->name) }}" required>
                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{ __('تحديث') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

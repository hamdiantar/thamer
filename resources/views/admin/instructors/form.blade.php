<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('كود المحاضر') }}</label>
            <input type="text" name="code" class="form-control"
                   value="{{ old('code', $instructor->code ?? '') }}" required>
            @error('code')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('اسم المحاضر') }}</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $instructor->name ?? '') }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('التخصصات') }}</label>
            <select name="departments[]" class="form-control select2" multiple required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ isset($instructor) && $instructor->departments->contains($department->id) ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

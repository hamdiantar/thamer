<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('اسم القسم') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $department->name ?? '') }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('الوصف') }}</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $department->description ?? '') }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

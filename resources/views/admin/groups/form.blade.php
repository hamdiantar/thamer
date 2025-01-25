<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('اسم المجموعة') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $group->name ?? '') }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('الوصف') }}</label>
            <input type="text" name="description" class="form-control"
                   value="{{ old('description', $group->description ?? '') }}">
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

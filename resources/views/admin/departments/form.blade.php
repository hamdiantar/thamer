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

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('رئيس القسم') }}</label>
            <select name="head_id" class="form-control select2">
                <option value="">{{ __('اختر رئيس القسم') }}</option>
                @foreach ($heads as $head)
                    <option value="{{ $head->id }}" {{ old('head_id', $department->head_id ?? '') == $head->id ? 'selected' : '' }}>
                        {{ $head->name }}
                    </option>
                @endforeach
            </select>
            @error('head_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('المحاضريين') }}</label>
            <select name="teachers[]" class="form-control select2" multiple>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        {{ isset($department) && $department->teachers->contains($teacher->id) ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
            @error('teachers')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

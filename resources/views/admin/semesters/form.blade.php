<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('السنة') }}</label>
            <input type="number" name="year" class="form-control"
                   value="{{ old('year', $semester->year ?? '') }}"
                   min="1901" max="2155" required>
            @error('year')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('الفصل') }}</label>
            <select name="season" class="form-control" required>
                <option value="Fall" {{ (old('season', $semester->season ?? '') == 'Fall') ? 'selected' : '' }}>
                    {{ __('الخريف') }}
                </option>
                <option value="Spring" {{ (old('season', $semester->season ?? '') == 'Spring') ? 'selected' : '' }}>
                    {{ __('الربيع') }}
                </option>
                <option value="Summer" {{ (old('season', $semester->season ?? '') == 'Summer') ? 'selected' : '' }}>
                    {{ __('الصيف') }}
                </option>
            </select>
            @error('season')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('رقم الفصل') }}</label>
            <input type="number" name="semester_number" class="form-control"
                   value="{{ old('semester_number', $semester->semester_number ?? '') }}"
                   min="1" max="3" required>
            @error('semester_number')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('تاريخ البداية') }}</label>
            <input type="date" name="start_date" class="form-control"
                   value="{{ old('start_date', isset($semester) ? $semester->start_date->format('Y-m-d') : '') }}" required>
            @error('start_date')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('تاريخ النهاية') }}</label>
            <input type="date" name="end_date" class="form-control"
                   value="{{ old('end_date', isset($semester) ? $semester->end_date->format('Y-m-d') : '') }}" required>
            @error('end_date')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('السنة') }}</label>
            <select name="year_id" class="form-control select2" required>
                <option value="">{{ __('اختر السنة') }}</option>
                @foreach ($years as $year)
                    <option value="{{ $year->id }}" {{ old('year_id', $semester->year_id ?? '') == $year->id ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
            @error('year_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('المستوى') }}</label>
            <select name="level_id" class="form-control select2" required>
                <option value="">{{ __('اختر المستوى') }}</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}" {{ old('level_id', $semester->level_id ?? '') == $level->id ? 'selected' : '' }}>
                        {{ $level->name }}
                    </option>
                @endforeach
            </select>
            @error('level_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
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
                   value="{{ old('start_date', $semester->start_date ?? '') }}" required>
            @error('start_date')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('تاريخ النهاية') }}</label>
            <input type="date" name="end_date" class="form-control"
                   value="{{ old('end_date', $semester->end_date ?? '') }}" required>
            @error('end_date')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

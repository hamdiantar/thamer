<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('رقم الفترة') }} <span class="text-danger">*</span></label>
            <input type="number" name="number" class="form-control"
                   value="{{ old('number', $period->number ?? '') }}" min="1" max="10" required>
            @error('number')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('وقت البدء') }} <span class="text-danger">*</span></label>
            <input type="time" name="start_time" class="form-control"
                   value="{{ old('start_time', $period->start_time ?? '') }}" required>
            @error('start_time')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('وقت الانتهاء') }} <span class="text-danger">*</span></label>
            <input type="time" name="end_time" class="form-control"
                   value="{{ old('end_time', $period->end_time ?? '') }}" required>
            @error('end_time')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

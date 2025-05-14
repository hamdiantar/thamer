<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('كود القاعة') }} <span class="text-danger">*</span></label>
            <input type="text" name="code" class="form-control"
                   value="{{ old('code', $room->code ?? '') }}" required>
            @error('code')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('الموقع') }}</label>
            <input type="text" name="location" class="form-control"
                   value="{{ old('location', $room->location ?? '') }}">
            @error('location')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

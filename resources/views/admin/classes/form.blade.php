<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('المقرر') }} <span class="text-danger">*</span></label>
            <select name="course_id" class="form-control select2" required>
                <option value="">-- اختر المقرر --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ ($schedule->course_id ?? old('course_id')) == $course->id ? 'selected' : '' }}>
                        {{ $course->code }} - {{ $course->title }}
                    </option>
                @endforeach
            </select>
            @error('course_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('المحاضر') }} <span class="text-danger">*</span></label>
            <select name="instructor_id" class="form-control select2" required>
                <option value="">-- اختر المحاضر --</option>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}" {{ ($schedule->instructor_id ?? old('instructor_id')) == $instructor->id ? 'selected' : '' }}>
                        {{ $instructor->name }}
                    </option>
                @endforeach
            </select>
            @error('instructor_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('القاعة') }} <span class="text-danger">*</span></label>
            <select name="room_id" class="form-control select2" required>
                <option value="">-- اختر القاعة --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ ($schedule->room_id ?? old('room_id')) == $room->id ? 'selected' : '' }}>
                        {{ $room->code }} ({{ $room->location }})
                    </option>
                @endforeach
            </select>
            @error('room_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('المجموعة') }} <span class="text-danger">*</span></label>
            <select name="group_id" class="form-control select2" required>
                <option value="">-- اختر المجموعة --</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ ($schedule->group_id ?? old('group_id')) == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
            @error('group_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('الفترة') }} <span class="text-danger">*</span></label>
            <select name="period_id" class="form-control select2" required>
                <option value="">-- اختر الفترة --</option>
                @foreach($periods as $period)
                    <option value="{{ $period->id }}" {{ ($schedule->period_id ?? old('period_id')) == $period->id ? 'selected' : '' }}>
                        الفترة {{ $period->number }} ({{ date('h:i A', strtotime($period->start_time)) }} - {{ date('h:i A', strtotime($period->end_time)) }})
                    </option>
                @endforeach
            </select>
            @error('period_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('اليوم') }} <span class="text-danger">*</span></label>
            <select name="day" class="form-control" required>
                @foreach($days as $day)
                    <option value="{{ $day }}" {{ ($schedule->day ?? old('day')) == $day ? 'selected' : '' }}>
                        {{ __($day) }}
                    </option>
                @endforeach
            </select>
            @error('day')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('نوع الحصة') }} <span class="text-danger">*</span></label>
            <select name="type" class="form-control" required>
                @foreach($types as $type)
                    <option value="{{ $type }}" {{ ($schedule->type ?? old('type')) == $type ? 'selected' : '' }}>
                        {{ __($type) }}
                    </option>
                @endforeach
            </select>
            @error('type')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

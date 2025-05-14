<form method="POST" action="{{ isset($course) ? route('admin.courses.update', $course->id) : route('admin.courses.store') }}">
    @csrf
    @if(isset($course)) @method('PUT') @endif

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('المستوى') }}</label>
                <select name="level_id" class="form-control select2" required>
                    <option value="">{{ __('اختر المستوى') }}</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}" {{ old('level_id', $course->level_id ?? '') == $level->id ? 'selected' : '' }}>
                            {{ $level->name }}
                        </option>
                    @endforeach
                </select>
                @error('level_id')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('كود المقرر') }}</label>
                <input type="text" name="code" class="form-control"
                       value="{{ old('code', $course->code ?? '') }}" required>
                @error('code')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('اسم المقرر') }}</label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title', $course->title ?? '') }}" required>
                @error('title')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>



        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('ساعات المحاضرات') }}</label>
                <input type="number" name="lecture_hours" class="form-control"
                       value="{{ old('lecture_hours', $course->lecture_hours ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('ساعات العملي') }}</label>
                <input type="number" name="practical_hours" class="form-control"
                       value="{{ old('practical_hours', $course->practical_hours ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('ساعات السريري') }}</label>
                <input type="number" name="clinical_hours" class="form-control"
                       value="{{ old('clinical_hours', $course->clinical_hours ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('الساعات المعتمدة') }}</label>
                <input type="number" name="sch" class="form-control"
                       value="{{ old('sch', $course->sch ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>المتطلبات السابقة</label>
                <select name="prerequisites[]" class="form-control select2" multiple>
                    @foreach($allCourses as $c)
                        <option value="{{ $c->id }}" {{ isset($course) && $course->prerequisites->contains($c->id) ? 'selected' : '' }}>
                            {{ $c->code }} - {{ $c->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>المتطلبات المتزامنة</label>
                <select name="corequisites[]" class="form-control select2" multiple>
                    @foreach($allCourses as $c)
                        <option value="{{ $c->id }}" {{ isset($course) && $course->corequisites->contains($c->id) ? 'selected' : '' }}>
                            {{ $c->code }} - {{ $c->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>



    <button type="submit" class="btn btn-primary">
        <i class="fa fa-save"></i> {{ isset($course) ? __('تحديث') : __('حفظ') }}
    </button>
</form>

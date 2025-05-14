{{-- form.blade.php --}}
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('الاسم') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $user->name ?? '') }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('البريد الإلكتروني') }} <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $user->email ?? '') }}" required>
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('الكود') }}</label>
            <input type="text" name="code" class="form-control"
                   value="{{ old('code', $user->code ?? '') }}">
            @error('code')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('الدور') }} <span class="text-danger">*</span></label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="head_department" {{ old('role', $user->role ?? '') == 'head_department' ? 'selected' : '' }}>Head Department</option>
                <option value="teacher" {{ old('role', $user->role ?? '') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('كلمة المرور') }} <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" required>
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('تأكيد كلمة المرور') }} <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" required>
            @error('password_confirmation')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

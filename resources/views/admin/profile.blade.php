@extends('admin.main')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> {{__('Update Profile')}} </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">{{__('Update Profile')}}</h3>
                    <form class="row" method="post" action="{{ route('admin.profile') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group col-md-6">
                            <label for="Name">{{ __('Full Name') }}</label>
                            <input class="form-control" id="Name" type="text" name="name"
                                   value="{{ old('name', $profile->name) }}" required>
                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Mail">{{ __('E-Mail') }}</label>
                            <input class="form-control" id="Mail" type="email" name="email"
                                   value="{{ old('email', $profile->email) }}" required>
                            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Password">{{ __('New Password') }}</label>
                            <input class="form-control" autocomplete="new-password" id="Password"
                                   type="password" name="password">
                            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Confirmation">{{ __('Password Confirmation') }}</label>
                            <input class="form-control" autocomplete="new-password" id="Confirmation"
                                   type="password" name="password_confirmation">
                            @error('password_confirmation')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save Changes') }} <i class="fa fa-save"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

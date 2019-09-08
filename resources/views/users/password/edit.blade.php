@extends('layouts.app')

@section('content')
    <h1>{{ __('My profile') }}</h1>

    <div class="postcontent nobottommargin col_last clearfix">
        <div class="fancy-title title-double-border">
            <h3>{{ __('Update your password') }}</h3>
        </div>


        <form method="POST" action="{{ route('users.password.update') }}">
            @csrf

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                <div class="col-md-6">
                    <input id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password" required>

                    @if ($errors->has('new_password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                <div class="col-md-6">
                    <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Change Password') }}
                    </button>
                </div>
            </div>
        </form>

    </div>

    @include('users.sidebar')
@endsection

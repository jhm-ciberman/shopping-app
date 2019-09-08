@extends('layouts.app')

@section('title', __('Update your email address'))

@section('content')

    <h1>{{ __('My profile') }}</h1>

    <div class="postcontent nobottommargin col_last clearfix">
        <div class="fancy-title title-double-border">
            <h3>{{ __('Update your email address') }}</h3>
        </div>

        <form method="POST" action="{{ route('users.email.update') }}">
            @csrf

            <div class="form-group row my-5">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('New Email Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Change my email address') }}
                    </button>
                </div>
            </div>
        </form>

    </div>

    @include('users.sidebar')

@endsection




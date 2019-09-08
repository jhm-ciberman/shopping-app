@extends('layouts.app')

@section('title', __('My Profile'))

@section('content')
    <h1>{{ __('Welcome!') }}</h1>
    <div class="postcontent nobottommargin col_last clearfix">
        <div class="fancy-title title-double-border">
            <h3>{{ __('My Profile') }}</h3>
        </div>

        <ul class="list-group">
            <li class="list-group-item">
                <div class="row p-sm-2">
                    <b class="col-4">{{ __('Name') }}</b>
                    <div class="col-8">{{ $user->name }}</div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="row p-sm-2">
                    <b class="col-4">{{ __('Email') }}</b>
                    <div class="col-8">
                        {{ $user->email }}
                        @empty($user->email_verified_at)
                            <div class="text-danger">{{ __("You haven't verified your email. Please check your email inbox.") }}</div>
                        @endempty
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row p-sm-2">
                    <b class="col-4">{{ __('Account Type') }}</b>
                    <div class="col-8">
                        {{ $user->is_business ? __('Business') : __('Particular') }}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row p-sm-2">
                    <b class="col-4">{{ __('Registration date') }}</b>
                    <div class="col-8">{{ ReadableUnit::fulldate($user->created_at) }}</div>
                </div>
            </li>
        </ul>

        <div class="mb-5 clearfix">
            <a href="{{ route('users.email.edit') }}" class="fright btn btn-link">{{ __('Change my email address') }}</a>
            <a href="{{ route('users.password.edit') }}" class="fright btn btn-link">{{ __('Change my password') }}</a>
        </div>

        <div class="fancy-title title-double-border">
            <h3>{{ __('My Addresses') }}</h3>
        </div>

        @each('users.address.item', $user->addresses, 'address', 'users.address.empty')

        <a href="{{ route('users.address.create') }}" class="btn btn-primary btn-lg">
            <span>{{ __('Add Address') }}</span>
        </a>

    </div>

    @include('users.sidebar')

@endsection




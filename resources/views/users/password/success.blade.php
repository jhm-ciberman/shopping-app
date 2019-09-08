@extends('layouts.app')

@section('content')
    <h1>{{ __('My profile') }}</h1>

    <div class="postcontent nobottommargin col_last clearfix">
        <div class="row pt-3 pb-1 justify-content-center">
            <div class="col-auto" style="font-size: 1.3em">
                <p class="text-center font-weight-bold mb-2" >{{ __("Great!") }}</p>
                <p class="text-center text-muted">{{ __("Your password was updated successfully") }}</p>
            </div>
        </div>
        <div class="row pt-1 pb-5 justify-content-center">
            <div class="col-auto">
                <a class="btn btn-primary btn-lg w-auto" href="{{ route('users.show') }}">{{ __('Return to my profile') }}</a>
            </div>
        </div>
    </div>

    @include('users.sidebar')

@endsection

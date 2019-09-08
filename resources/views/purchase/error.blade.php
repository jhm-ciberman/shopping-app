@extends('layouts.app')

@section('title', __('Error procesing purchase'))

@section('content')
    <h1>{{ __('Error procesing purchase') }}</h1>

    <div class="row justify-content-center">
        <div class="col-auto card" style="min-width: 60%;">
            <div class="card-body">
                <h3>{{ __('Error procesing purchase') }}</h3>
                <div>
                    {{ isset($error) ? __($error->getMessage()) : __('Error procesing purchase') }}
                </div>
            </div>
        </div>
    </div>
@endsection

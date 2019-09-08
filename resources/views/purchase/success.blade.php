@extends('layouts.app')

@section('title', __('All ready!'))

@section('content')
    <h1>{{ __("All ready!") }}</h1>

    <div class="row justify-content-center">
        <div class="col-auto" style="min-width: 60%;">
            <!-- <a href="https://www.freepik.es/fotos-vectores-gratis/cartel">Vector de cartel creado por macrovector - www.freepik.es</a> -->
            <img src="{{ asset('images/purchase-success.svg') }}" alt="{{ __('Your purchase is on the way...') }}" style="max-height:50vh">
            <h3 class="text-center">{{ __('Your purchase is on the way...') }}</h3>
            <p  class="text-center">{{ __("You can pay for your purchase when you receive the products") }}</p>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('Explore more products') }}</a>
                </div>
            </div>
        </div>

    </div>
    <div class="row card mt-5">
        <div class="card-body">
            @include('errors.links')
        </div>
    </div>
@endsection

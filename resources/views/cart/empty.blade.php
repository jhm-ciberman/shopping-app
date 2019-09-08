@extends('layouts.app')

@section('title', __('Your Cart'))

@section('content')
    <h1>{{ __('Your Cart') }}</h1>
    <div class="text-center my-5">
        <h2 class="d-block">{{ __('Your cart is empty') }}</h2>
        <div>
            <div class="row pt-3 pb-1 justify-content-center">
                <div class="col-auto" style="font-size: 1.3em">
                    <p class="text-center font-weight-bold mb-2" >{{ __("You don't have anything in your cart.") }}</p>
                    <p class="text-center text-muted">{{ __("Why don't you explore our products?") }}</p>
                </div>
            </div>
            <div class="row pt-1 pb-5 justify-content-center">
                <div class="col-auto">
                    <a class="btn btn-primary btn-lg w-auto" href="{{ route('products.index') }}">{{ __('Browse products') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

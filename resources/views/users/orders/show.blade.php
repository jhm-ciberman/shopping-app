@extends('layouts.app')

@section('title', __('Order'))

@section('content')
    <h1>{{ __('Order') }} #{{ $order->id }}</h1>
    <span><i class="mr-3 icon-calendar1"></i>{{ $order->created_at->format('j \d\e F \d\e Y \a \l\a\s H:m') }}</span>

    <div class="postcontent nobottommargin col_last clearfix">

        <div class="fancy-title title-double-border">
            <h3>{{ __('Products') }}</h3>
        </div>

        @include('users.orders.table')
        <form action="{{ route('users.orders.tocart', $order)}}" method="POST">
            @csrf
            <div class="row">
                <div class="col text-right">
                    <label for="submit" class="p-2 text-middle">{{ __('Want to repeat the same order?') }}</label>
                </div>
                <div class="col-auto">
                    <button id="submit" type="submit" class="btn btn-primary px-3">
                        <i class="icon-shopping-cart mr-3"></i>{{ __('Add all to cart') }}
                    </button>
                </div>
            </div>
        </form>


        <div class="fancy-title title-double-border">
            <h3>{{ __('Shipping Address') }}</h3>
        </div>

        @include('users.address.item', ['address' => $order->address])

    </div>

    @include('users.sidebar')
@endsection


@extends('layouts.app')

@section('title', __('Confirm your purchase'))

@section('content')
    <h1>{{ __('Almost there...') }}</h1>

    <form method="POST" action="{{ route('purchase.store') }}">

        @csrf

        <input type="hidden" name="checksum" value="{{ $checksum }}">

        <div class="row mt-5">
            <div class="col-lg-8">
                <h3>{{ __('Confirm your purchase') }}</h3>

                @include('cart.table')
            </div>
            <div class="col-lg-4">
                <h3>{{ __('Purchase summary') }}</h3>

                @include('cart.summary')


                <h3>{{ __('Choose your shipping Address') }}</h3>
                <div class="row">
                    <div class="col">

                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="list-group" data-address-select>
                            @foreach($addresses as $address)
                                <div for="address_{{ $address->id }}" data-toggle="list" class="cursor-pointer text-left list-group-item list-group-item-action py-3 {{ $loop->first ? 'active' : '' }}">
                                    <input id="address_{{ $address->id }}" autocomplete="off" name="address" value="{{ $address->id }}" type="radio" {{ $loop->first ? 'checked' : '' }}>
                                    @include('users.address.info', ['address' => $address])
                                </div>
                            @endforeach
                            <div class="text-right list-group-item py-3">
                                <a href="{{ route('purchase.address.create') }}" class="fright">{{ __('Use another address') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="row mt-5">
            <div class="col">
                <div class="alert alert-info align-middle" role="alert">
                    <i class="material-icons mr-3 float-left">info</i>
                    <div>{{ __('You can enter your payment info in the next screen') }}</div>
                </div>
            </div>
        </div>

        <div class="mt-3 pt-3">
            <button type="submit" class="d-block mx-auto btn btn-lg btn-success text-center" style="width: 400px">{{ __('Confirm purchase') }}</button>
        </div>

    </form>

    {{--
    <div class="content-wrap section my-0 py-5">
        <div class="container clearfix">
            <div class="row">
                <div class="col">
                    <h2 class="mb-3">{{ __('Related Products') }}</h4>
                    @include('products.partials.carousel', ['products' => $recentProducts])
                </div>
            </div>
        </div>
    </div>
    --}}
@endsection

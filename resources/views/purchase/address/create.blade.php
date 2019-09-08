@extends('layouts.app')

@section('content')
    <h1>{{ __('Add your address') }}</h1>

    <form method="POST" id="address-form" class="mt-3" action="{!! route('purchase.address.store', $address) !!}">
        <div class="card p-3">
            <div class="row card-body">
                <div class="col-md-8 ">
                    <h3>{{ __('Tell us where to send your order') }}</h3>

                    @csrf

                    @include('users.address.form', ['address' => $address ])
                </div>
                <div class="col-md-4 align-self-center">
                    <!-- <a href="http://www.freepik.com">Designed by macrovector / Freepik</a> -->
                    <img src="{{ asset('images/shipping-guy.svg') }}" alt="{{ __('Tell your address to the shipping guy') }}" title="{{ __('Tell your address to the shipping guy') }}">

                </div>
            </div>
        </div>
        <div class="my-3 py-3 fright">
            <a href="javascript:history.back()" class="px-5 btn btn-lg btn-link">{{ __('Back') }}</a>
            <button type="submit" class="btn btn-lg btn-primary px-5">{{ __('Continue') }}</button>
        </div>
    </form>
@endsection

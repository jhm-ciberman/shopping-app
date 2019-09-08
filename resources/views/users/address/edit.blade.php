@extends('layouts.app')

@section('title', $address->exists ? __("Edit Address")  :  __("Add Address"))

@section('content')

    <h1>{{ $address->exists ? __("Edit Address")  :  __("Add Address") }}</h1>

    <div class="postcontent nobottommargin col_last clearfix">
        <form method="POST" id="address-form" action="{!! $address->exists ? route('users.address.update', $address) : route('users.address.store') !!}">

            @csrf

            @if($address->exists)
                @method('PATCH')
            @endif

            @include('users.address.form', ['address' => $address])

            <div class="form-group form-row">
                <div class="form-group col">
                    <button type="submit" class="px-4 btn btn-lg btn-primary">{{ __('Save') }}</button>
                    <a href="javascript:history.back()" class="px-4 btn btn-lg btn-link">{{ __('Cancel') }}</a>
                </div>
            </div>
        </form>

    </div>

    @include('users.sidebar')

@endsection

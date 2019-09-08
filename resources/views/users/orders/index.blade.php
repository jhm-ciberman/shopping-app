@extends('layouts.app')

@section('title', __('My Orders'))

@section('content')
    <h1>{{ __('My Orders') }}</h1>
    <div class="postcontent nobottommargin col_last clearfix">

        @if($orders->isNotEmpty())
            <div class="list-group">
                @each('users.orders.card', $orders, 'order')
            </div>
        @else
            @include('users.orders.empty')
        @endif

    </div>

    @include('users.sidebar')

@endsection

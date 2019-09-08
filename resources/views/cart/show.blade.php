@extends('layouts.app')

@section('title', __('Your Cart'))

@section('content')

    <h1>{{ __('Your Cart') }}</h1>

    @if (session('error'))
        <div class="alert-error" role="alert">
            <strong>{{ session('error') }}</strong>
        </div>
    @endif

    <div class="clearfix card">
        <div class="card-body row">
            <div class="col-lg-8">
                <h3>{{ __('Your Order') }}</h3>

                @include('cart.table', ['editable' => true])

            </div>
            <div class="col-lg-4 mt-3 mt-md-0">
                <h3>{{ __("Purchase summary") }}</h3>

                @include('cart.summary')
                <p>{{ __("You will can enter the shipping address and in the next step.") }}</p>

            </div>

        </div>

    </div>

    <div class="row clearfix my-3 justify-content-end">
        <div class="col-12 col-lg-4 col-md-6">
            <a href="{!! route('products.index') !!}" class="btn btn-outline-primary btn-lg px-5 w-100">{{ __('Add more products') }}</a>
        </div>
        <div class="col-12 mt-2 col-lg-4 col-md-6 mt-md-0">
            <a href="{{ route('purchase.create') }}" class="btn btn-primary btn-lg px-5 w-100">{{ __('Finish purchase') }}</a>
        </div>
    </div>

    <div class="modal fade" id="edit-quantity-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Update quantity') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="ajax-content"></div>
            <div class="loading-body">
                <i class="icon-spinner icon-spin"></i>
                <div class="error-alert alert alert-danger">{{ __('There was an error loading the content. Please try again later.') }}</div>
            </div>
        </div>

    </div>

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

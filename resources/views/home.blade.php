@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col">
            <div id="homeCarousel" class="carousel slide shadow-sm" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($featuredProducts as $product)
                        <li data-target="#homeCarousel" data-slide-to="{{ $loop->index }}" {{ $loop->first ? 'class="active"' : '' }}></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">

                    @foreach ($featuredProducts as $product)
                        <a class="carousel-item{{ $loop->first ? ' active' : '' }}" href="{{ route('products.show', $product) }}">
                            <img src="{{ $product->carouselImage() }}" class="d-block h-100" alt="{{ $product->name }}">
                            <div class="carousel-caption d-none d-md-block text-shadow">
                                <h5>{{ $product->name }}</h5>
                                <p>{{ Str::limit($product->description) }}</p>
                            </div>
                        </a>
                    @endforeach

                </div>

                <a class="carousel-control-prev" href="#homeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#homeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-header">Index page</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to this amazing shopping app
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 px-2 mb-3">
                @include('products.card')
            </div>
        @endforeach
    </div>


</div>
@endsection

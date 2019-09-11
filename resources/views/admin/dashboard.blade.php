@extends('layouts.app')

@section('content')
    <h1>Admin panel</h1>
    <div class="row">
        <div class="col">
            @component('admin.card')
                <h2>Products</h2>
                <div class="text-big">{{ \App\Product::count() }}</div>
                @slot('footer')
                    <a href="{{ route('admin.products.index') }}" class="card-link">Show products</a>
                @endslot
            @endcomponent
        </div>
        <div class="col">
            @component('admin.card')
                <h2>Users</h2>
                <div class="text-big">{{ \App\User::count() }}</div>
                @slot('footer')
                    <a href="{{ route('admin.users.index') }}" class="card-link">Show users</a>
                @endslot
            @endcomponent
        </div>
        <div class="col">
            @component('admin.card')
                <h2>Orders</h2>
                <div class="text-big">{{ \App\Order::count() }}</div>
                @slot('footer')
                    <a href="{{ route('admin.products.index') }}" class="card-link">Show orders</a>
                @endslot
            @endcomponent
        </div>
    </div>


@endsection

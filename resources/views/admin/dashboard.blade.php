@extends('layouts.app')

@section('content')
    <h1>Admin panel</h1>
    <div class="row">

        @foreach(Admin::getNavbarResources() as $resource)

            <div class="col-12 col-md-4">
                @component('admin.components.card')
                    <h2>{{ $resource::label() }}</h2>
                    <div class="text-big">{{ $resource::newModel()->count() }}</div>
                    @slot('footer')
                        <a href="{{ route('admin.resources.index', $resource::uriKey()) }}" class="card-link">Show {{ $resource::label() }}</a>
                    @endslot
                @endcomponent
            </div>

        @endforeach
    </div>


@endsection

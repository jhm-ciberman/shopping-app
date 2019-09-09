@extends('layouts.app')

@section('content')
    <div class="container">
        <resource-index 
            endpointUrl="{{ route('admin.api.products.users') }}">
        </resource-index>
    </div>
@endsection

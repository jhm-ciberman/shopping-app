@extends('layouts.app')

@section('content')
    <div class="container">
        <resource-index 
            endpoint-url="{{ route('admin.api.users.index') }}">
        </resource-index>
    </div>
@endsection

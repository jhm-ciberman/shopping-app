@extends('layouts.app')

@section('content')
    <resource-index 
        endpoint-url="{{ $endpoint }}"
        :columns='@json($columns)'
        >
    </resource-index>
@endsection

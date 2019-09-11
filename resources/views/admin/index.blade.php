@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col">
            <h1>{{ $title }}</h1>
        </div>
        <div class="col-auto">
            <div class="row no-gutters align-content-end">
                <div class="col-auto ml-2">
                    <a href="{{ $createUrl }}" class="edit-button float-right btn d-inline-block btn-success" aria-label="Add resource">
                        Add resource<i class="material-icons ml-2">add</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <resource-index
        endpoint-url="{{ $endpoint }}"
        :columns='@json($fields->map->jsonSerialize())'
        >
    </resource-index>
@endsection

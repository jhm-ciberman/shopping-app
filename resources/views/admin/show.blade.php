@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col">
            <h1>{{ $title }}</h1>
        </div>
        <div class="col-auto">
            <div class="row no-gutters align-content-end">
                <div class="col-auto ml-2">
                    <form action="{{ $destroyUrl }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="edit-button float-right btn d-inline-block btn-danger" aria-label="Delete resource">
                            Delete resource<i class="material-icons ml-2">delete</i>
                        </button>
                    </form>
                </div>
                <div class="col-auto ml-2">
                    <a href="{{ $editUrl }}" class="edit-button float-right btn d-inline-block btn-success" aria-label="Edit resource">
                            Edit resource<i class="material-icons ml-2">edit</i>
                    </a>
                </div>
            </div>


        </div>
    </div>


    <div class="card mb-4">
        <div class="card-body">
            @foreach($fields as $field)
                @component('admin.components.field-container', ['field' => $field])
                    @if (View::exists('admin.fields.'.$field->view().'-detail'))
                        @include('admin.fields.'.$field->view().'-detail')
                    @else
                        {{ $field->resolve($resource->resource) }}
                    @endif
                @endcomponent
            @endforeach
        </div>
    </div>

    @foreach($relationshipFields as $field)
        <div class="my-2">
            <div class="row">
                <div class="col mt-3">
                    <h1>Related {{ $field->name }}</h1>
                </div>
                <div class="col-auto ml-2">
                    <a href="{{ $field->attachUrl($resource) }}" class="edit-button float-right btn d-inline-block btn-success" aria-label="Edit resource">
                            Attach resource<i class="material-icons ml-2">add</i>
                    </a>
                </div>
            </div>

            <resource-index
                endpoint-url="{{ $field->newResource()->indexEndpoint() }}"
                :columns='@json($field->indexFields()->map->jsonSerialize()->values())'
                :endpoint-params='@json($field->toEndpointParams($resource))'
                >
            </resource-index>
        </div>

    @endforeach



@endsection

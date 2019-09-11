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


    <div class="card">
        <div class="card-body">
            @foreach($fields as $field)
                @component('admin.components.field-container', ['field' => $field])
                    {{ $field->resolve($model) }}
                @endcomponent
            @endforeach
        </div>
    </div>

@endsection

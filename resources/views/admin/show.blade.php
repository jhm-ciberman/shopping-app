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

                <div class="form-group row">
                    <label for="{{ $field->attribute }}" class="col-sm-3 col-form-label">
                        {{ $field->name }}
                    </label>
                    <div class="col-sm-9">
                        {{ $field->resolve($model) }}
                    </div>
                </div>

            @endforeach
    </div>

@endsection

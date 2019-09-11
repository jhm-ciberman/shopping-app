@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <form method="POST" action="{{ $action }}">
    @csrf
    @method($method)

        <div class="card my-2">
            <div class="card-body">

                @foreach($fields as $field)
                    <div class="form-group row">
                        <label for="{{ $field->attribute }}" class="col-sm-3 col-form-label">
                            {{ $field->name }}
                        </label>
                        <div class="col-sm-9">

                            @include('admin.fields.'.$field->fieldName(), [
                                'name' => $field->attribute,
                                'label' => $field->name,
                                'value' => $model->{$field->attribute},
                            ])

                            @if ($errors->has($field->attribute))
                                <div class="invalid-feedback">
                                    {{ $errors->first($field->attribute) }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="my-3 row justify-content-end">
            <div class="col-auto">
                <a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-secondary">Cancel</a>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-lg btn-success">Save Changes</button>
            </div>
        </div>
    </form>
@endsection

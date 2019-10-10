@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <form method="POST" action="{{ $action }}">
    @csrf
    @method($method)

        <div class="card my-2">
            <div class="card-body">

                <div class="form-group row">
                    <label for="attachableId" class="col-sm-3 col-form-label font-weight-bold">
                        {{ $resource->singularLabel() }}
                    </label>
                    <div class="col-sm-9">
                        @include('admin.fields.select', [
                            'name' => 'attachableId',
                            'label' => $title,
                            'value' => null,
                            'options' => $attachables->map(function($attachable) {
                                return [
                                    'value' => $attachable->id,
                                    'label' => $attachable->name
                                ];
                            }),
                        ])

                        @if ($errors->has('attachableId'))
                            <div class="invalid-feedback">
                                {{ $errors->first('attachableId') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3 row justify-content-end">
            <div class="col-auto">
                <a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-secondary">Cancel</a>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-lg btn-success">Attach</button>
            </div>
        </div>
    </form>
@endsection

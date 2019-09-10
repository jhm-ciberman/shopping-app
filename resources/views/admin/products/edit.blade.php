@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.update', $product) }}">
                @method('PUT')
                @csrf

                @include('admin.fields.text', [
                    'value' => $product->name ?? old('name'),
                    'name'  => 'name',
                    'label' => 'Name',
                ])
                
                @include('admin.fields.textarea', [
                    'value' => $product->description ?? old('description'),
                    'name'  => 'description',
                    'label' => 'Description',
                ])

                @include('admin.fields.checkbox', [
                    'value' => $product->name ?? old('name'),
                    'name'  => 'name',
                    'label' => 'Name',
                ])

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

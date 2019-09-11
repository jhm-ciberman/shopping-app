<div class="form-group row">
    <label for="{{ $field->attribute }}" class="col-sm-3 col-form-label font-weight-bold">
        {{ $field->name }}
    </label>
    <div class="col-sm-9">
        {{ $slot }}
    </div>
</div>

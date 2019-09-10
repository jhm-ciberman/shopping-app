<div class="form-group row">
    <label for="{{ $name }}" class="col-sm-3 col-form-label">{{ $label }}</label>
    <div class="col-sm-9">
        <input class="ml-1" type="checkbox" id="{{ $name }}" name="{{ $name }}" {{ $value ? 'checked' : '' }}>
    </div>
</div>
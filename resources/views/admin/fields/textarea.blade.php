<textarea
    type="text"
    rows="4"
    class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
    id="{{ $name }}"
    name="{{ $name }}">{{ $value }}</textarea>

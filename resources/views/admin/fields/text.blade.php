
<input type="{{ $type ?? 'text' }}"
    value="{{ $value }}"
    class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
    id="{{ $name }}"
    name="{{ $name }}"
    placeholder="">

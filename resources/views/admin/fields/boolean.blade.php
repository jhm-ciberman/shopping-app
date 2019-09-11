<input
    class="ml-1 {{ $errors->has($name) ? 'is-invalid' : '' }}"
    type="checkbox"
    id="{{ $name }}"
    name="{{ $name }}"
    value="1"
    {{ $value ? 'checked' : '' }}>

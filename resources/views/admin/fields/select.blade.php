<select
    class="ml-1 custom-select {{ $errors->has($name) ? 'is-invalid' : '' }}"
    type="select"
    id="{{ $name }}"
    name="{{ $name }}">


    @foreach($options as $option)

        <option value="{{ $option['value'] }}"
            {{ $option['value'] == $value ? 'selected' : '' }}
            >{{ $option['label'] }}</option>
    @endforeach
</select>


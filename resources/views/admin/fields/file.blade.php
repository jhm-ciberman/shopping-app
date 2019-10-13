<div class="custom-file {{ $errors->has($name) ? 'is-invalid' : '' }}">
  <input type="file" class="custom-file-input" id="{{ $name }}" name="{{ $name }}">
  <label class="custom-file-label" for="{{ $name }}">Choose file</label>
</div>

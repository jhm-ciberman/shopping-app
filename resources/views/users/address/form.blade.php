<div class="form-group form-row">
    <div class="form-group col-md-6">
        <label for="contact">Nombre y apellido</label>
        <input type="text" value="{{ old('contact', $address->contact) ?? optional(auth()->user())->name }}" name="contact" id="contact" class="form-control {{ $errors->has('contact') ? ' is-invalid' : '' }}" required autofocus>
        <small class="form-text text-muted">
            La persona que recibirá la compra
        </small>

        @if ($errors->has('contact'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('contact') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="phone">Teléfono de contacto</label>
        <input type="phone" value="{{ old('phone', $address->phone) }}"name="phone" id="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" required placeholder="Ej.: +54 223 6123456">
        <small class="form-text text-muted">
            Llamaremos a este número si hay algún problema en el envío.
        </small>

        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group form-row">
    <div class="form-group col">
        <label for="country">País</label>
        <div id="country">Argentina</div>
    </div>
    <div class="form-group col">
        <label for="state">Provincia</label>
        <div id="state">Buenos Aires</div>
    </div>
    <div class="form-group col">
        <label for="city">Ciudad</label>
        <div id="city">Mar del Plata</div>
    </div>
</div>
<div class="form-group form-row mb-3">
    <div class="form-group col-7">
        <label for="street_name">Calle</label>
        <input type="text" value="{{ old('street_name', $address->street_name) }}" name="street_name" id="street_name" class="form-control {{ $errors->has('street_name') ? ' is-invalid' : '' }}" required>

        @if ($errors->has('street_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('street_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-5">
        <label for="street_number">Número</label>

        {{--
        <div class="input-group">
            <input type="text" value="{{ old('street_number', $address->street_number) }}" name="street_number" id="street_number" class="form-control {{ $errors->has('street_number') ? ' is-invalid' : '' }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <input type="checkbox" id="without_number" {{ $address->exists && empty(old('street_number', $address->street_number)) ? 'checked' : '' }}>
                    <label class="ml-2 form-check-label" for="without_number">Sin número</label>
                </div>
            </div>
        </div>
        --}}
        <street-number-input
            initial-value="{{ old('street_number', $address->street_number) }}"
            v-bind:invalid="{{ $errors->has('street_number') ? 'true' : 'false' }}"
            v-bind:initial-without-number="{{ $address->exists && empty(old('street_number', $address->street_number))  ? 'true' : 'false' }}"
            ></address-number-input>

        @if ($errors->has('street_number'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('street_number') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group form-row">
    <div class="form-group col">
        <label for="additional_info">Piso / Departamento (Opcional)</label>
        <input type="text" value="{{ old('additional_info', $address->additional_info) }}" id="additional_info" name="additional_info" class="form-control {{ $errors->has('additional_info') ? ' is-invalid' : '' }}">

        @if ($errors->has('additional_info'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('additional_info') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col">
        <label for="between">Entre calles (Opcional)</label>
        <input type="text" value="{{ old('between', $address->between) }}" id="between" name="between" class="form-control {{ $errors->has('between') ? ' is-invalid' : '' }}">

        @if ($errors->has('between'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('between') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group">
    <label for="references">Referencias (Opcional)</label>
    <input type="text" value="{{ old('references', $address->references) }}" name="references" id="references" class="form-control {{ $errors->has('references') ? ' is-invalid' : '' }}">
    <small class="form-text text-muted">
        Indicaciones para encontrar tu domicilio.
    </small>

    @if ($errors->has('references'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('references') }}</strong>
        </span>
    @endif
</div>

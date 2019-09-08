<div class="form-group form-row">
    <div class="form-group col-md-6">
        <label for="contact">{{ __('Name and surname') }}</label>
        <input type="text" value="{{ old('contact', $address->contact) ?? optional(auth()->user())->name }}" name="contact" id="contact" class="form-control {{ $errors->has('contact') ? ' is-invalid' : '' }}" required autofocus>
        <small class="form-text text-muted">
            {{ __('The person who is going to receive the purchase') }}
        </small>

        @if ($errors->has('contact'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('contact') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="phone">{{ __('Contact phone') }}</label>
        <input type="phone" value="{{ old('phone', $address->phone) }}"name="phone" id="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" required placeholder="Ej.: +54 223 6123456">
        <small class="form-text text-muted">
            {{ __('We will call this number if we have any problems with the shipping process') }}
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
        <label for="country">{{ __('Country') }}</label>
        <div id="country">Argentina</div>
    </div>
    <div class="form-group col">
        <label for="state">{{ __('State') }}</label>
        <div id="state">Buenos Aires</div>
    </div>
    <div class="form-group col">
        <label for="city">{{ __('City') }}</label>
        <div id="city">Mar del Plata</div>
    </div>
</div>
<div class="form-group form-row mb-3">
    <div class="form-group col-7">
        <label for="street_name">{{ __('Street') }}</label>
        <input type="text" value="{{ old('street_name', $address->street_name) }}" name="street_name" id="street_name" class="form-control {{ $errors->has('street_name') ? ' is-invalid' : '' }}" required>

        @if ($errors->has('street_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('street_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-5">
        <label for="street_number">{{ __('Number') }}</label>

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
            without-number-text="{{ __('Without number') }}">
        </address-number-input>

        @if ($errors->has('street_number'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('street_number') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group form-row">
    <div class="form-group col">
        <label for="additional_info">{{ ('Floor/Apartment (Optional)') }}</label>
        <input type="text" value="{{ old('additional_info', $address->additional_info) }}" id="additional_info" name="additional_info" class="form-control {{ $errors->has('additional_info') ? ' is-invalid' : '' }}">

        @if ($errors->has('additional_info'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('additional_info') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col">
        <label for="between">{{ __('Between streets (Optional)') }}</label>
        <input type="text" value="{{ old('between', $address->between) }}" id="between" name="between" class="form-control {{ $errors->has('between') ? ' is-invalid' : '' }}">

        @if ($errors->has('between'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('between') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group">
    <label for="references">{{ __('Additional info (Optional)') }}</label>
    <input type="text" value="{{ old('references', $address->references) }}" name="references" id="references" class="form-control {{ $errors->has('references') ? ' is-invalid' : '' }}">
    <small class="form-text text-muted">
        {{ ('Additional information to locate your address') }}
    </small>

    @if ($errors->has('references'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('references') }}</strong>
        </span>
    @endif
</div>

<div class="card my-3">
    <div class="card-body">
        @include('users.address.info')

        @if($address->is_editable)
            <div class="float-right form-row">
                <div class="col">
                    <a href="{{ route('users.address.edit', $address) }}" class="button button-rounded button-reveal button-small">
                        <i class="icon-pen"></i>
                        <span>{{ __('Edit') }}</span>
                    </a>
                </div>
                <form class="col" method="POST" action="{{ route('users.address.edit', $address) }}">
                    @method('DELETE')
                    <button type="submit" class="button button-rounded button-reveal button-small button-red">
                        <i class="icon-trash"></i>
                        <span>{{ __('Delete') }}</span>
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
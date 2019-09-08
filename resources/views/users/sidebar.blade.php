<div class="sidebar nobottommargin clearfix">
    <div class="sidebar-widgets-wrap">
        <div class="widget widget_links clearfix">
            <h4>{{ Auth::user()->name }}</h4>
            <ul>
                <li><a href="{!! route('users.show') !!}"><div>{{ __('My Account') }}</div></a></li>
                <li><a href="{!! route('users.orders.index') !!}"><div>{{ __('My Orders') }} </div></a></li>
            </ul>
        </div>
    </div>
</div>
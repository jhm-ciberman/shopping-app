<div class="widget widget_links clearfix">

    <h4>{{ __('Shop Categories') }}</h4>
    <ul>
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('products.category', $category) }}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>

</div>
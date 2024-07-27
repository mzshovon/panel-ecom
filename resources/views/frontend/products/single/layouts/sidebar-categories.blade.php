
<section class="widget widget-categories mb-5">
    <h3 class="widget-title h4 mb-4">Categories</h3>
    <ul>
        @forelse (getCategoryList() as $sidebarCategory)
            <li class="has-children {{ isset($category) && $sidebarCategory['name'] == $category['name'] ? "expanded" : ""}}">
                <a>{{$sidebarCategory['name']}}</a>
                <span>({{count($sidebarCategory['products'])}})</span>
                <ul>
                    @forelse ($sidebarCategory['products'] as $product)
                        <li><a href="{{route('single-product', ['productId' => $product['id']])}}">{{$product['name']}}</a>
                        </li>
                    @empty
                    @endforelse
                </ul>
            </li>
        @empty
            No category found!
        @endforelse
    </ul>
</section>

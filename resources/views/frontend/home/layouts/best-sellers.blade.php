@if (count($latest_products) > 0)
<div class="col-lg-4 col-sm-6 col-md-6">
    <div class="widget-featured-entries mt-5 mt-lg-0">
        <h4 class="mb-4 pb-3">Best selllers</h4>
        @forelse ($latest_products as $product)
        <div class="media mb-3">
            <a class="featured-entry-thumb" href="{{route('single-product', ['productId'=>$product['id']])}}">
                <img src="{{URL::to("/") . "/" .$product['images'][0]['image_path']}}" alt="Product thumb" width="64"
                    class="img-fluid mr-3">
            </a>
            <div class="media-body">
                <h6 class="featured-entry-title mb-0"><a href="product-single.html">{{$product['name']}}</a></h6>
                <p class="featured-entry-meta">{{$product['price']}} TK.</p>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>
@endif

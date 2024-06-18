<section class="section products-main">
    <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-8">
                  <div class="title text-center">
                      <h2>New arrivals</h2>
                      <p>The best Online sales to shop these weekend</p>
                  </div>
              </div>
          </div>


      <div class="row">
        @forelse ($latest_products as $product)
            <div class="col-lg-3 col-12 col-md-6 col-sm-6 mb-5" >
                <div class="product">
                <div class="product-wrap">
                    @foreach ($product['images'] as $key => $image)
                    <a href="{{route('single-product', ['productId' => $product['id']])}}">
                        @if (in_array($key, [0,1]))
                                <img class="img-fluid latest-img mb-3 img-{{numberToOrdinal($key + 1)}}" src="{{URL::to("/") . "/" .$image['image_path']}}" alt="product-img"/>
                        @endif
                    </a>
                    @endforeach
                </div>
                @if ($product['stock'] > 0)
                    <span class="onsale">Sale</span>
                @endif
                <div class="product-hover-overlay">
                    <a href="#"><i class="tf-ion-android-cart"></i></a>
                    <a href="#"><i class="tf-ion-ios-heart"></i></a>
                    </div>

                <div class="product-info">
                    <h2 class="product-title h5 mb-0"><a href="product-single.html">{{$product['name']}}</a></h2>
                    <span class="price">
                        {{$product['price']}} TK.
                    </span>
                </div>
            </div>
            </div>
        @empty
            No Newest Product Available!
        @endforelse


    </div>
  </section>

@extends('frontend.layouts.app')
@section('content')

<section class="page-header">
	<div class="overly"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="content text-center">
					<h1 class="mb-3">{{$product->name}}</h1>
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb bg-transparent justify-content-center">
				    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Product Single</li>
				  </ol>
				</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="single-product">
	<div class="container">
		<div class="row">
			@include('frontend.products.single.layouts.silders')

			<div class="col-md-7">
				<div class="single-product-details mt-5 mt-lg-0">
					<h2>{{$product->name}}</h2>
					<div class="sku_wrapper mb-4">
						SKU: <span class="text-muted">{{$product->sku}} </span>
					</div>

					<hr>

					<h3 class="product-price">
                        @if ($product->stock == 0)
                            Out of stock!
                        @else
                            {{(int)$product->price}} TK. <del>{{$product->previous_price}} TK.</del>
                         @endif
                    </h3>

					<p class="product-description my-4 ">
                        {!! $product->short_description ?? "" !!}
					</p>
                    @if ($product->stock > 0)
						<div class="quantity d-flex align-items-center">
							<input type="number" id="quantity_{{$product['id']}}" class="input-text qty text form-control w-25 mr-3" step="1" min="1" max="9" name="quantity" value="1" title="Qty" size="4" >
							<button class="btn btn-main btn-small" onclick="addInputValueToCart('{{route('cart.add')}}', '{{csrf_token()}}', {{$product['id']}}, 1)">Add to cart</button>
						</div>
                    @endif

					<div class="color-swatches mt-4 d-flex align-items-center">
						<span class="font-weight-bold text-capitalize product-meta-title">color:</span>
						<ul class="list-inline mb-0">
                            @forelse (json_decode($product->variants) as $variant)
                                <li class="list-inline-item">
                                    <a class="btn btn-main btn-small">{{$variant}}</a>
                                </li>
                            @empty
                                <li class="list-inline-item">
                                    <a class="btn btn-main btn-small">All</a>
                                </li>
                            @endforelse
						</ul>
					</div>

					<div class="products-meta mt-4">
						<div class="product-category d-flex align-items-center">
							<span class="font-weight-bold text-capitalize product-meta-title">Categories :</span>
                            @forelse ($product->categories as $category)
                                <a href="{{route('category-product', ['catId' => $category->id])}}">{{$category->name}}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                </a>
                            @empty
                            @endforelse
						</div>

						<div class="product-share mt-5">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a href="#"><i class="tf-ion-social-facebook"></i></a>
								</li>
								<li class="list-inline-item">
									<a href="#"><i class="tf-ion-social-twitter"></i></a>
								</li>
								<li class="list-inline-item">
									<a href="#"><i class="tf-ion-social-linkedin"></i></a>
								</li>
								<li class="list-inline-item">
									<a href="#"><i class="tf-ion-social-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>


    @include('frontend.products.single.layouts.tabs')
	</div>
</section>


<section class="products related-products section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="title text-center">
					<h2>You may like this</h2>
					<p>The best Online sales to shop these weekend</p>
				</div>
			</div>
		</div>
		<div class="row">
			 <div class="col-lg-3 col-6" >
		      	<div class="product">
					<div class="product-wrap">
						<a href="product-single.html"><img class="img-fluid w-100 mb-3 img-first" src="images/shop/products/322.jpg" alt="product-img" /></a>
						<a href="product-single.html"><img class="img-fluid w-100 mb-3 img-second" src="images/shop/products/444.jpg" alt="product-img" /></a>
					</div>

					<span class="onsale">Sale</span>
					<div class="product-hover-overlay">
						<a href="#"><i class="tf-ion-android-cart"></i></a>
						<a href="#"><i class="tf-ion-ios-heart"></i></a>
			      	</div>

					<div class="product-info">
						<h2 class="product-title h5 mb-0"><a href="product-single.html">Kirby Shirt</a></h2>
						<span class="price">
							$329.10
						</span>
					</div>
				</div>
		     </div>

			<div class="col-lg-3 col-6" >
		      	<div class="product">
					<div class="product-wrap">
						<a href="product-single.html"><img class="img-fluid w-100 mb-3 img-first" src="images/shop/products/111.jpg" alt="product-img" /></a>
						<a href="product-single.html"><img class="img-fluid w-100 mb-3 img-second" src="images/shop/products/222.jpg" alt="product-img" /></a>
					</div>

					<span class="onsale">Sale</span>
					<div class="product-hover-overlay">
						<a href="#"><i class="tf-ion-android-cart"></i></a>
						<a href="#"><i class="tf-ion-ios-heart"></i></a>
			      	</div>

					<div class="product-info">
						<h2 class="product-title h5 mb-0"><a href="product-single.html">Kirby Shirt</a></h2>
						<span class="price">
							$329.10
						</span>
					</div>
				</div>
		     </div>


			<div class="col-lg-3 col-6" >
		      	<div class="product">
					<div class="product-wrap">
						<a href="product-single.html"><img class="img-fluid w-100 mb-3 img-first" src="images/shop/products/111.jpg" alt="product-img" /></a>
						<a href="product-single.html"><img class="img-fluid w-100 mb-3 img-second" src="images/shop/products/322.jpg" alt="product-img" /></a>
					</div>

					<span class="onsale">Sale</span>
					<div class="product-hover-overlay">
						<a href="#"><i class="tf-ion-android-cart"></i></a>
						<a href="#"><i class="tf-ion-ios-heart"></i></a>
			      	</div>

					<div class="product-info">
						<h2 class="product-title h5 mb-0"><a href="product-single.html">Kirby Shirt</a></h2>
						<span class="price">
							$329.10
						</span>
					</div>
				</div>
		     </div>

			<div class="col-lg-3 col-6">
		      	<div class="product">
					<div class="product-wrap">
						<a href="product-single.html"><img class="img-fluid w-100 mb-3 img-first" src="images/shop/products/444.jpg" alt="product-img" /></a>
						<a href="product-single.html"><img class="img-fluid w-100 mb-3 img-second" src="images/shop/products/222.jpg" alt="product-img" /></a>
					</div>

					<span class="onsale">Sale</span>
					<div class="product-hover-overlay">
						<a href="#"><i class="tf-ion-android-cart"></i></a>
						<a href="#"><i class="tf-ion-ios-heart"></i></a>
			      	</div>

					<div class="product-info">
						<h2 class="product-title h5 mb-0"><a href="product-single.html">Kirby Shirt</a></h2>
						<span class="price">
							$329.10
						</span>
					</div>
				</div>
		     </div>
		</div>
	</div>
</section>

@endsection

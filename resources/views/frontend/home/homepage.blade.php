@extends('frontend.layouts.app')
@section('content')

@include('frontend.home.layouts.sliders')

<section class="category section pt-3 pb-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm-12 col-md-6">
				<div class="cat-item mb-4 mb-lg-0">
					<img src="{{URL::to('/')}}/public/frontend/images/about/cat-1.jpg" alt="" class="img-fluid">
					<div class="item-info">
						<p class="mb-0">Stylish Leather watch</p>
						<h4 class="mb-4">up to <strong>50% </strong>off</h4>

						<a href="#" class="read-more">Shop now</a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-sm-12 col-md-6">
				<div class="cat-item mb-4 mb-lg-0">
					<img src="{{URL::to('/')}}/public/frontend/images/about/cat-2.jpg" alt="" class="img-fluid">

					<div class="item-info">
						<p class="mb-0">Ladies hand bag</p>
						<h4 class="mb-4">up to <strong>40% </strong>off</h4>

						<a href="#" class="read-more">Shop now</a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-sm-12 col-md-6">
				<div class="cat-item">
					<img src="{{URL::to('/')}}/public/frontend/images/about/cat-3.jpg" alt="" class="img-fluid">
					<div class="item-info">
						<p class="mb-0">Trendy shoe</p>
						<h4 class="mb-4">up to <strong>50% </strong>off</h4>

						<a href="#" class="read-more">Shop now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('frontend.home.layouts.latest')
<!-- /portfolio -->



<section class="ads section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 offset-lg-6">
				<div class="ads-content">
					<span class="h5 deal">Deal of the day 5% Off</span>
					<h2 class="mt-3 text-white">Plugin Quran</h2>
					<p class="text-md mt-3 text-white">Hurry up! Limited time offer.Grab ot now!</p>
					<!-- syo-timer -->
			        <div id="simple-timer" class="syotimer mb-5"></div>
					<a href="{{route('single-product', ['productId'=>1])}}" class="btn btn-main"><i class="ti-bag mr-2"></i>Shop Now </a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section products-list">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm-12 col-md-12">
			    <img src="{{URL::to('/')}}/public/frontend/images/shop/widget/adsv.jpg" alt="Product big thumb"  class="img-fluid w-100">
			</div>
            @include('frontend.home.layouts.best-sellers')
            @include('frontend.home.layouts.new-arrival')
		</div>
	</div>
</section>

<section class="features border-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-sm-6 col-md-6">
				<div class="feature-block">
					<i class="tf-ion-android-bicycle"></i>
					<div class="content">
						<h5>Free Shipping</h5>
						<p>On all order over $39.00</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-md-6">
				<div class="feature-block">
					<i class="tf-wallet"></i>
					<div class="content">
						<h5>30 Days Return</h5>
						<p>Money back Guarantee</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-md-6">
				<div class="feature-block">
					<i class="tf-key"></i>
					<div class="content">
						<h5>Secure Checkout</h5>
						<p>100% Protected by paypal</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-md-6">
				<div class="feature-block">
					<i class="tf-clock"></i>
					<div class="content">
						<h5>24/7 Support</h5>
						<p>All time customer support </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

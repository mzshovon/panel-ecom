@extends('frontend.layouts.app')

@section('content')

@include('frontend.home.layouts.sliders')

@include('frontend.home.layouts.upcoming')

@include('frontend.home.layouts.latest')

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

@include('frontend.home.layouts.services')

@endsection

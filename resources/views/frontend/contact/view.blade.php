@extends('frontend.layouts.app')

@section('content')

<section class="page-header">
	<div class="overly"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="content text-center">
					<h1 class="mb-3">About Us</h1>
					<p>Welcome to Ecom Mart BD! Your trusted one-stop destination for all needs!</p>

				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb bg-transparent justify-content-center">
				    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
				    <li class="breadcrumb-item active" aria-current="page">About Us</li>
				  </ol>
				</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contact-section section">
	<div class="container">
		<div class="row">
			<!-- Contact Details -->
			<div class="contact-details col-md-6">
				<h3 class="mb-4">Our Company</h3>
				<p class="mb-5">{{ config('website.slogan') ?? "Welcome to Ecom Mart BD! Your trusted one-stop destination for all needs!"}}</p>

				<div class="row">
					<div class="col-lg-6 mb-5 mb-lg-0">
						<h4 class="mb-4">Corporate Office</h4>
						<ul class="contact-short-info list-unstyled" >
							<li>
								<i class="tf-ion-ios-home mr-3"></i>
								<span>{{config('website.address') ?? "Dhaka"}}</span>
							</li>
							<li>
								<i class="tf-ion-android-phone-portrait mr-3"></i>
								<span>{{ config('website.mobile') ?? "+880 1407-325822"}}</span>
							</li>
							<li>
								<i class="tf-ion-android-mail mr-3"></i>
								<span>{{ config('website.email') ?? "support@ecommartbd.com"}}</span>
							</li>
						</ul>
					</div>

					<div class="col-lg-6 mb-5 mb-lg-0">
						<h4 class="mb-4">Branch Office</h4>
						<ul class="contact-short-info list-unstyled" >
							<li>
								<i class="tf-ion-ios-home mr-3"></i>
								<span>{{config('website.address') ?? "Dhaka"}}</span>
							</li>
							<li>
								<i class="tf-ion-android-phone-portrait mr-3"></i>
								<span>{{ config('website.mobile') ?? "+880 1407-325822"}}</span>
							</li>
							<li>
								<i class="tf-ion-android-mail mr-3"></i>
								<span>{{ config('website.email') ?? "support@ecommartbd.com"}}</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Contact Form -->
			<div class="contact-form col-lg-6 " >
				<h3 class="mb-4">Send us an Email:</h3>

				<form id="contact-form" method="post" action="{{route('contact-us')}}" >
                    @csrf
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" placeholder="Your Name" class="form-control" name="name" required id="name" value="{{auth()->user()?->name ?:''}}">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<input type="email" placeholder="Your Email" class="form-control" name="email" required id="email" value="{{auth()->user()?->email ?:''}}">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" placeholder="Subject" class="form-control" name="subject" required id="subject">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" placeholder="Phone" class="form-control" name="mobile" id="phone" value="{{auth()->user()?->mobile ?:''}}">
							</div>
						</div>
					</div>

					<div class="form-group">
						<textarea rows="6" placeholder="Message" class="form-control" name="message" id="message"></textarea>
					</div>

					<div class="mt-4">
						<input type="submit" id="contact-submit" class="btn btn-black btn-small" value="Send Message">
					</div>
				</form>
			</div>
			<!-- ./End Contact Form -->
		</div> <!-- end row -->
	</div> <!-- end container -->
</section>

{{-- <div class="google-map">
	<div id="map"></div>
</div> --}}

@endsection

@section('script')
    @if (session('error'))
        <script>
            showErrorAlert('{{session('error')}}');
        </script>
    @endif
    @if (session('success'))
        <script>
            showSuccessAlert('{{session('success')}}');
        </script>
    @endif
@endsection

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

<section class="about section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm-6  col-md-6">
				<div class="about-info mb-5 mb-lg-0">
					{{-- <img class="img-fluid" src="images/about/about-1.jpg" alt="about-img"> --}}
					<h4 class="mt-4">Our Mission</h4>
					<p>Praesent blandit dolorhon quam. In vemi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet.</p>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-md-6">
				<div class="about-info mb-5 mb-lg-0">
					{{-- <img class="img-fluid" src="images/about/about-3.jpg" alt="about-img"> --}}
					<h4 class="mt-4">Our Vision</h4>
					<p>Lights together to you’re together. You’ll. Form. Moving created one. Darkness whales fourth from own moved.</p>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-md-6">
				<div class="about-info">
					{{-- <img class="img-fluid" src="images/about/about-2.jpg" alt="about-img"> --}}
					<h4 class="mt-4">Statement</h4>
					<p>Praesent blandit dolorhon quam. In vemi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet.</p>
				</div>
			</div>
		</div>
	</div>
</section>

{{-- <section class="team section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="title text-center">
					<h2>Team Members</h2>
					<p>Dedicated team behind the scene</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-sm-6 col-md-6">
				<div class="team-member mb-5 mb-lg-0">
					<img class="img-fluid" src="images/team/team-img-1.jpg" alt="">
					<h4 class="mt-3 mb-0">Jonathon Andrew</h4>
					<p>Founder</p>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-md-6">
				<div class="team-member mb-5 mb-lg-0">
					<img class="img-fluid" src="images/team/team-img-2.jpg" alt="">
					<h4 class="mt-3 mb-0">Adipisci Velit</h4>
					<p>Photographer</p>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-md-6">
				<div class="team-member mb-5 mb-lg-0">
					<img class="img-fluid" src="images/team/team-img-3.jpg" alt="">
					<h4 class="mt-3 mb-0">John Fexit</h4>
					<p>Marketing Manager</p>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-md-6">
				<div class="team-member mb-5 mb-lg-0">
					<img class="img-fluid" src="images/team/team-img-4.jpg" alt="">
					<h4 class="mt-3 mb-0">John Fexit</h4>
					<p>Creative Director</p>
				</div>
			</div>
		</div>
	</div>
</section> --}}
<!-- instagram -->
<section class="section feed pb-0" id="instafeed">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 text-center">
        <p class="mb-2"><a href="https://www.instagram.com/ecommartbd">@ ecommartbd</a></p>
        <h2 class="mb-5">Follow Us On Instagram</h2>
      </div>
    </div>
{{--
      <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4 mb-lg-0">
          <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/feed/i1.jpg" alt="instagram-image">
            <ul class="list-inline text-center mb-0">
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-ios-heart mr-2"></i>40</a></li>
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-android-chat mr-2"></i>24</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4 mb-lg-0">
          <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/feed/i2.jpg" alt="instagram-image">
            <ul class="list-inline text-center mb-0">
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-ios-heart mr-2"></i>65</a></li>
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-android-chat mr-2"></i>11</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4 mb-lg-0">
          <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/feed/i5.jpg" alt="instagram-image">
            <ul class="list-inline text-center mb-0">
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-ios-heart mr-2"></i>33</a></li>
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-android-chat mr-2"></i>78</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4 mb-lg-0">
          <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/feed/i4.jpg" alt="instagram-image">
            <ul class="list-inline text-center mb-0">
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-ios-heart mr-2"></i>32</a></li>
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-android-chat mr-2"></i>77</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4 mb-lg-0">
          <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/feed/i1.jpg" alt="instagram-image">
            <ul class="list-inline text-center mb-0">
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-ios-heart mr-2"></i>80</a></li>
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-android-chat mr-2"></i>38</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4 mb-lg-0">
          <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/feed/i5.jpg" alt="instagram-image">
            <ul class="list-inline text-center mb-0">
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-ios-heart mr-2"></i>22</a></li>
              <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="tf-ion-android-chat mr-2"></i>57</a></li>
            </ul>
          </div>
        </div>
      </div> --}}
      <!-- /without instagram image -->
  </div>
</section>

@endsection

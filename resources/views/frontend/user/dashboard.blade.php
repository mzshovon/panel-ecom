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
				    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
				  </ol>
				</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="user-dashboard page-wrapper">
	<div class="container">
		<div class="row">
            @include('frontend.layouts.user_sidebar')
			<div class="col-12 col-md-7 col-sm-12 col-lg-9">
				<p>Hello <b>{{auth()->user()?->name ?: "Anonymous"}}</b> (not {{auth()->user()?->name ?: "Anonymous"}}? <a href="{{route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Log out</a>)
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </p>
				From your account dashboard you can view your
                <a href="{{ route('orders') }}">recent orders</a>, manage your
                <a href="#">shipping and billing addresses</a> and
                <a href="#">edit your password and account details</a>.
                <div class="row mt-4">
                    <div class="col-md-4 col-sm-6 col-6">
                        <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title-user">Pending Orders <span>| Total</span></h5>

                            <div class="d-flex align-items-center">
                            <div class="card-icon-user-pending rounded-circle d-flex align-items-center justify-content-center">
                                <i class="tf-ion-android-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$status_wise_orders_count["pending"]}}</h6>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-6">
                        <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title-user">Completed Orders <span>| Total</span></h5>

                            <div class="d-flex align-items-center">
                            <div class="card-icon-user-delivered rounded-circle d-flex align-items-center justify-content-center">
                                <i class="tf-ion-ios-checkmark"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$status_wise_orders_count["delivered"]}}</h6>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-6">
                        <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title-user">Returned Orders <span>| Total</span></h5>

                            <div class="d-flex align-items-center">
                            <div class="card-icon-user-returned rounded-circle d-flex align-items-center justify-content-center">
                                <i class="tf-ion-ios-close"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$status_wise_orders_count["returned"]}}</h6>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</section>

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

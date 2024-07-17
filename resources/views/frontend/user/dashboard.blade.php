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
				From your account dashboard you can view your <a href="{{ route('orders') }}">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details</a>.
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

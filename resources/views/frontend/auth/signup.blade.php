@extends('frontend.layouts.app')
@section('content')

<div class="account section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="login-form border p-5">
					<div class="text-center heading">
						<h2 class="mb-2">Sign Up</h2>
					</div>

					<form action="#" method="POST">
                        @csrf
						<div class="form-group mb-4">
                            <label for="#">Enter Name</label>
							<a class="float-right" href="#">Forget password?</a>
							<input type="text" name="name" class="form-control" placeholder="Enter Name">
							<label for="#">Enter Email Address</label>
							<input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                            <label for="#">Enter Mobile Number</label>
							<input type="number" class="form-control" placeholder="Enter Password">
                            <label for="#">Enter Password</label>
							<input type="text" class="form-control" placeholder="Enter Password">
                            <label for="#">Confirm Password</label>
							<input type="text" class="form-control" placeholder="Confirm Password">
						</div>
						<button type="submit" class="btn btn-main mt-3 btn-block">Signup</button>
                        <p class="lead">Already have an account? <a href="{{route('login')}}"> Login now</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

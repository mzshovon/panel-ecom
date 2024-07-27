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
							<input type="text" name="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name">
							<label for="#">Enter Email Address</label>
							<input type="text" name="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email Address">
                            <label for="#">Enter Mobile Number</label>
							<input type="number" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="Enter Mobile ex. 01900000000">
                            <label for="#">Enter Password</label>
							<input type="password" class="form-control" name="password" placeholder="Enter Password">
                            <label for="#">Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                            <small></small>
						</div>
						<button type="submit" class="btn btn-main mt-3 btn-block submit-btn" disabled>Signup</button>
                        <p class="lead">Already have an account? <a href="{{route('login')}}"> Login now</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
    <script>
        $("input[name='password_confirmation']").on("keyup keydown", function(){
            let password = $("input[name='password']").val();
            let confirmPasswordDiv = $("input[name='password_confirmation']");
            let confirmPassword = confirmPasswordDiv.val();
            if(password == confirmPassword) {
                $(".submit-btn").prop("disabled", false);
                confirmPasswordDiv.next('small').html(`<small class='text-success'>Password matched</small>`);
            } else {
                $(".submit-btn").prop("disabled", true);
                confirmPasswordDiv.next('small').html(`<small class='text-danger'>Password doesn't match</small>`);
            }
        })
    </script>
    @if ($errors->any())
        @php
            $errorMessages = $errors->all();
        @endphp
        <script>
            let errorMessages = {!! json_encode($errorMessages) !!};
            let errorMessage = errorMessages.join("\n");
            showErrorAlert(errorMessage);
        </script>
    @endif
@endsection

@extends('frontend.layouts.app')
@section('content')

<div class="account section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-form border p-5">
                    <div class="text-center heading">
                        <h2>Reset Your Password</h2>
                    </div>
                    <form action="{{route('password.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-4">
                            <label for="#">Enter username</label>
                            <input type="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="#">Enter Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="#">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Enter Password" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-main mt-3 btn-block">Login</button>
                        <p class="lead">Don’t have an account? <a href="{{route('signup')}}">Create a free account</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
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


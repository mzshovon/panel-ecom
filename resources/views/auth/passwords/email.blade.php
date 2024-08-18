@extends('frontend.layouts.app')
@section('content')

<div class="account section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-form border p-5">
                    <div class="text-center heading">
                        <h2>Password Reset</h2>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="#">Enter email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Username">
                        </div>

                        <button type="submit" class="btn btn-main mt-3 btn-block">Send Reset Link</button>
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

@extends('frontend.layouts.app')
@section('content')

<div class="account section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-form border p-5">
                    <div class="text-center heading">
                        <h2>Login</h2>
                    </div>
                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="#">Enter username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="#">Enter Password</label>
                            <a class="float-right" href="{{route('password.email')}}">Forget password?</a>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
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

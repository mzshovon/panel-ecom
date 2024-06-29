@extends('frontend.layouts.app')
@section('content')
    <section class="page-404 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="error-content">
                        <h2 class="mb-4">{{ $exception->getMessage() ?? "Unauthorized Access"}}</h2>
                        <h1 class="mb-4">4<span class="text-muted">0</span>1</h1>
                        <a href="{{route('home')}}" class="btn btn-main">Go Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

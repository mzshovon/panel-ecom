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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Order</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">#1012</th>
                            <td>June 11, 2019 </td>
                            <td>Completed</td>
                            <td>30$</td>
                            <td><a href="#" class="btn btn-dark btn-small">View</a></td>
                        </tr>
                        <tr>
                            <th scope="row">#2214</th>
                            <td>March 10, 2019</td>
                            <td>Completed</td>
                            <td>50$</td>
                            <td><a href="#" class="btn btn-dark btn-small">View</a></td>
                        </tr>
                        <tr>
                            <th scope="row">#3434</th>
                            <td>February 11, 2019</td>
                            <td>Pending</td>
                            <td>25$</td>
                            <td><a href="#" class="btn btn-dark btn-small">View</a></td>
                        </tr>
                        <tr>
                            <th scope="row">#5312</th>
                            <td>July 11, 2019</td>
                            <td>Processsing</td>
                            <td>56$</td>
                            <td><a href="#" class="btn btn-dark btn-small">View</a></td>
                        </tr>
                    </tbody>
                </table>
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

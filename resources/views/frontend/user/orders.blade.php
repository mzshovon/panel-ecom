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
                @if (count($orders) > 0)
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
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">#{{$order['id']}}</th>
                                    <td>{{$order['created_at']}}</td>
                                    <td><p class="text-{{config('view.status.'.$order['status'])}}" style="font-weight:bold">{{ucfirst($order['status'])}}</p></td>
                                    <td>{{$order['total_amount_after_discount']}} TK.</td>
                                    <td><a href="{{route('user.order.details', ['id'=>$order['id']])}}" class="btn btn-dark btn-small">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h2 class="text-center">No Order Available!</h2>
                @endif
                {{$orders->links('pagination::bootstrap-5')}}
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

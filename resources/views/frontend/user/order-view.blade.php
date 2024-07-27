@extends('frontend.layouts.app')

@section('stylesheet')
    <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/css/custom-style.css">
@endsection

@section('content')

<div class="container">
    <article class="card mb-4">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">
            <h6>Order ID: #{{$order->id}}</h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Estimated Delivery time:</strong> <br>Inside Dhaka: 1-2 days <br> Outside Dhaka: 2-4 days</div>
                    <div class="col"> <strong>Shipping By:</strong> <br> {{config('app.name')}} <br> <i class="tf-ion-iphone"></i> {{ config('website.mobile') ?? "+880 1407-325822"}} </div>
                    <div class="col"> <strong>Status:</strong> <br> {{ucfirst($order->status)}} </div>
                    <div class="col"> <strong>Invoice No:</strong> <br> <b>{{$order->invoice_no ?? "ECMBD".$order->id}}</b> </div>
                </div>
            </article>
            <div class="track">
                <div class="step {{in_array($order->status, array_keys(config('view.track.step_one'))) ? config('view.track.step_one.'.$order->status) : ""}}">
                    <span class="icon">
                        <i class="tf-ion-checkmark"></i>
                    </span>
                    <span class="text">Order confirmed</span>
                </div>

                <div class="step {{in_array($order->status, array_keys(config('view.track.step_two'))) ? config('view.track.step_two.'.$order->status) : ""}}">
                    <span class="icon">
                        <i class="tf-ion-person"></i>
                    </span>
                    <span class="text"> Picked by courier</span>
                </div>

                <div class="step {{in_array($order->status, array_keys(config('view.track.step_three'))) ? config('view.track.step_three.'.$order->status) : ""}}">
                    <span class="icon">
                        <i class="tf-ion-cube"></i>
                    </span>
                    <span class="text"> On the way </span>
                </div>

                <div class="step {{in_array($order->status, array_keys(config('view.track.step_four'))) ? config('view.track.step_four.'.$order->status) : ""}}">
                    <span class="icon">
                        <i class="tf-ion-happy-outline"></i>
                    </span>
                    <span class="text">{{ucfirst($order->status)}}</span>
                </div>
            </div>
            <hr>
            <ul class="row">
                @foreach ($order->products as $orderedProduct)
                    <li class="col-md-4">
                        <figure class="itemside mb-3">
                            <div class="aside"><img src="{{URL::to("/") . "/" .$orderedProduct->product['images'][0]['image_path']}}" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <p class="title">{{$orderedProduct->product['name']}} <br> Unit: {{$orderedProduct->quantity}}</p> <span class="text-muted">{{$orderedProduct->quantity * $orderedProduct->price}} TK.</span>
                            </figcaption>
                        </figure>
                    </li>
                @endforeach
            </ul>
            <hr>
            <a href="{{route("user.orders")}}" class="btn btn-main" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
        </div>
    </article>
</div>

@endsection

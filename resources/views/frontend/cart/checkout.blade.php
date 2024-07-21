@extends('frontend.layouts.app')
@section('content')

<section class="page-header">
    <div class="overly"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content text-center">
                    <h1 class="mb-3">Cart</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent justify-content-center">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="page-wrapper">
    <div class="checkout shopping">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pr-5">
                    <div class="coupon-notice " data-toggle="modal" data-target="#coupon-modal">
                        <div class="bg-light p-3">
                            Have a coupon? <a href="#" class="showcoupon">Click here to enter your code</a>
                        </div>
                    </div>

                    <div class="billing-details mt-5">
                        <h4 class="mb-4">Billing Details</h4>
                        <form class="checkout-form" method="POST" action="{{route('orders')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="first_name">Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="first_name">Email address </label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="first_name">Address <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="address" id="msg" cols="30" rows="3"
                                            placeholder="Address on house no, lane etc."></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="company_name">Division <span class="text-danger">*</span></label>
                                        <select class="form-control" name="division">
                                            @foreach (config('website.user.division') as $division)
                                                <option value="{{$division}}">{{$division}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="first_name">Town / City </label>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Apartment">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="first_name">Area</label>
                                        <input type="text" class="form-control" name="area" id="street" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="first_name">Order notes (optional)</label>
                                        <textarea class="form-control" name="notes" id="msg" cols="30" rows="5"
                                            placeholder="Notes about order e:g: want to say something"></textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12">
                                    <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Create an account?</label>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                        <label class="form-check-label" for="exampleCheck2">Ship to a different
                                            address?</label>
                                    </div>
                                </div>

                            </div>
                        {{-- </form> --}}
                    </div>
                </div>

                <!-- Order sidebar Summery -->
                <div class="col-md-6 col-lg-4">
                    <div class="product-checkout-details mt-5 mt-lg-0">
                        <h4 class="mb-4 border-bottom pb-4">Order Summary</h4>
                        @php
                            $subTotalAmount = 0;
                            $totalAmount = 0;
                        @endphp
                        @forelse ($carts as $cart)
                            @php
                                $subTotalAmount += $cart['product']['price'];
                                $totalAmount += $cart['product']['price'];
                            @endphp
                            <div class="media product-card">
                                <p>{{$cart['product']['name']}}</p>
                                <div class="media-body text-right">
                                    <p class="h5">{{$cart['quantity']}} x {{$cart['product']['price']}} TK.</p>
                                </div>
                            </div>
                        @empty
                            No Product Available!
                        @endforelse


                        <ul class="summary-prices list-unstyled mb-4">
                            <li class="d-flex justify-content-between">
                                <span>Subtotal:</span>
                                <span class="h5">{{$subTotalAmount}} TK.</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Shipping:</span>
                                <span class="h5">Free</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Total</span>
                                <span class="h5">{{$totalAmount}} TK.</span>
                            </li>
                        </ul>

                        {{-- <form action="#"> --}}
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                    value="option1" disabled>
                                <label class="form-check-label" for="exampleRadios1">
                                    Direct bank transfer
                                </label>

                                <div class="alert alert-secondary mt-3" role="alert">
                                    We are offering cash on delivery service.
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="payment_type" id="exampleRadios2"
                                    value="cash on delivery" checked>
                                <label class="form-check-label" for="exampleRadios2">
                                    Cash On Delivery
                                </label>
                            </div>

                            {{-- <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="exampleCheck3">
                                <label class="form-check-label" for="exampleCheck3">I have read and agree to the website
                                    terms and conditions *</label>
                            </div> --}}


                        {{-- <div class="info mt-4 border-top pt-4 mb-5">
                            Your personal data will be used to process your order, support your experience throughout
                            this website, and for other purposes described in our <a href="#">privacy policy</a>.
                        </div> --}}
                        <button type="submit" class="btn btn-main btn-small">Place Order</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="coupon-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content py-5">
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Enter Coupon Code">
                    </div>
                    <button type="submit" class="btn btn-main btn-small">Apply Coupon</button>
                </form>
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

@extends('admin.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{$page}}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.layouts.partials.alerts')
                    <form class="row g-3" method="POST" action="{{route('admin.orders.store')}}">
                        @csrf
                        <div class="col-md-3">
                            <label for="inputName5" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="inputName5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="inputEmail5" maxlength="11"
                                min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Status</label>
                            <select id="inputState" name="status" class="form-select">
                                @foreach ($orderStatus as $status)
                                    <option value="{{$status}}">{{ucfirst($status)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Total Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="inputPassword5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Total Amount</label>
                            <input type="text" name="total_amount" class="form-control" id="inputPassword5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Total Discount</label>
                            <input type="text" name="total_discount" class="form-control" value="0" id="inputPassword5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Total Amount After Discount</label>
                            <input type="text" name="total_amount_after_discount" class="form-control" id="inputPassword5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Shipping Charge</label>
                            <input type="text" name="shipping_charge" class="form-control" value="0" id="inputPassword5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputState" class="form-label">Payment Type</label>
                            <select id="inputState" name="payment_type" class="form-select">
                                <option value="Cash on delivery">Cash On Delivery</option>
                                <option value="Payment Gateway">Payment Gateway</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputCity" class="form-label">City</label>
                            <input type="text" name="city" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-2">
                            <label for="inputZip" class="form-label">Zip</label>
                            <input type="text" name="zip" class="form-control" id="inputZip">
                        </div>
                        <div class="col-6">
                            <label for="floatingTextarea">Address</label>
                            <textarea class="form-control" name="address" placeholder="Address" id="floatingTextarea"
                                style="height: 100px;"></textarea>
                        </div>
                        <div class="col-6">
                            <label for="floatingTextarea">Notes</label>
                            <textarea class="form-control" name="notes" placeholder="Notes" id="floatingTextarea"
                                style="height: 100px;"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{route('admin.orders.index')}}" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i> Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('input[name="total_amount"]').on("blur change", function(){
                let totalAmountAfterDiscount = getTotalAmountAfterDiscount();
                $('input[name="total_amount_after_discount"]').val(totalAmountAfterDiscount);
            });
            $('input[name="total_discount"]').on("blur change", function(){
                let totalAmountAfterDiscount = getTotalAmountAfterDiscount();
                $('input[name="total_amount_after_discount"]').val(totalAmountAfterDiscount);
            });
            $('input[name="shipping_charge"]').on("blur change", function(){
                let totalAmountAfterDiscount = getTotalAmountAfterDiscount();
                $('input[name="total_amount_after_discount"]').val(totalAmountAfterDiscount);
            });

            function getTotalAmountAfterDiscount()
            {
                let totalAmount = $('input[name="total_amount"]').val() ?? 0;
                let discount = $('input[name="total_discount"]').val() ?? 0;
                let shippingCharge = $('input[name="shipping_charge"]').val() ?? 0;
                let totalAmountAfterDiscount = parseInt(totalAmount) + parseInt(shippingCharge) - parseInt(discount);
                return totalAmountAfterDiscount;
            }
        });

    </script>

@endsection

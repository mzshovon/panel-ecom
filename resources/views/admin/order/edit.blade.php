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
                    @if (!empty($order))
                    <form class="row g-3" method="POST" action="{{route('admin.orders.update',['order'=>$order['id']])}}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-3">
                            <label for="inputName5" class="form-label">Name</label>
                            <input type="hidden" name="id" class="form-control" id="inputName5" value="{{$order->id}}">
                            <input type="text" name="name" class="form-control" id="inputName5" value="{{$order->name ?? ""}}">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail5" value="{{$order->email ?? ""}}">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="inputEmail5" maxlength="11"
                                min="0" value="{{$order->mobile ?? ""}}">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Status</label>
                            <input type="hidden" name="prev_status" class="form-control" value="{{$order->status}}">
                            <select id="inputState" name="status" class="form-select">
                                @foreach ($orderStatus as $status)
                                    <option value="{{$status}}" {{ $order->status == $status ? "selected" : ""}}>{{ucfirst($status)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Total Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="inputPassword5" value="{{$order->quantity ?? 0}}">
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Total Amount</label>
                            <input type="text" name="total_amount" class="form-control" value="{{$order->total_amount ?? 0}}"
                                id="inputPassword5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Total Discount</label>
                            <input type="text" name="total_discount" class="form-control" value="{{$order->total_discount ?? 0}}"
                                id="inputPassword5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Total Amount After Discount</label>
                            <input type="text" name="total_amount_after_discount" class="form-control" value="{{$order->total_amount_after_discount ?? 0}}"
                                id="inputPassword5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">Shipping Charge</label>
                            <input type="text" name="shipping_charge" class="form-control" value="{{$order->shipping_charge ?? 0}}"
                                id="inputPassword5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputState" class="form-label">Payment Type</label>
                            <select id="inputState" name="payment_type" class="form-select">
                                <option value="{{$order->payment_type}}" {{$order->payment_type == "Cash on delivery"}}>Cash On Delivery</option>
                                <option value="{{$order->payment_type}}" {{$order->payment_type == "Payment Gateway"}}>Payment Gateway</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">Invoice No.</label>
                            <input type="text" name="invoice_no" class="form-control" id="inputEmail5" placeholder="Ex.ECMBD01" value="{{$order->invoice_no}}">
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">Merchant ID</label>
                            <input type="text" name="merchant_id" class="form-control" id="inputEmail5" value="{{$order->merchant_id}}">
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">Courier</label>
                            <select id="inputState" name="courier" class="form-select">
                                <option value="pathao" {{$order->courier == 'pathao' ? 'selected' : ''}}>Pathao</option>
                                <option value="steadfast" {{$order->courier == 'steadfast' ? 'selected' : ''}}>Steadfast</option>
                                <option value="by office" {{$order->courier == 'by office' ? 'selected' : ''}}>By Office</option>
                                <option value="redex" {{$order->courier == 'redex' ? 'selected' : ''}}>Redex</option>
                                <option value="sundarban" {{$order->courier == 'sundarban' ? 'selected' : ''}}>Sundarban</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="floatingTextarea">Address</label>
                            <textarea class="form-control" name="address" placeholder="Address" id="floatingTextarea"
                                style="height: 100px;">{{$order->address ?? ""}}</textarea>
                        </div>
                        <div class="col-6">
                            <label for="floatingTextarea">Notes</label>
                            <textarea class="form-control" name="notes" placeholder="Address" id="floatingTextarea"
                                style="height: 100px;">{{$order->notes ?? ""}}</textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.orders.index')}}" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i> Back</a>
                        </div>
                    </form>
                    @else
                        No Data Available!
                    @endif


                </div>
            </div>

        </div>

    </div>
</section>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('input[name="quantity"]').on("blur change", function(){
                let totalAmountAfterDiscount = getTotalAmountAfterDiscount();
                $('input[name="total_amount_after_discount"]').val(totalAmountAfterDiscount);
            });
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
                let totalQty = $('input[name="quantity"]').val() ?? 0;
                let totalAmount = totalQty * $('input[name="total_amount"]').val() ?? 0;
                let discount = $('input[name="total_discount"]').val() ?? 0;
                let shippingCharge = $('input[name="shipping_charge"]').val() ?? 0;
                let totalAmountAfterDiscount = parseInt(totalAmount) + parseInt(shippingCharge) - parseInt(discount);
                return totalAmountAfterDiscount;
            }
        });

    </script>

@endsection

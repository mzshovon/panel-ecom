@extends('admin.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{$page}}</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">
            <br>
            @include('admin.layouts.partials.alerts')
            <!-- Table with stripped rows -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Order Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order->products as $product)
                    <tr data-id="p-{{$product['id']}}">
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$product->product->name}}</td>
                        <td><input type="number" name="quantity" value="{{$product['quantity']}}" style="max-width: 20%"></td>
                        <td>{{$product['price']}} TK.</td>
                        <td>{{$product['quantity'] * $product['price']}} TK.</td>
                        <td>
                            <a class="btn btn-danger btn-sm"
                                onclick="deleteRow('{{route('admin.orders.destroy', ['order' => $product['id']])}}', '{{csrf_token()}}', '{{$product['id']}}')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <h3 class="text-center">No Data Available!</h3>
                    @endforelse
                    <tr>
                        <td colspan="3"> </td>
                        <td> Sub Total:</td>
                        <td class="sub-total"> <b>{{$order->total_amount}} Tk. </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3"> </td>
                        <td> Shipping Charge:</td>
                        <td class="shipping-charge"> <b>{{$order->shipping_charge}} Tk. </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3"> </td>
                        <td> Total:</td>
                        <td class="total"> <b>{{$order->total_amount_after_discount}} Tk. </b></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{URL::to('/')}}/public/assets/js/custom.js"></script>
<script>
    $("input[name='quantity']").on("change", function(){
        let quantity = $(this).val();
        let unitPrice = $(this).parent('td').next("td").text();
        let totalPriceDiv = $(this).parent('td').next("td").next("td");
        let subTotalAmountDiv = $('.sub-total');
        let shippingChargeDiv = $('.shipping-charge');
        let totalAmountDiv = $('.total');
        // Amount calculation
        let totalPrice  = parseInt(unitPrice) * quantity;
        let subTotalAmount = parseInt(subTotalAmountDiv.text()) + parseInt(unitPrice);
        let totalAmount = parseInt(subTotalAmount) + parseInt(shippingChargeDiv.text());
        // DOM manipluation
        totalPriceDiv.text(`${totalPrice} TK.`);
        subTotalAmountDiv.html(`<b>${subTotalAmount} TK.</b>`);
        totalAmountDiv.html(`<b>${totalAmount} TK.</b>`);
        console.log(quantity, totalPrice, unitPrice);
    })
</script>
@endsection

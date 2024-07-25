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
                        <td>
                            <input type="number" class="qty" name="quantity" value="{{$product['quantity']}}" style="max-width: 20%" min="1">
                            <input type="hidden" name="order_id" value="{{$order->id}}" style="max-width: 20%" min="1">
                            <input type="hidden" name="product_id" value="{{$product['id']}}" style="max-width: 20%" min="1">
                            <a class="btn btn-primary btn-sm update-order-product">
                                <i class="bi bi-save"></i>
                            </a>
                        </td>
                        <td>{{$product['price']}} TK.</td>
                        <td class="total-price">{{$product['quantity'] * $product['price']}} TK.</td>
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
                        <td class="sub-total"> <b>{{$order->total_amount}} TK. </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3"> </td>
                        <td> Shipping Charge:</td>
                        <td class="shipping-charge"> <b>{{$order->shipping_charge}} TK. </b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3"> </td>
                        <td> Total:</td>
                        <td class="total"> <b>{{$order->total_amount_after_discount}} TK. </b></td>
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
<script>
    $("input[name='quantity']").on("change", function(){
        let subTotalAmount = 0;
        let quantity = $(this).val();
        let unitPrice = $(this).parent('td').next("td").text();
        let totalPriceDiv = $(this).parent('td').next("td").next("td");
        let subTotalAmountDiv = $('.sub-total');
        let shippingChargeDiv = $('.shipping-charge');
        let totalAmountDiv = $('.total');
        // Amount calculation
        let totalPrice  = parseInt(unitPrice) * quantity;

        // DOM manipluation
        totalPriceDiv.text(`${totalPrice} TK.`);

        $('.table tr').each(function() {
            let $tr = $(this);
            let $changeAmount = $tr.find('td:eq(3)').text().trim() != "" ? parseInt($tr.find('td:eq(3)').text().trim()) : 0;
            subTotalAmount += $changeAmount;
        });
        let totalAmount = subTotalAmount + parseInt(shippingChargeDiv.text());
        subTotalAmountDiv.html(`<b>${subTotalAmount} TK.</b>`);
        totalAmountDiv.html(`<b>${totalAmount} TK.</b>`);
    });

    $(".update-order-product").on("click", function(){
        let totalQty = 0;
        let product_id = $(this).prev("input").val();
        let order_id = $(this).prev("input").prev("input").val();
        let quantity = $(this).prev("input").prev("input").prev("input").val();
        $('.qty').each(function() {
            totalQty += Number($(this).val());
        });

        let subTotalAmount = parseInt($('.sub-total').text());
        console.log(order_id,product_id,quantity,subTotalAmount,totalQty);
        $.ajax({
            type: "POST",
            url: '{{route('admin.orders.update.product')}}',
            data: {
                _token: '{{csrf_token()}}',
                product_id: product_id,
                order_id: order_id,
                quantity: quantity,
                total_quantity: totalQty,
                total_amount: subTotalAmount,
            },
            success: function (data) {
                Swal.fire({
                    title: "Success!",
                    text: data.message,
                    icon: "success"
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "Error!",
                    text: data.message,
                    icon: "error"
                });
            },
        });
    });

</script>
@endsection

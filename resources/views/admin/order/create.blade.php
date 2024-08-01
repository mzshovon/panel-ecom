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
                        <div class="col-12">
                            <div id="product-container">
                                <div class="product-group">
                                    <div class="row">

                                    <div class="col-md-6">
                                    <select name="products[]" class="product-dropdown form-select">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                        <option value="{{$product['id']}}"
                                        data-price="{{ $product['price'] }}"
                                        data-cost="{{ $product['purchase_cost'] }}"
                                        data-stock="{{ $product['stock'] }}"
                                        data-threshold="2">
                                        {{ucfirst($product['name'])}} - {{$product['stock']}} Piece Available
                                    </option>
                                    @endforeach
                                    </select>
                                    </div>
                                    <div class="col-md-5">
                                    <input type="number" name="quantities[]" class="quantity-input form-control" placeholder="Quantity" min="1">
                                    <span class="stock-warning" style="display: none; color: red;">Stock is about to end!</span>
                                    <span class="stock-error" style="display: none; color: red;">Product out of stock!</span>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-outline-primary btn-md" type="button" id="addProductBtn">Add</button>
                                    </div>
                                </div>
                                </div>
                            </div>
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
            const productContainer = $('#product-container');

            $('#addProductBtn').click(function() {
                let newProductGroup = $('.product-group:first').clone();
                newProductGroup.find('input.quantity-input').val('');
                newProductGroup.find('.stock-warning').hide();
                newProductGroup.find('.stock-error').hide();
                productContainer.append(newProductGroup);
            });

            productContainer.on('change', '.product-dropdown, .quantity-input', function() {
                let $group = $(this).closest('.product-group');
                let selectedProduct = $group.find('.product-dropdown option:selected');
                let stock = parseInt(selectedProduct.data('stock'));
                let threshold = parseInt(selectedProduct.data('threshold'));
                let quantity = parseInt($group.find('.quantity-input').val());

                // Reset warnings and errors
                $group.find('.stock-warning').hide();
                $group.find('.stock-error').hide();

                // Check if stock is 0
                if (stock === 0) {
                    $group.find('.stock-error').show();
                    $group.find('.quantity-input').prop('disabled', true);
                } else {
                    $group.find('.quantity-input').prop('disabled', false);

                    // Check if stock is less than or equal to the threshold
                    if (stock <= threshold) {
                        $group.find('.stock-warning').show();
                    }
                }
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
                let totalAmount = $('input[name="total_amount"]').val() ?? 0;
                let discount = $('input[name="total_discount"]').val() ?? 0;
                let shippingCharge = $('input[name="shipping_charge"]').val() ?? 0;
                let totalAmountAfterDiscount = parseInt(totalAmount) + parseInt(shippingCharge) - parseInt(discount);
                return totalAmountAfterDiscount;
            }
        });

    </script>

@endsection

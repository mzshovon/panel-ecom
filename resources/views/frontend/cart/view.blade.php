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
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@php
    $totalAmount = 0;
@endphp
<section class="cart shopping page-wrapper">
@if (count($carts) > 0)
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
          <div class="product-list">
            <form class="cart-form" action="#" method="post">
                <table class="table shop_table shop_table_responsive cart" cellspacing="0">
                    <thead>
                      <tr>
                          <th class="product-thumbnail">&nbsp;</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-subtotal">Total</th>
                          <th class="product-remove">&nbsp;</th>
                      </tr>
                    </thead>

                    <tbody>
                      @forelse ($carts as $key => $cart)
                            @php
                                $totalAmount += $cart['product']['price'];
                            @endphp
                          <tr class="cart_item product-row-{{$cart['product']['id']}}">
                              <td class="product-thumbnail" data-title="Thumbnail">
                                  <a href="{{route('single-product', ['productId'=>$cart['product']['id']])}}"><img src="{{URL::to("/") . "/" .$cart['product']['images'][0]['image_path']}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""></a>
                              </td>

                              <td class="product-name" data-title="Product">
                                  <a href="{{route('single-product', ['productId'=>$cart['product']['id']])}}">{{$cart['product']['name']}}</a>
                              </td>

                              <td class="product-price" data-title="Price">
                                  <span class="amount"><span class="currencySymbol"></span>{{$cart['quantity']}} X {{$cart['product']['price']}} TK.</span>
                              </td>

                              <td class="product-quantity" data-title="Quantity">
                                  <div class="quantity">
                                      <label class="sr-only" >Quantity</label>
                                      <input type="number" id="quantity_{{$cart['product']['id']}}" class="input-text qty text" step="1" min="0" max="9" value="1" title="Qty" size="4">
                                      <button type="button" class="btn-main" onclick="addInputValueToCart('{{route('cart.add')}}', '{{csrf_token()}}', {{$cart['product']['id']}}, 1)"><i class="tf-ion-upload"></i></button>
                                    </div>
                              </td>
                              <td class="product-subtotal" data-title="Total">
                                  <span class="amount">
                                  <span class="currencySymbol"></span>{{$cart['quantity'] * $cart['product']['price']}}</span>
                              </td>

                              <td class="product-remove" data-title="Remove">
                                  <a class="remove" aria-label="Remove this item" data-product_id="30" data-product_sku="" onclick="deleteCart({{$cart['product']['id']}})">×</a>
                              </td>
                          </tr>
                      @empty
                          No product in cart!
                      @endforelse
                      <tr>
                          <td colspan="6" class="actions">
                              <div class="coupon">
                                <input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="Coupon code">

                                <button type="submit" class="btn btn-black btn-small" name="apply_coupon" value="Apply coupon">Apply coupon</button>

                                {{-- <span class="float-right mt-3 mt-lg-0">
                                  <button type="submit" class="btn btn-dark btn-small" name="update_cart" value="Update cart" disabled="">Update cart</button>
                                </span>
                              </div>

                              <input type="hidden" id="woocommerce-cart-nonce" name="woocommerce-cart-nonce" value="27da9ce3e8">
                              <input type="hidden" name="_wp_http_referer" value="/cart/"> --}}
                            </td>
                      </tr>
                    </tbody>
                </table>
            </form>
        </div>
      </div>
    </div>

      <div class="row justify-content-end">
        <div class="col-lg-4">
          <div class="cart-info card p-4 mt-4">
              <h4 class="mb-4">Cart totals</h4>

                 <li class="d-flex justify-content-between pb-2">
                  <h5>Total</h5>
                  <span>{{$totalAmount}} TK.</span>
                </li>
              </ul>
              <a href="{{route('cart.checkout')}}" class="btn btn-main btn-small">Proceed to checkout</a>
          </div>
        </div>
      </div>
    </div>
    @else
    <div>
        <img src="{{URL::to('/')}}/public/frontend/images/noproduct.png" alt="Product big thumb" class="no-cart-product">
    <div>

@endif
</section>

 @endsection

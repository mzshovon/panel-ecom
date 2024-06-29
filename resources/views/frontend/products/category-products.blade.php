@extends('frontend.layouts.app')
@section('content')

{{-- @dd($products) --}}

<section class="page-header">
    <div class="overly"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content text-center">
                    <h1 class="mb-3">{{$category['name']}}</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent justify-content-center">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$category['name']}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="products-shop section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row align-items-center">
                    <div class="col-lg-12 mb-4 mb-lg-0">
                        <div class="section-title">

                            <div class="heading d-flex justify-content-between mb-5">
                                <form class="ordering " method="get">
                                    <select name="orderby" class="orderby form-control" aria-label="Shop order">
                                        <option value="" selected="selected">Default sorting</option>
                                        <option value="">Sort by popularity</option>
                                        <option value="">Sort by average rating</option>
                                        <option value="">Sort by latest</option>
                                        <option value="">Sort by price: low to high</option>
                                        <option value="">Sort by price: high to low</option>
                                    </select>
                                    <input type="hidden" name="paged" value="1">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @forelse ($products as $product)
                    <div class="col-lg-4 col-12 col-md-6 col-sm-6 mb-5">
                        <div class="product">
                            <div class="product-wrap">
                                @foreach ($product['images'] as $key => $image)
                                    <a href="{{route('single-product', ['productId' => $product['id']])}}">
                                        @if (in_array($key, [0,1]))
                                                <img class="img-fluid latest-img mb-3 img-{{numberToOrdinal($key + 1)}}" src="{{URL::to("/") . "/" .$image['image_path']}}" alt="product-img"/>
                                        @endif
                                    </a>
                                @endforeach
                            </div>

                            @if ($product['stock'] > 0)
                                <span class="onsale">Sale</span>
                            @endif
                            <div class="product-hover-overlay">
                                <a href="#"><i class="tf-ion-android-cart"></i></a>
                                <a href="#"><i class="tf-ion-ios-heart"></i></a>
                            </div>

                            <div class="product-info">
                                <h2 class="product-title h5 mb-0"><a href="product-single.html">{{$product['name']}}</a></h2>
                                <span class="price">
                                    {{$product['price']}} TK.
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                        No products available for this category!
                    @endforelse
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            {{$products->links('pagination::bootstrap-5')}}
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
             @include('frontend.products.single.layouts.sidebar-categories')
             @include('frontend.products.single.layouts.category-filter')
             {{-- @include('frontend.products.single.layouts.category-popular') --}}
            </div>
        </div>
    </div>
</section>

@endsection

@if (count($upcoming_products) > 0)
    @php
        $colLgNum = [
            "2" => 6,
            "3" => 4,
        ];
        $colMdNum = [
            "2" => 12,
            "3" => 6,
        ];
        $count = count($upcoming_products);
    @endphp
    <section class="category section pt-3 pb-0">
        <div class="container">
            <div class="row">
                @forelse ($upcoming_products as $product)
                    <div class="col-lg-{{$colLgNum[$count]}} col-sm-12 col-md-{{$colMdNum[$count]}}">
                        <div class="cat-item mb-4 mb-lg-0">
                            <img src="{{URL::to("/") . "/" .$product['images'][0]['image_path']}}" alt="">
                            <div class="item-info">
                                <p class="mb-0">{{$product['name']}}</p>
                                <h4 class="mb-4">up to <strong>50% </strong>off</h4>
                                <a href="#" class="read-more">Shop now</a>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

            </div>
        </div>
    </section>
@endif


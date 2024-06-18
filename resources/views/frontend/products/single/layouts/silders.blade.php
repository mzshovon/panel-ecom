<div class="col-md-5">
    <div class="single-product-slider">
        <div class="carousel slide" data-ride="carousel" id="single-product-slider">
            <div class="carousel-inner">
                @foreach ($product->images as $key => $image)
                    <div class="carousel-item {{$key === 0 ? 'active' : ''}}">
                        <img src="{{URL::to("/") . "/" .$image->image_path}}" alt="" class="img-fluid">
                    </div>
                @endforeach
            </div>

            <ol class="carousel-indicators">
                @foreach ($product->images as $key => $image)
                    <li data-target="#single-product-slider" data-slide-to="{{$key}}"
                    @if ($key === 0)
                        class="active"
                    @endif
                    >
                        <img src="{{URL::to("/") . "/" .$image->image_path}}" alt="" class="img-fluid">
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>

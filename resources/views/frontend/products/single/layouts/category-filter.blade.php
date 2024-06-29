<form action="#" class="mb-5">

    <!-- price range -->
    <section id="#" class="widget widget_price_filter mb-5">
        <h3 class="widget-title h4 mb-4">Filter by price</h3>
        <div class="price_slider_wrapper">
            <div class="price_slider_amount" data-step="10">
                <input class="range-track" type="text" data-slider-min="0" data-slider-max="1000"
                    data-slider-step="5" data-slider-value="[0,300]" />
                <div class="price_label mb-3">
                    Price: <span class="value">$0 - $300</span>
                </div>
            </div>
        </div>
    </section>
    <!-- color -->
    <section class="widget widget-colors mb-5">
        <h3 class="widget-title h4 mb-4">Shop by color</h3>
        <ul class="list-inline">
            <li class="list-inline-item mr-4">
                <div class="custom-control custom-checkbox color-checkbox">
                    <input type="checkbox" class="custom-control-input" id="color1">
                    <label class="custom-control-label sky-blue" for="color1"></label>
                </div>
            </li>
            <li class="list-inline-item mr-4">
                <div class="custom-control custom-checkbox color-checkbox">
                    <input type="checkbox" class="custom-control-input" id="color2" checked>
                    <label class="custom-control-label red" for="color2"></label>
                </div>
            </li>
            <li class="list-inline-item mr-4">
                <div class="custom-control custom-checkbox color-checkbox">
                    <input type="checkbox" class="custom-control-input" id="color3">
                    <label class="custom-control-label dark" for="color3"></label>
                </div>
            </li>
            <li class="list-inline-item mr-4">
                <div class="custom-control custom-checkbox color-checkbox">
                    <input type="checkbox" class="custom-control-input" id="color4">
                    <label class="custom-control-label magenta" for="color4"></label>
                </div>
            </li>
            <li class="list-inline-item mr-4">
                <div class="custom-control custom-checkbox color-checkbox">
                    <input type="checkbox" class="custom-control-input" id="color5">
                    <label class="custom-control-label yellow" for="color5"></label>
                </div>
            </li>
        </ul>
    </section>

    <!-- size -->
    <section class="widget widget-sizes mb-5">
        <h3 class="widget-title h4 mb-4">Shop by Sizes</h3>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="size1" checked>
            <label class="custom-control-label" for="size1">L Large</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="size2">
            <label class="custom-control-label" for="size2">XL Extra Large</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="size3">
            <label class="custom-control-label" for="size3">M Medium</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="size4">
            <label class="custom-control-label" for="size4">S Small</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="size5">
            <label class="custom-control-label" for="size5">XS Extra Small</label>
        </div>
    </section>

    <button type="submit" class="btn btn-black btn-small">Filter</button>
</form>

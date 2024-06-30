<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center text-sm-left mr-auto">
                <div class="footer-widget">
                    <h4 class="mb-4"><img src="{{URL::to('/')}}/public/frontend/images/logo.png" alt="Vaxon."
                            class="img-fluid"></h4>
                    <p class="lead">Welcome to Ecom Mart BD! Your trusted one-stop destination for all needs!
                    </p>

                    <div class="">
                        <p class="mb-0"><strong>Location : </strong>Dhaka</p>
                        <p><strong>Support Email : </strong> support@ecommartbd.com</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-2 col-sm-6 mb-5 mb-lg-0 text-center text-sm-left">
                <div class="footer-widget">
                    <h4 class="mb-4">Category</h4>
                    <ul class="pl-0 list-unstyled mb-0">
                        @forelse (getCategoryList() as $category)
                        <li><a
                                href="{{route('category-product', ['catId' => $category['id']])}}">{{$category['name']}}</a>
                        </li>
                        @empty
                        No category found!
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="col-md-6 col-lg-2 col-sm-6 mb-5 mb-lg-0 text-center text-sm-left">
                <div class="footer-widget">
                    <h4 class="mb-4">Useful Link</h4>
                    <ul class="pl-0 list-unstyled mb-0">
                        <li><a href="">News &amp; Tips</a></li>
                        <li><a href="">About Us</a></li>
                        <li><a href="">Support</a></li>
                        <li><a href="">Our Shop</a></li>
                        <li><a href="">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 col-sm-6 text-center text-sm-left">
                <div class="footer-widget">
                    <h4 class="mb-4">Opening Hours</h4>
                    <ul class="pl-0 list-unstyled mb-5">
                        <li class="d-lg-flex justify-content-between">Monday-Friday <span>9.00 A.M -11.00 P.M</span>
                        </li>
                        <li class="d-lg-flex justify-content-between">Saturday <span>9.00 A.M -9.00 P.M</span></li>
                        <li class="d-lg-flex justify-content-between">Sunday <span>9.00 A.M -9.00 P.M</span></li>
                    </ul>

                    <h5>Call Now : +880 1407-325822</h5>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="footer-btm py-4 ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-6">
                <p class="copyright mb-0 ">@2024 Copyright Reserved to <a href="https://ecommartbd.com">Ecom Mart BD</a>
                    &amp; made by <a href="https://ecommartbd.com">Ecom Mart BD</a></p>
            </div>
            <div class="col-lg-6">
                <ul class="list-inline mb-0 footer-btm-links text-lg-right mt-2 mt-lg-0">
                    <li class="list-inline-item"><a href="">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="">Terms &amp; Conditions</a></li>
                    <li class="list-inline-item"><a href="">Cookie Policy</a></li>
                    <li class="list-inline-item"><a href="">Terms of Sale</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

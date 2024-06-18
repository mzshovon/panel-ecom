<div class="row">
    <div class="col-lg-12">
        <nav class="product-info-tabs wc-tabs mt-5 mb-5">
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Additional Information</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Reviews(2)</a>
          </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            {!! $product->description !!}
          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

            <ul class="list-unstyled info-desc">
              <li class="d-flex">
                <strong>Weight </strong>
                <span>{{$product->weight}} gm.</span>
              </li>
              <li class="d-flex">
                <strong>Dimensions </strong>
                <span>{{$product->height}} cm</span>
              </li>
              {{-- <li class="d-flex">
                <strong>Materials</strong>
                <span >60% cotton, 40% polyester</span>
              </li> --}}
              <li class="d-flex">
                <strong>Variants </strong>
                <span>
                    @php
                        echo ucwords(implode(", ", json_decode($product->variants, true)));
                    @endphp
                </span>
              </li>
              {{-- <li class="d-flex">
                <strong>Size</strong>
                <span>L, M, S, XL, XXL</span>
              </li> --}}
            </ul>
          </div>
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="row">
                <div class="col-lg-7">
                    <div class="media review-block mb-4">
                        <img src="images/shop/avater-1.jpg" alt="reviewimg" class="img-fluid mr-4">
                        <div class="media-body">
                            <div class="product-review">
                                <span><i class="tf-ion-android-star"></i></span>
                                <span><i class="tf-ion-android-star"></i></span>
                                <span><i class="tf-ion-android-star"></i></span>
                                <span><i class="tf-ion-android-star"></i></span>
                                <span><i class="tf-ion-android-star"></i></span>
                            </div>
                            <h6>NasaTheme <span class="text-sm text-muted font-weight-normal ml-3">-June 23, 2019</span></h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum suscipit consequuntur in, perspiciatis laudantium ipsa fugit. Iure esse saepe error dolore quod.</p>
                        </div>
                    </div>

                    <div class="media review-block">
                        <img src="images/shop/avater-2.jpg" alt="reviewimg" class="img-fluid mr-4">
                        <div class="media-body">
                            <div class="product-review">
                                <span><i class="tf-ion-android-star"></i></span>
                                <span><i class="tf-ion-android-star"></i></span>
                                <span><i class="tf-ion-android-star"></i></span>
                                <span><i class="tf-ion-android-star"></i></span>
                                <span><i class="tf-ion-android-star-outline"></i></span>
                            </div>
                            <h6>NasaTheme <span class="text-sm text-muted font-weight-normal ml-3">-June 23, 2019</span></h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum suscipit consequuntur in, perspiciatis laudantium ipsa fugit. Iure esse saepe error dolore quod.</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-5">
                    <div class="review-comment mt-5 mt-lg-0">
                        <h4 class="mb-3">Add a Review</h4>

                        <form action="#">
                            <div class="starrr"></div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <textarea name="comment" id="comment" class="form-control" cols="30" rows="4" placeholder="Your Review"></textarea>
                            </div>

                            <a href="#" class="btn btn-main btn-small">Submit Review</a>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <nav class="product-info-tabs wc-tabs mt-5 mb-5">
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Additional Information</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Reviews({{$product->reviews->count()}})</a>
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
                    @forelse ($product->reviews->take(5) as $review)
                        <div class="media review-block mb-4">
                            <img src="{{URL::to('/')}}/public/frontend/images/avatar.png" alt="reviewimg" class="img-fluid mr-4">
                            <div class="media-body">
                                <div class="product-review">
                                    @for ($i = 1; $i <= $review['rating']; $i++)
                                        <span><i class="tf-ion-android-star"></i></span>
                                    @endfor
                                </div>
                                <h6>{{$review['name']}} <span class="text-sm text-muted font-weight-normal ml-3">-{{\Carbon\Carbon::parse($review['created_at'])->format("M d, Y")}}</span></h6>
                                <p>{{$review['review']}}</p>
                            </div>
                        </div>
                    @empty
                        <h3 class="text-center">No review is given yet for this product!</h3>
                    @endforelse

                </div>

                @auth
                    <div class="col-lg-5">
                        <div class="review-comment mt-5 mt-lg-0">
                            <h4 class="mb-3">Add a Review</h4>
                            <form action="{{route("user.review")}}" method="POST">
                                @csrf
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" checked/>
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" value="{{auth()->user()?->name ?: ""}}" placeholder="Your Name">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}" placeholder="Your Name">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="rating" value="0" placeholder="Your Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" value="{{auth()->user()?->email ?: ""}}" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <textarea name="review" id="review" class="form-control" cols="30" rows="4" placeholder="Your Review"></textarea>
                                </div>

                                <button type="submit" class="btn btn-main btn-small">Submit Review</button>
                            </form>
                        </div>
                    </div>
                @endauth

            </div>
          </div>
        </div>
    </div>
</div>

<div class="search-wrap">
    <div class="overlay">
      <form action="{{route('search')}}" method="get" class="search-form">
        {{-- @csrf --}}
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-9">
              <input type="text" name="keywords" class="form-control" placeholder="Search..." />
            </div>
            <div class="col-md-2 col-3 text-right">
              <div class="search_toggle toggle-wrap d-inline-block">
                <img class="search-close" src="{{URL::to('/')}}/public/frontend/images/close.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

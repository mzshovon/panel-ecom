@extends('admin.layouts.app')
@section('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="pagetitle">
    <h1>{{$page}}</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.layouts.partials.alerts')
                    @if (!empty($product))
                    <form class="row g-3" method="POST" action="{{route('admin.products.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="inputName5" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="inputName5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" name="sku" class="form-control" id="inputEmail5">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control" id="inputEmail5" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Current Price (BDT) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" id="inputEmail5" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Previous Price (BDT)</label>
                            <input type="number" name="previous_price" class="form-control" id="inputEmail5" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Height</label>
                            <input type="number" name="height" class="form-control" id="inputEmail5" min="0">
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail5" class="form-label">Weight</label>
                            <input type="number" name="weight" class="form-control" id="inputEmail5" min="0">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Tentative Delivery Date</label>
                            <input type="date" name="tentative_delivery_date" class="form-control" id="inputPassword5">
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword5" class="form-label">Discount</label>
                            <input type="number" name="discount" class="form-control" id="inputPassword5" min="0">
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">Discount type</label>
                            <select id="inputState" name="state" class="form-select">
                                <option value="amount">Price</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword5" class="form-label">Price Up To</label>
                            <input type="number" name="discount" class="form-control" id="inputPassword5" min="0">
                        </div>
                        <div class="col-md-6">
                            <label for="inputState" class="form-label">Variants</label>
                            <select id="inputState" name="variants[]" class="form-select variants" multiple="multiple">
                                @forelse ($variants as $variant)
                                    <option value="{{$variant['name']}}">{{ucfirst($variant['name'])}} ({{$variant['type']}})</option>
                                @empty
                                    No data available!
                                @endforelse
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="inputFormFile" class="form-label">Product Images <span class="text-danger">*</span></label>
                            <input class="form-control" name="images[]" type="file" id="formFile" multiple>
                        </div>
                        <div class="col-6">
                            <label for="floatingTextarea" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="tinymce-editor" name="description">
                              </textarea><!-- End TinyMCE Editor -->
                        </div>
                        <div class="col-6">
                            <label for="floatingTextarea" class="form-label">Short Description</label>
                            <textarea class="tinymce-editor" name="short_description">
                              </textarea><!-- End TinyMCE Editor -->
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- End Multi Columns Form -->
                    @else
                        No Data Available!
                    @endif


                </div>
            </div>

        </div>

    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.variants').select2();
    });
</script>

@endsection

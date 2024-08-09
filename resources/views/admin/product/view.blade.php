@extends('admin.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{$page}}</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
            <div class="row">
                <div class="col-md-10">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Filter <i class="bi bi-funnel"></i>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form class="row g-3" method="GET" action="{{route('admin.products.index')}}">
                                        <div class="col-md-3">
                                            <label for="inputName5" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" id="inputName5"
                                                value="{{old('name')}}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputName5" class="form-label">SKU</label>
                                            <input type="text" name="sku" class="form-control" id="inputName5"
                                                value="{{old('sku')}}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputName5" class="form-label">Stock</label>
                                            <input type="number" name="stock" class="form-control" id="inputName5"
                                                value="{{old('stock')}}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputName5" class="form-label">Variants</label>
                                            <input type="text" name="variants" class="form-control" id="inputName5"
                                                value="{{old('variants')}}">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" name="filter" class="form-control btn btn-primary" id="inputName5"
                                                value="Filter">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" name="download" class="form-control btn btn-dark" id="inputName5"
                                                value="Download">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary btn-lg" href="{{route('admin.products.create')}}" style="float: right">Add
                        Product <i class="bi bi-plus"></i>
                    </a>
                </div>
            </div>
            </div>
            <br>
            <!-- Table with stripped rows -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Current Price</th>
                        <th scope="col">Previous Price</th>
                        <th scope="col">Images</th>
                        <th scope="col">Variants</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr data-id={{$product['id']}}>
                        <th scope="row">{{$product['id']}}</th>
                        <td>{{$product['name']}}</td>
                        <td>{{$product['sku']}}</td>
                        <td>{{$product['stock']}}</td>
                        <td>{{$product['price']}}</td>
                        <td>{{$product['previous_price']}}</td>
                        <td>
                            @forelse ($product['images'] as $key => $image)
                            <img class="table-img" src="{{URL::to("/") . "/" .$image['image_path']}}" loading="lazy">
                            @empty
                            N/A
                            @endforelse
                        </td>
                        <td>
                            @forelse (json_decode($product['variants'], true) as $varient)
                            <span class="badge bg-primary">{{ucfirst($varient)}}</span>
                            @empty
                            <span class="badge bg-danger">N/A</span>
                            @endforelse
                        </td>
                        <td>{{ucfirst($product['updated_by']['name'])}}</td>
                        <td>{{$product['created_at']}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route("admin.products.edit", ["product"=>$product["id"]])}}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a class="btn btn-danger btn-sm"
                                onclick="deleteRow('{{route('admin.products.destroy', ['product' => $product['id']])}}', '{{csrf_token()}}', '{{$product['id']}}')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <h3 class="text-center">No Data Available!</h3>
                    @endforelse
                </tbody>
            </table>
            {{$products->links('pagination::bootstrap-5')}}

        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{URL::to('/')}}/public/assets/js/custom.js"></script>
@endsection

@extends('admin.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{$page}}</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a class="btn btn-primary btn-md" href="{{route('admin.products.create')}}" style="float: right">Add
                    Product
                    <i class="bi bi-plus"></i></a>
            </h5>
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
                            <img class="table-img" src="{{URL::to("/") . "/" .$image['image_path']}}">
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
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{URL::to('/')}}/public/assets/js/custom.js"></script>
@endsection

@extends('admin.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{$page}}</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a class="btn btn-primary btn-md" href="{{route('admin.orders.create')}}" style="float: right">Add order
                    <i class="bi bi-plus"></i></a>
            </h5>
            <br>
            @include('admin.layouts.partials.alerts')
            <!-- Table with stripped rows -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Shipping Charge</th>
                        <th scope="col">Address</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Status</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr data-id={{$order['id']}}>
                        <th scope="row">{{$order['id']}}</th>
                        <td>{{$order['name']}}</td>
                        <td>{{$order['total_amount_after_discount']}}</td>
                        <td>{{$order['total_discount']}}</td>
                        <td>{{$order['shipping_charge']}}</td>
                        <td>{{$order['address']}}</td>
                        <td>{{$order['mobile'] ?? "N/A"}}</td>
                        <td>
                            <button class="btn btn-{{config('view.status.'.$order['status'] ?? "warning")}} btn-sm"  onclick="updateStatusModalShow(`{{ $order['id'] }}`, `{{ $order['status'] }}`)">
                                {{$order['status'] ?? "Pending"}}
                            </button>
                        </td>
                        <td>{{$order['created_at']}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route("admin.orders.edit", ["order"=> $order["id"]])}}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a class="btn btn-success btn-sm">
                                <i class="bi bi-box-seam"></i>
                            </a>
                            <a class="btn btn-danger btn-sm"
                                onclick="deleteRow('{{route('admin.orders.destroy', ['order' => $order['id']])}}', '{{csrf_token()}}', '{{$order['id']}}')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <h3 class="text-center">No Data Available!</h3>
                    @endforelse
                </tbody>
            </table>
            {{$orders->links('pagination::bootstrap-5')}}
        </div>
    </div>
    <div class="modal fade" id="update-status-modal" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('admin.orders.status.change') }}"
                    method="POST" class="mx-3">
                    @csrf
                    <input type="hidden" name="order_id" id="id_order_id">
                    <select name="status" id="status_id"
                        class="form-control" required>
                        <option value="">Select a Status</option>
                        @foreach ($orderStatus as $status)
                            <option id="status_option_id{{ $status }}" value="{{ $status }}">
                                {{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm light"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit"
                            class="btn btn-sm btn-primary light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{URL::to('/')}}/public/assets/js/custom.js"></script>
<script>
    function updateStatusModalShow(orderId, status) {
        if(orderId == "" || orderId == null){
            return false
        }
        $("#id_order_id").val(orderId);
        if (status) {
            $("#status_option_id" + status).prop('selected', true);
        } else {
            $('#status_id').find($('option')).prop('selected', false);
        }
        $("#update-status-modal").modal('show')
    }
</script>
@endsection

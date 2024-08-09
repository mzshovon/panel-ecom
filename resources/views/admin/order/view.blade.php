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
                                        <form class="row g-3" method="GET" action="{{route('admin.orders.index')}}">
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" id="inputName5"
                                                    value="{{old('name')}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Invoice No</label>
                                                <input type="text" name="invoice_no" class="form-control" id="inputName5"
                                                    value="{{old('invoice_no')}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control" id="inputName5"
                                                    value="{{old('address')}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Mobile</label>
                                                <input type="text" name="mobile" class="form-control" id="inputName5"
                                                    value="{{old('mobile')}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Date From</label>
                                                <input type="date" name="from_date" class="form-control" id="inputName5"
                                                    value="{{old('name')}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Date To</label>
                                                <input type="date" name="to_date" class="form-control" id="inputName5"
                                                    value="{{old('name')}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Status</label>
                                                <select name="status" class="form-control" required>
                                                    <option selected disabled>Select status</option>
                                                    @foreach ($orderStatus as $status)
                                                    <option value="{{ $status }}">
                                                        {{ ucfirst($status) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputName5" class="form-label">Merchant ID</label>
                                                <input type="text" name="merchant_id" class="form-control" id="inputName5"
                                                    value="{{old('name')}}">
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
                        <a class="btn btn-primary btn-lg" href="{{route('admin.orders.create')}}"
                            style="float: right;">Add order
                            <i class="bi bi-plus"></i></a>
                    </div>
                </div>
            </div>

            <br>
            @include('admin.layouts.partials.alerts')
            <!-- Table with stripped rows -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Invoice No.</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Shipping Charge</th>
                        <th scope="col">Address</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Status</th>
                        <th scope="col">Status History</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr data-id={{$order['id']}}>
                        <th scope="row">{{$order['id']}}</th>
                        <td>{{$order['name']}}</td>
                        <td><b>{{$order['invoice_no'] ?? "N/A"}}</b></td>
                        <td>{{$order['total_amount_after_discount']}}</td>
                        <td>{{$order['quantity']}}</td>
                        <td>{{$order['total_discount']}}</td>
                        <td>{{$order['shipping_charge']}}</td>
                        <td>{{$order['address']}}</td>
                        <td>{{$order['mobile'] ?? "N/A"}}</td>
                        <td>
                            <button class="btn btn-{{config('view.status.'.$order['status']) ?? " warning"}} btn-sm"
                                onclick="updateStatusModalShow(`{{ $order['id'] }}`, `{{ $order['status'] }}`)">
                                {{ucfirst($order['status']) ?? "Pending"}}
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm"
                                onclick="trackStatusHistory(`{{ $order['id'] }}`, `{{ $order['status_update_info'] }}`)">
                                Click <i class="bi bi-geo-alt"></i>
                            </button>
                        </td>
                        <td>{{$order['created_at']}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route("admin.orders.edit", ["order"=> $order["id"]])}}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a class="btn btn-success btn-sm" href="{{route("admin.orders.show", ["order"=> $order["id"]])}}">
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.orders.status.change') }}" method="POST" class="mx-3">
                        @csrf
                        <input type="hidden" name="order_id" id="id_order_id">
                        <input type="hidden" name="prev_status" id="id_prev_status">
                        <select name="status" id="status_id" class="form-control" required>
                            <option value="">Select a Status</option>
                            @foreach ($orderStatus as $status)
                            <option class="{{ $status }}" value="{{ $status }}">
                                {{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary light">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="status-track-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section class="dashboard">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Status History</h5>
                                <div class="activity">
                                </div>
                            </div>
                        </div><!-- End Recent Activity -->
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary light">Submit</button>
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
        $("#id_prev_status").val(status);
        if (status) {
            let statusOptionClassName = status.split(" ").toString().split(',').join('.');
            $(`.${statusOptionClassName}`).prop('selected', true);
        } else {
            $('#status_id').find($('option')).prop('selected', false);
        }
        $("#update-status-modal").modal('show')
    }
    function trackStatusHistory(orderId, statusHistory) {
        let trackDiv = "";
        if(statusHistory){
            JSON.parse(statusHistory).forEach((history) => {
            trackDiv += `<div class="activity-item d-flex">
                            <div class="activite-label">${history.status_changed_at}</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                            <div class="activity-content">${history.status_changed_by.toUpperCase()} changed ${history.new_status} from ${history.prev_status} status</div>
                        </div>`;
        });
        }
        $("#status-track-modal").modal('show')
        $("#status-track-modal .modal-title").text(`Track Status of Order #${orderId}`)
        $("#status-track-modal .activity").html(trackDiv)
    }
</script>
@endsection

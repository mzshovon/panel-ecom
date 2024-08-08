@extends('admin.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{$page}}</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <button class="btn btn-primary btn-md" style="float: right" data-bs-toggle="modal" data-bs-target="#create-role-modal">Add User
                    <i class="bi bi-plus"></i>
                </button>
            </h5>
            <br>
            @include('admin.layouts.partials.alerts')
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Display Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Create Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                    <tr data-id={{$role['id']}}>
                        <th scope="row">{{$role['id']}}</th>
                        <td>{{$role['name']}}</td>
                        <td>{{$role['display_name']}}</td>
                        <td>{{shortenLongText($role['description'] ?? "N/A")}}</td>
                        <td>{{$role['created_at']}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" onclick="updateRoleModalShow(`{{ route('admin.roles.update', ['role' => $role['id']])}}`,`{{ $role['id'] }}`,`{{ $role['name'] }}`,`{{ $role['display_name'] }}`, `{{ $role['description'] }}`)">
                                <i class="bi bi-pencil"></i>
                            </a>
                            {{-- <a class="btn btn-danger btn-sm"
                                onclick="deleteRow('{{route('admin.roles.destroy', ['role' => $role['id']])}}', '{{csrf_token()}}', '{{$role['id']}}')">
                                <i class="bi bi-trash"></i>
                            </a> --}}
                        </td>
                    </tr>
                    @empty
                    <h3 class="text-center">No Data Available!</h3>
                    @endforelse
                </tbody>
            </table>
            {{$roles->links('pagination::bootstrap-5')}}
        </div>
    </div>
    <div class="modal fade" id="create-role-modal" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="roleForm" action="{{route('admin.roles.store')}}" method="POST" class="row g-3">
                        @method('PUT')
                        @csrf
                        <div class="col-md-12">
                            <label for="inputName5" class="form-label">Role Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="role_name" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputName5" class="form-label">Display Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="display_name" id="role_display_name" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputName5" class="form-label">Role Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" cols="30" rows="3" id="role_description" required></textarea>
                        </div>
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
        function updateRoleModalShow(url, id, name, display, description) {
            $("#roleForm").attr('action', url);
            $("#role_name").val(name);
            $("#role_display_name").val(display);
            $("#role_description").val(description);
            $("#create-role-modal").modal('show')
        }
    </script>
@endsection

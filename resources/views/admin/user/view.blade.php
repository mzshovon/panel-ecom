@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>{{$page}}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <a class="btn btn-primary btn-md" href="{{route('admin.users.create')}}" style="float: right">Add User <i class="bi bi-plus"></i></a>
                </h5>
                <br>
                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Status</th>
                            <th scope="col">Join Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <th scope="row">{{$user['id']}}</th>
                                <td>{{$user['name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['mobile'] ?? "N/A"}}</td>
                                <td>{{$user['status'] ? "Active" : "Deactive"}}</td>
                                <td>{{$user['joined_at']}}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{route("admin.users.edit", ["user" => $user["id"]])}}"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger btn-sm"><i class="bi bi-ban"></i></a>
                                    <a class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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

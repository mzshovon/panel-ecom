@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>{{$page}}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Table with stripped rows</h5>

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

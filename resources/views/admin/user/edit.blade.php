@extends('admin.layouts.app')
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
                    @if (!empty($user))
                    <form class="row g-3" method="POST" action="{{route('admin.users.update',['user'=>$user['id']])}}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-6">
                            <label for="inputName5" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" id="inputName5" value="{{$user->name ?? ""}}">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail5" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail5" value="{{$user->email ?? ""}}">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail5" class="form-label">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="inputEmail5" maxlength="11"
                                min="0" value="{{$user->mobile ?? ""}}">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail5" class="form-label">Status</label>
                            <select id="inputState" name="status" class="form-select">
                                <option value="0" {{ !$user->status ? "selected" : ""}}>Deactive</option>
                                <option value="1" {{ $user->status ? "selected" : ""}}>Active</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword5">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="inputPassword5">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Assign Role</label>
                            <input type="hidden" name="role_id" class="form-control" value="{{$user->roles->first()->id}}">
                            <select id="inputState" name="role" class="form-select">
                                @forelse (rolesList() as $role)
                                    <option class="role-{{$role['id']}}" value="{{$role['id']}}">{{ ucfirst($role['name']) }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputCity" class="form-label">City</label>
                            <input type="text" name="city" class="form-control" id="inputCity" value="{{$user->city ?? ""}}">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">State</label>
                            <select id="inputState" name="state" class="form-select">
                                <option selected="">Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputZip" class="form-label">Zip</label>
                            <input type="text" name="zip" class="form-control" id="inputZip" value="{{$user->zip ?? ""}}">
                        </div>
                        <div class="col-12">
                            <label for="floatingTextarea">Address</label>
                            <textarea class="form-control" name="address" placeholder="Address" id="floatingTextarea"
                                style="height: 100px;">{{$user->address ?? ""}}</textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.users.index')}}" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i> Back</a>
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
    <script>
        let roleId = $("input[name='role_id']").val();
        if (roleId) {
            $(`.role-${roleId}`).prop('selected', true);
        } else {
            $(`.role-${roleId}`).prop('selected', false);
        }
    </script>
@endsection

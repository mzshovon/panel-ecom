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
                    <form class="row g-3" method="POST" action="{{route('admin.users.store')}}">
                        @csrf
                        <div class="col-md-6">
                            <label for="inputName5" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" id="inputName5">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail5" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail5">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail5" class="form-label">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="inputEmail5" maxlength="11" min="0">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail5" class="form-label">Status</label>
                            <select id="inputState" name="status" class="form-select">
                                <option value="0" selected>Deactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword5">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="inputPassword5">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">City</label>
                            <input type="text" name="city" class="form-control" id="inputCity">
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
                            <input type="text" name="zip" class="form-control" id="inputZip">
                        </div>
                        <div class="col-12">
                            <label for="floatingTextarea">Address</label>
                            <textarea class="form-control" name="address" placeholder="Address" id="floatingTextarea"
                                style="height: 100px;"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- End Multi Columns Form -->

                </div>
            </div>

        </div>

    </div>
</section>
@endsection

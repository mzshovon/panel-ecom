@php
    $route = Route::current()->getName();
@endphp
<div class="col-12 col-md-5 col-sm-12 col-lg-3">
    <div class="nav flex-column nav-pills">
        <a class="nav-link {{ in_array($route, ['dashboard']) ? 'active' : '' }}" href="{{route('dashboard')}}" >Dashboard</a>
    </div>
    <div class="nav flex-column nav-pills">
        <a class="nav-link {{ in_array($route, ['orders']) ? 'active' : '' }}" href="{{route('orders')}}" >Orders</a>
    </div>
    <div class="nav flex-column nav-pills">
        <a class="nav-link" href="address.html" >Address</a>
    </div>
    <div class="nav flex-column nav-pills">
        <a class="nav-link" href="account.html" >Account</a>
    </div>
    <div class="nav flex-column nav-pills">
        <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Log Out</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

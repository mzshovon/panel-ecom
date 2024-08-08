@php
    $route = Route::current()->getName();
@endphp
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ in_array($route, ['admin.dashboard']) ? 'nav-item-active-a' : 'collapsed' }}" href="{{route('admin.dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ in_array($route, ['admin.users.index']) ? 'nav-item-active-a' : 'collapsed' }}" href="{{route('admin.users.index')}}">
                <i class="bi bi-people"></i>
                <span>Users</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ in_array($route, ['admin.products.index']) ? 'nav-item-active-a' : 'collapsed' }}" href="{{route('admin.products.index')}}">
                <i class="bi bi-grid"></i>
                <span>Products</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ in_array($route, ['admin.orders.index']) ? 'nav-item-active-a' : 'collapsed' }}" href="{{route('admin.orders.index')}}">
                <i class="bi bi-box"></i>
                <span>Orders</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ in_array($route, ['admin.roles.index']) ? 'nav-item-active-a' : 'collapsed' }}" href="{{route('admin.roles.index')}}">
                <i class="bi bi-person-square"></i>
                <span>Roles</span>
            </a>
        </li><!-- End Dashboard Nav -->

    </ul>

</aside><!-- End Sidebar-->

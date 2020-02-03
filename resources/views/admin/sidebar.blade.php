<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Administrator</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-fw fa-baby"></i>
            <span>Manage User</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('categories.index')}}">
            <i class="fas fa-biohazard"></i>
            <span>Manage Kategori</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('products.index')}}">
            <i class="fab fa-product-hunt"></i>
            <span>Manage Produk</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('orders.index')}}">
            <i class="fas fa-shopping-cart"></i>
            <span>Manage Order</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/peramalan')}}">
            <i class="fas fa-shopping-cart"></i>
            <span>Peramalan Penjualan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('banners.index')}}">
            <i class="fas fa-ad"></i>
            <span>Manage Banner</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}">
            <i class="fas fa-home"></i>
            <span>Dashboard Penjualan</span>
        </a>
    </li>

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


    <hr class="sidebar-divider my-0">


</ul>
<!-- End of Sidebar -->

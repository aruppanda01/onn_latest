<div class="dashboard-menubar" id="sidebar">
    <div class="image-wrapper logo-wrapper customer-logo">
        <img src="{{ asset('admin/img/logo-inverse.png') }}" class="img-fluid logo">
    </div>
    <nav class="">
        <ul class=" menu">
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>Dashboard
                </a>
            </li>
            <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                <a href="{{ route('admin.category.index') }}">
                    <i class="fas fa-list-alt"></i>Category
                </a>
            </li>
            <li class="{{ Request::is('admin/sub-category*') ? 'active' : '' }}">
                <a href="{{ route('admin.sub-category.index') }}">
                    <i class="fas fa-list-alt"></i>Sub Category
                </a>
            </li>
            <li class="{{ Request::is('admin/product*') ? 'active' : '' }}">
                <a href="{{ route('admin.product.index') }}">
                    <i class="fab fa-product-hunt"></i>Products
                </a>
            </li>
            <li class="{{ Request::is('admin/available-product-size*') ? 'active' : '' }}">
                <a href="{{ route('admin.available-product-size.index') }}">
                    <i class="fab fa-product-hunt"></i>Product Sizes
                </a>
            </li>
            <li class="{{ Request::is('admin/image*') ? 'active' : '' }}">
                <a href="{{ route('admin.image.index') }}">
                    <i class="fas fa-image"></i>Image
                </a>
            </li>
            <li class="{{ Request::is('admin/invoice*') ? 'active' : '' }}">
                <a href="{{ route('admin.invoice.index') }}">
                    <i class="fas fa-file-invoice"></i>Invoice
                </a>
            </li>
            <li class="{{ Request::is('admin/change-password') ? 'active' : '' }}">
                <a href="{{ route('admin.changePassword') }}">
                    <i class="fas fa-user-circle"></i>Profile
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt" aria-hidden="true"></i>{{ __('Logout') }}
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
        </ul>
    </nav>
</div>

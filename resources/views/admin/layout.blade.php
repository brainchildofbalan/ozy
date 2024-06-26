<!DOCTYPE html>
<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="http://localhost:8001/assets/"
    data-base-url="http://localhost:8001" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Your Default Title')</title>
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/main-style.css') }}">
    <script src="{{ asset('/assets/admin/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/config.js') }}"></script>
    <!-- Google tag (gtag.js) -->


</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">



                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">

                    <li class="menu-item @if (Str::contains(url()->full(), '/sub-categories') ||
                            Str::contains(url()->full(), '/categories') ||
                            Str::contains(url()->full(), '/products')) {{ 'active open' }} @endif">
                        <a href="http://localhost:8001" class="menu-link menu-toggle">
                            {{-- <i class="menu-icon tf-icons bx bx-home-circle"></i> --}}
                            <div>Product Manager</div>
                            {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
                        </a>


                        <ul class="menu-sub">



                            <li class="menu-item ">
                                <a href="{{ route('products.index') }}" class="menu-link">
                                    <div>Products</div>
                                </a>
                            </li>

                            <li class="menu-item ">
                                <a href="{{ route('categories.index') }}" class="menu-link">
                                    <div>Categories</div>
                                </a>
                            </li>


                            <li class="menu-item ">
                                <a href="{{ route('sub-categories.index') }}" class="menu-link">
                                    <div>Sub Category</div>
                                </a>
                            </li>




                        </ul>
                    </li>
                    <li class="menu-item @if (Str::contains(url()->full(), '/service-categorie') || Str::contains(url()->full(), '/services')) {{ 'active open' }} @endif">
                        <a href="http://localhost:8001" class="menu-link menu-toggle">
                            {{-- <i class="menu-icon tf-icons bx bx-home-circle"></i> --}}
                            <div>Service Manager</div>
                            {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
                        </a>


                        <ul class="menu-sub">



                            <li class="menu-item ">
                                <a href="{{ route('services.index') }}" class="menu-link">
                                    <div>Services</div>
                                </a>
                            </li>

                            <li class="menu-item ">
                                <a href="{{ route('service-categories.index') }}" class="menu-link">
                                    <div>Categories</div>
                                </a>
                            </li>

                            <li class="menu-item ">
                                <a href="{{ route('services-enq.index') }}" class="menu-link">
                                    <div>Service enquiries</div>
                                </a>
                            </li>



                        </ul>
                    </li>
                    <li class="menu-item @if (Str::contains(url()->full(), '/menu') || Str::contains(url()->full(), '/order-menu')) {{ 'active open' }} @endif">
                        <a href="http://localhost:8001" class="menu-link menu-toggle">
                            {{-- <i class="menu-icon tf-icons bx bx-home-circle"></i> --}}
                            <div>Menu Manager</div>
                            {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
                        </a>


                        <ul class="menu-sub">



                            <li class="menu-item ">
                                <a href="{{ route('menus.index') }}" class="menu-link">
                                    <div>Menu</div>
                                </a>
                            </li>

                            <li class="menu-item ">
                                <a href="{{ route('menus.updateOrderGet') }}" class="menu-link">
                                    <div>Order menus</div>
                                </a>
                            </li>



                        </ul>
                    </li>
                    <li class="menu-item @if (Str::contains(url()->full(), '/order') || Str::contains(url()->full(), '/order')) {{ 'active open' }} @endif">
                        <a href="http://localhost:8001" class="menu-link menu-toggle">
                            {{-- <i class="menu-icon tf-icons bx bx-home-circle"></i> --}}
                            <div>Order Manager</div>
                            {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
                        </a>


                        <ul class="menu-sub">



                            <li class="menu-item ">
                                <a href="{{ route('orders.index') }}" class="menu-link">
                                    <div>Orders</div>
                                </a>
                            </li>





                        </ul>
                    </li>

                    <li class="menu-item @if (Str::contains(url()->full(), '/testimonials')) {{ 'active open' }} @endif">
                        <a href="http://localhost:8001" class="menu-link menu-toggle">
                            {{-- <i class="menu-icon tf-icons bx bx-home-circle"></i> --}}
                            <div>Testimonials Manager</div>
                            {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
                        </a>


                        <ul class="menu-sub">



                            <li class="menu-item ">
                                <a href="{{ route('testimonials.index') }}" class="menu-link">
                                    <div>Testimonials</div>
                                </a>
                            </li>





                        </ul>
                    </li>


                    <li class="menu-item @if (Str::contains(url()->full(), '/seo')) {{ 'active open' }} @endif">
                        <a href="http://localhost:8001" class="menu-link menu-toggle">
                            {{-- <i class="menu-icon tf-icons bx bx-home-circle"></i> --}}
                            <div>Seo Manager</div>
                            {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
                        </a>


                        <ul class="menu-sub">



                            <li class="menu-item ">
                                <a href="{{ route('seo.index') }}" class="menu-link">
                                    <div>Seo</div>
                                </a>
                            </li>





                        </ul>
                    </li>

                </ul>


            </aside>
            <div class="layout-page">
                <nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">

                    <!--  Brand demo (display only for navbar-full and hide on below xl) -->

                    <!-- ! Not required for layout-without-menu -->
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <!-- Place this tag where you want the button to render. -->
                            <li class="nav-item lh-1 me-3">
                                <span></span>
                            </li>

                            <!-- User -->
                            @if (Auth::check())
                                {{-- <p>Hello, {{ Auth::user()->name }}</p> --}}

                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                        data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            <span
                                                class="w-px-40 h-auto rounded-circle position-absolute left-0 top-0 w-100 h-100 d-flex justify-content-center align-items-center fw-bold bg-dark text-white">
                                                {{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3 d-flex align-items-center">
                                                        <div class="avatar avatar-online">
                                                            <span
                                                                class="w-px-40 h-auto rounded-circle position-absolute left-0 top-0 w-100 h-100 d-flex justify-content-center align-items-center fw-bold bg-dark text-white">
                                                                {{ substr(Auth::user()->name, 0, 1) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span
                                                            class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="bx bx-user me-2"></i>
                                                <span class="align-middle">My Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="bx bx-cog me-2"></i>
                                                <span class="align-middle">Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <span class="d-flex align-items-center align-middle">
                                                    <i class="flex-shrink-0 bx bx-credit-card me-2 pe-1"></i>
                                                    <span class="flex-grow-1 align-middle">Billing</span>
                                                    <span
                                                        class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        <li>

                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button type="submit" class="dropdown-item"
                                                    href="javascript:void(0);">
                                                    <i class="bx bx-power-off me-2"></i>
                                                    <span class="align-middle">Log Out</span>
                                                </button>
                                            </form>

                                        </li>
                                    </ul>
                                </li>
                            @endif
                            <!--/ User -->
                        </ul>
                    </div>

                </nav>
                @yield('content')
            </div>
        </div>
    </div>

</body>


<script src="{{ asset('/assets/admin/js/jquery.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('/assets/admin/js/popper.js') }}"></script>
<script src="{{ asset('/assets/admin/js/bootstrap.js') }}"></script>
<script src="{{ asset('/assets/admin/js/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('/assets/admin/js/menu.js') }}"></script>
<script src="{{ asset('/assets/admin/js/suneditor.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/main.js') }}"></script>
{{-- <script src="{{ asset('/assets/admin/js/ui-modals.js') }}"></script> --}}

</html>

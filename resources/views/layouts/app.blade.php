<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Saral Billing', 'Saral Billing') }}</title>
    {{--
    <link rel="icon" href="../" type="image/icon type"> --}}
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Yajra Datatable --}}
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">



    {{-- Select 2 --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/saral.css') }}" rel="stylesheet">
    {{-- toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

    <!--here-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    {{-- font awesome --}}
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.1/js/v4-shims.js"></script>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>




</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">SARAL BILLING</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><svg
                class="svg-inline--fa fa-bars fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas"
                data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                <path fill="currentColor"
                    d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
                </path>
            </svg><!-- <i class="fas fa-bars"></i> Font Awesome fontawesome.com --></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch">
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><svg
                        class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas"
                        data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                        </path>
                    </svg><!-- <i class="fas fa-search"></i> Font Awesome fontawesome.com --></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><svg class="svg-inline--fa fa-user fa-w-14 fa-fw" aria-hidden="true"
                        focusable="false" data-prefix="fas" data-icon="user" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z">
                        </path>
                    </svg><!-- <i class="fas fa-user fa-fw"></i> Font Awesome fontawesome.com --></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="/home">
                            {{-- Dashboard --}}
                            <div class="sb-nav-link-icon"><svg class="svg-inline--fa fa-tachometer-alt fa-w-18"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tachometer-alt"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M288 32C128.94 32 0 160.94 0 320c0 52.8 14.25 102.26 39.06 144.8 5.61 9.62 16.3 15.2 27.44 15.2h443c11.14 0 21.83-5.58 27.44-15.2C561.75 422.26 576 372.8 576 320c0-159.06-128.94-288-288-288zm0 64c14.71 0 26.58 10.13 30.32 23.65-1.11 2.26-2.64 4.23-3.45 6.67l-9.22 27.67c-5.13 3.49-10.97 6.01-17.64 6.01-17.67 0-32-14.33-32-32S270.33 96 288 96zM96 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm48-160c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm246.77-72.41l-61.33 184C343.13 347.33 352 364.54 352 384c0 11.72-3.38 22.55-8.88 32H232.88c-5.5-9.45-8.88-20.28-8.88-32 0-33.94 26.5-61.43 59.9-63.59l61.34-184.01c4.17-12.56 17.73-19.45 30.36-15.17 12.57 4.19 19.35 17.79 15.17 30.36zm14.66 57.2l15.52-46.55c3.47-1.29 7.13-2.23 11.05-2.23 17.67 0 32 14.33 32 32s-14.33 32-32 32c-11.38-.01-20.89-6.28-26.57-15.22zM480 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z">
                                    </path>
                                </svg><!-- <i class="fas fa-tachometer-alt"></i> Font Awesome fontawesome.com -->
                            </div>
                            Dashboard
                        </a>


                        <div class="sb-sidenav-menu-heading">Interface</div>
                        {{-- Account --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fad fa-users"></i>
                                <!-- <i class="fas fa-columns"></i> Font Awesome fontawesome.com -->
                            </div>
                            Account
                            <div class="sb-sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                    </path>
                                </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                            </div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('Account.index')}}"><i class="fal fa-file-user"></i>
                                    &#160 Account Dashboard</a>
                                <a class="nav-link" href="{{route('account.create')}}"><i class="fas fa-user-plus"></i>
                                    &#160 Create Account </a>
                                <a class="nav-link" href="{{route('account.trash')}}"><i class="fas fa-user-slash"></i>
                                    &#160 Trash Account</a>
                                <a class="nav-link" href="{{route('account.paymentView')}}"><i
                                        class="fa-solid fa-money-check"></i>
                                    &#160 Payment</a>
                            </nav>
                        </div>
                        @if (Auth::user()->isadmin == 1)


                        {{-- Supplier --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#suppliers"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i id="userIcon" class="fa fa-industry"></i>
                                <!-- <i class="fas fa-columns"></i> Font Awesome fontawesome.com -->
                            </div>
                            Suppliers
                            <div class="sb-sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                    </path>
                                </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                            </div>
                        </a>
                        <div class="collapse" id="suppliers" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('supplier.index')}}"><i
                                        class="far fa-file-alt"></i>&#160 Supplier Dashboard</a>
                                <a class="nav-link" href="{{route('supplier.create')}}"><i class="fas fa-user-plus"></i>
                                    &#160 Add Suppliers </a>
                                <a class="nav-link" href="{{route('supplier.trash')}}"><i class="fas fa-user-slash"></i>
                                    &#160 Trash Account</a>
                                <a class="nav-link" href="{{route('supplier.paymentView')}}"><i
                                        class="fa-solid fa-money-check"></i>
                                    &#160 Payment</a>
                            </nav>
                        </div>

                        {{-- Tranport --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#transport"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fad fa-truck"></i>
                                <!-- <i class="fas fa-columns"></i> Font Awesome fontawesome.com -->
                            </div>
                            Transport
                            <div class="sb-sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                    </path>
                                </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                            </div>
                        </a>
                        <div class="collapse" id="transport" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('transport.index')}}"><i
                                        class="far fa-file-alt"></i>&#160 Transport
                                    Dashboard</a>
                                <a class="nav-link" href="{{route('transport.create')}}"><i
                                        class="fas fa-user-plus"></i>
                                    &#160 Add Transport </a>
                                <a class="nav-link" href="{{route('transport.trash')}}"><i
                                        class="fas fa-user-slash"></i>
                                    &#160 Trash Account</a>
                            </nav>
                        </div>

                        {{-- Product --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#product"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i>
                                <!-- <i class="fas fa-columns"></i> Font Awesome fontawesome.com -->
                            </div>
                            Product
                            <div class="sb-sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                    </path>
                                </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                            </div>
                        </a>
                        <div class="collapse" id="product" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('product.index')}}"><i
                                        class="far fa-file-alt"></i>&#160 Product
                                    Dashboard</a>
                                <a class="nav-link" href="{{route('product.create')}}"><i
                                        class="fas fa-plus-circle"></i>
                                    &#160 Add Product </a>
                                <a class="nav-link" href="{{route('product.productTrash')}}"><i
                                        class="fas fa-user-slash"></i>
                                    &#160 Trash Product</a>
                            </nav>
                        </div>
                        {{-- Purchase --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#purchase"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i>
                                <!-- <i class="fas fa-columns"></i> Font Awesome fontawesome.com -->
                            </div>
                            Purchase
                            <div class="sb-sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                    </path>
                                </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                            </div>
                        </a>
                        <div class="collapse" id="purchase" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('purchase.index')}}"><i
                                        class="far fa-file-alt"></i>&#160 Purchase
                                    Dashboard</a>
                                <a class="nav-link" href="{{route('purchase.create')}}"><i
                                        class="fas fa-plus-circle"></i>
                                    &#160 Create Purchase </a>
                                <a class="nav-link" href="{{route('product.productTrash')}}"><i
                                        class="fas fa-user-slash"></i>
                                    &#160 Trash Product</a>
                            </nav>
                        </div>
                        {{-- Stock --}}
                        <a class="nav-link" href="{{route('stock.index')}}">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            Stock
                        </a>

                        {{-- Supplier Ledger --}}
                        <a class="nav-link" href="{{route('supplierLedger.index')}}">
                            <div class="sb-nav-link-icon">
                                <i class="fad fa-shapes"></i>
                            </div>
                            Supplier Ledger
                        </a>

                        {{-- Sales Reoprt --}}
                        <a class="nav-link" href="{{route('salesReport.index')}}">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-chart-user"></i>
                            </div>
                            Sales Report
                        </a>
                        {{-- Category --}}
                        <a class="nav-link" href="{{route('category.index')}}">
                            <div class="sb-nav-link-icon">
                                <i class="fad fa-shapes"></i>
                            </div>
                            Category
                        </a>

                        {{-- Activity Log --}}
                        <a class="nav-link" href="{{route('activityLog.index')}}">
                            <div class="sb-nav-link-icon">
                                <i class="fad fa-shapes"></i>
                            </div>
                            Activity Log
                        </a>

                        {{-- users --}}
                        <a class="nav-link" href="{{route('user')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i>
                                <!-- <i class="fas fa-tachometer-alt"></i> Font Awesome fontawesome.com -->
                            </div>
                            Users
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="{{route('sales.salesChart')}}">
                            <div class="sb-nav-link-icon"><svg class="svg-inline--fa fa-chart-area fa-w-16"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-area"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M500 384c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H12c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v308h436zM372.7 159.5L288 216l-85.3-113.7c-5.1-6.8-15.5-6.3-19.9 1L96 248v104h384l-89.9-187.8c-3.2-6.5-11.4-8.7-17.4-4.7z">
                                    </path>
                                </svg><!-- <i class="fas fa-chart-area"></i> Font Awesome fontawesome.com -->
                            </div>
                            Charts
                        </a>
                        {{-- Category --}}
                        <a class="nav-link" href="{{route('configuration.index')}}">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-gears"></i>
                            </div>
                            Configuration
                        </a>
                        @endif

                        {{-- Sales --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#sales"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-tags"></i>
                                <!-- <i class="fas fa-columns"></i> Font Awesome fontawesome.com -->
                            </div>
                            Sales
                            <div class="sb-sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                    </path>
                                </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                            </div>
                        </a>
                        <div class="collapse" id="sales" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('sale.index')}}"><i class="fa-solid fa-tags"></i>&#160
                                    Sales
                                    Dashboard</a>
                                <a class="nav-link" href="{{route('sale.create')}}"><i class="fas fa-plus-circle"></i>
                                    &#160 Create Sales </a>
                                <a class="nav-link" href="{{route('product.productTrash')}}"><i
                                        class="fas fa-user-slash"></i>
                                    &#160 Trash Sales</a>
                            </nav>
                        </div>

                        {{-- Sales --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#salesReturn"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-tags"></i>
                                <!-- <i class="fas fa-columns"></i> Font Awesome fontawesome.com -->
                            </div>
                            Sales Return
                            <div class="sb-sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                    </path>
                                </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                            </div>
                        </a>
                        <div class="collapse" id="salesReturn" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('salesReturn.index')}}"><i
                                        class="fa-solid fa-tags"></i>&#160
                                    Sales Return
                                    Dashboard</a>
                                <a class="nav-link" href="{{route('salesReturn.create')}}"><i
                                        class="fas fa-plus-circle"></i>
                                    &#160 Create Sales Return </a>
                                <a class="nav-link" href="{{route('product.productTrash')}}"><i
                                        class="fas fa-user-slash"></i>
                                    &#160 Trash Sales Return</a>
                            </nav>
                        </div>



                        {{-- Accounnt Ledger --}}
                        <a class="nav-link" href="{{route('accountLedger.index')}}">
                            <div class="sb-nav-link-icon">
                                <i class="fad fa-shapes"></i>
                            </div>
                            Account Ledger
                        </a>

                        {{-- Pages --}}
                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><svg class="svg-inline--fa fa-book-open fa-w-18"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="book-open"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M542.22 32.05c-54.8 3.11-163.72 14.43-230.96 55.59-4.64 2.84-7.27 7.89-7.27 13.17v363.87c0 11.55 12.63 18.85 23.28 13.49 69.18-34.82 169.23-44.32 218.7-46.92 16.89-.89 30.02-14.43 30.02-30.66V62.75c.01-17.71-15.35-31.74-33.77-30.7zM264.73 87.64C197.5 46.48 88.58 35.17 33.78 32.05 15.36 31.01 0 45.04 0 62.75V400.6c0 16.24 13.13 29.78 30.02 30.66 49.49 2.6 149.59 12.11 218.77 46.95 10.62 5.35 23.21-1.94 23.21-13.46V100.63c0-5.29-2.62-10.14-7.27-12.99z">
                                    </path>
                                </svg><!-- <i class="fas fa-book-open"></i> Font Awesome fontawesome.com -->
                            </div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                    </path>
                                </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                            </div>
                        </a> --}}
                        {{-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><svg
                                            class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true"
                                            focusable="false" data-prefix="fas" data-icon="angle-down" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                            </path>
                                        </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                                    </div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><svg
                                            class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true"
                                            focusable="false" data-prefix="fas" data-icon="angle-down" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                            </path>
                                        </svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com -->
                                    </div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div> --}}

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: {{Auth::user()->name}}</div>


                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright © Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>

                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    {{-- toaster --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>


    {{-- Charts
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script> --}}

    {{-- Yajra Datatable --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Datatable Buttons --}}
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    @yield('userDetails')
    @yield('account.create')
    @yield('account.update')
    @yield('account.index')
    @yield('account.trash')
    @yield('supplier.create')
    @yield('supplier.index')
    @yield('supplier.edit')
    @yield('supplier.trash')
    @yield('transport.create')
    @yield('transport.index')
    @yield('category.index')
    @yield('category.trash')
    @yield('product.index')
    @yield('purchase.create')
    @yield('purchase.purchaseOrder')
    @yield('purchase.invoice')
    @yield('stock.index')
    @yield('invoice1')
    @yield('invoice2')
    @yield('purchase.trashAjax')
    @yield('sales.salesItem')
    @yield('sales.index')
    @yield('salesReturn.index')
    @yield('supplierLedger.index')
    @yield('supplierLedger.create')
    @yield('accountLedger.create')
    @yield('salesReport')
    @yield('salesChart')
    @yield('config')
    @yield('dashboard')



</body>

</html>
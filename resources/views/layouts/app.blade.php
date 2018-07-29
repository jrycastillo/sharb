<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {!! Html::script('js/app.js') !!}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <!-- Styles -->
    {!! Html::style('css/app.css') !!}

    @yield('style')

</head>
<body class="fixed-nav sidenav-toggled">

<div id="app">
    @guest
        @yield('auth')
    @else
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
            <a class="navbar-brand" href="#">MASCo Davao</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="fa fa-fw fa-dashboard"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Booking">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                           href="#collapseATW"
                           data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-wrench"></i>
                            <span class="nav-link-text">Booking</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseATW">
                            <li>
                                <a href="{{route('booking.create')}}">Create Booking</a>
                            </li>
                            <li>
                                <a href="{{route('booking.index')}}">Booking</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                           href="#collapseComponents"
                           data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-wrench"></i>
                            <span class="nav-link-text">Loading</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseComponents">
                            <li>
                                <a href="{{route('loadings.create')}}">Create Loading</a>
                            </li>
                            <li>
                                <a href="{{route('addproduct.index')}}">Add Product</a>
                            </li>
                            {{--<li>--}}
                                {{--<a href="{{route('uncheckloading.index')}}">Uncheck Loading</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="{{route('loadings.index')}}">Disapproved Loading</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="{{route('loadings.index')}}">Approved Loading</a>--}}
                            {{--</li>--}}
                        </ul>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                           href="#collapseSupplier"
                           data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-wrench"></i>
                            <span class="nav-link-text">Views</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseSupplier">

                            <li>
                                <a href="{{route('carrier.index')}}">View Carriers</a>
                            </li>
                            <li>
                                <a href="{{route('exporter.index')}}">View Exporters</a>
                            </li>
                            <li>
                                <a href="{{route('supplier.index')}}">View Suppliers</a>
                            </li>
                            <li>
                                <a href="{{route('consignee.index')}}">View Consignees</a>
                            </li>
                            <li>
                                <a href="{{route('portofloading.index')}}">View Origins</a>
                            </li>
                            <li>
                                <a href="{{route('portofdischarge.index')}}">View Destinations</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse"
                           href="#collapseExamplePages"
                           data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-file"></i>
                            <span class="nav-link-text">Example Pages</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                            <li>
                                <a href="login.html">Login Page</a>
                            </li>
                            <li>
                                <a href="register.html">Registration Page</a>
                            </li>
                            <li>
                                <a href="forgot-password.html">Forgot Password Page</a>
                            </li>
                            <li>
                                <a href="blank.html">Blank Page</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti"
                           data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-sitemap"></i>
                            <span class="nav-link-text">Menu Levels</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseMulti">
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third
                                    Level</a>
                                <ul class="sidenav-third-level collapse" id="collapseMulti2">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
                        <a class="nav-link" href="#">
                            <i class="fa fa-fw fa-link"></i>
                            <span class="nav-link-text">Link</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav sidenav-toggler">
                    <li class="nav-item">
                        <a class="nav-link text-center" id="sidenavToggler">
                            <i class="fa fa-fw fa-angle-left"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-fw fa-sign-out"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="fixed-nav sticky-footer bg-light">
            <div class="content-wrapper">

                @yield('content')

            </div>
        </div>
    @endguest
</div>

{!! Html::script('js/sb-admin.js') !!}
{!! Html::script('js/vue.js') !!}
{{--<script src="{{ asset('js/sb-admin.js') }}"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>--}}
@yield('scripts')
</body>
</html>

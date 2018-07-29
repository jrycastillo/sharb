<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
        {!! Html::style('css/app.css') !!}
        {!! Html::script('js/app.js') !!}
    </head>
    <body>
        {{--<div class="flex-center position-ref full-height">--}}
            {{--@if (Route::has('login'))--}}
                {{--<div class="top-right links">--}}
                    {{--@auth--}}
                        {{--<a href="{{ url('/home') }}">Home</a>--}}
                    {{--@else--}}
                        {{--<a href="{{ route('login') }}">Login</a>--}}
                        {{--<a href="{{ route('register') }}">Register</a>--}}
                    {{--@endauth--}}
                {{--</div>--}}
            {{--@endif--}}

            {{--<div class="content">--}}
                {{--<div class="title m-b-md">--}}
                    {{--Laravel--}}
                {{--</div>--}}

                {{--<div class="links">--}}
                    {{--<a href="https://laravel.com/docs">Documentation</a>--}}
                    {{--<a href="https://laracasts.com">Laracasts</a>--}}
                    {{--<a href="https://laravel-news.com">News</a>--}}
                    {{--<a href="https://forge.laravel.com">Forge</a>--}}
                    {{--<a href="https://github.com/laravel/laravel">GitHub</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="navbar navbar-light static-top" style="background-color: #e0e0eb">
                    <div class="container">
                        @auth
                            <a class="btn btn-primary" href="{{ url('/home') }}">Login</a>
                        @else
                            <a class="navbar-brand" href="#">Sharbatly</a>
                            <a class="btn btn-primary" href="{{ route('login') }}">Login</a>

                        @endauth
                    </div>
                </div>
            @endif
            <header class="masthead text-white text-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-9 mx-auto">
                            <h1 class="mb-5">&emsp;</h1>
                            <h1 class="mb-5">&emsp;</h1>
                        </div>
                    </div>
                </div>
            </header>

            <section class="testimonials text-center bg-light">
                <div class="container">
                    <h2 class="mb-5">MOHAMMED ABDALLAH SHARBATLY CO. LTD.</h2>
                    <div class="row">
                    </div>
                </div>
            </section>

            <section class="showcase">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">

                        <div class="col-lg-6 order-lg-2 text-white showcase-img"
                             style="background-image: url({{url('img/bg-showcase-1.jpg')}});"></div>
                        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                            <h2>Vision</h2>
                            <p class="lead mb-0">To become the leading fruit and vegetable trader in the Middle East, known for
                                its superior quality standards and centered in customer satisfaction.</p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-lg-6 text-white showcase-img"
                             style="background-image: url({{url('img/bg-showcase-2.jpg')}});"></div>
                        <div class="col-lg-6 my-auto showcase-text">
                            <h2>Mission</h2>
                            <p class="lead mb-0">To achieve consumer satisfaction by providing quality products through
                                innovations, integrity and teamwork.</p>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-lg-6 order-lg-2 text-white showcase-img"
                             style="background-image: url({{url('img/bg-showcase-3.jpg')}});"></div>
                        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                            <h2>Historical Background</h2>
                            <p class="lead mb-0">Mohammed Abdallah Sharbatly Co. Ltd. Originates from an activity established by
                                Sayed Abdallah Abbas Sharbatly in Jeddah during the early 30’s. The management passed, in the
                                70’s, to his eldest son, Sayed Mohammed, who is now assisted by his own sons.</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="testimonials text-center bg-light">
                <div class="container">
                    <div class="row">
                        <table style="margin: 0 auto;">
                            <tr>
                                <td style="vertical-align: baseline; width: 200px">
                                    <h5>Davao Branch:</h5>
                                    <p class="font-weight-light mb-0">3F Unit B Alpha Building<br>Lanang Business Park<br>Km. 7
                                        J.P. Laurel Avenue<br>Lanang, Davao City</p>
                                </td>
                                <td style="vertical-align: baseline; width: 200px">
                                    <h5>Head Office:</h5>
                                    <p class="font-weight-light mb-0">P.O. Box 4150<br>Jeddah 21491<br>Kingdom of Saudi Arabia
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>

            <footer class="footer bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                            <ul class="list-inline mb-2">
                                <li class="list-inline-item">
                                    <a href="#">About</a>
                                </li>
                                <li class="list-inline-item">&sdot;</li>
                                <li class="list-inline-item">
                                    <a href="#">Contact</a>
                                </li>
                                <li class="list-inline-item">&sdot;</li>
                                <li class="list-inline-item">
                                    <a href="#">Terms of Use</a>
                                </li>
                                <li class="list-inline-item">&sdot;</li>
                                <li class="list-inline-item">
                                    <a href="#">Privacy Policy</a>
                                </li>
                            </ul>
                            <p class="text-muted small mb-4 mb-lg-0">&copy; MASCo Ltd. 2018. All Rights Reserved.</p>
                        </div>
                        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item mr-3">
                                    <a href="#">
                                        <i class="fa fa-facebook fa-2x fa-fw"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-3">
                                    <a href="#">
                                        <i class="fa fa-twitter fa-2x fa-fw"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <i class="fa fa-instagram fa-2x fa-fw"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        {{--<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>--}}
        {!! Html::script('js/sb-admin.js') !!}

    </body>
</html>

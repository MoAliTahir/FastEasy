<html>
<head>
    <title>@yield('titre')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'FastEasy') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ asset('storage/images/logo2.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{asset('storage/images/logoFastEasy.png')}}" rel="icon">

    <!-- Styles -->
    <style>
        html, body {
            color: #636b6f;
            background-color: #E2E1EB;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            bottom: 0;
        }


        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }
        .bttn:hover{
            color: #ffc107;
            text-decoration: none;

        }
        .liens > a{
            color: #ffffff;
            padding: 15px 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        #menu {
            position: fixed;
            left: 0;
            top: 60%;
            width: 8em;
            margin-top: -2.5em;
            z-index: 2;
            /*margin-left: 70px;*/
        }

    </style>
    @yield('style')
</head>
<body onload="notify()">
<main id="menu">


</main>


<div id="app" style="background-color:#E2E1EB;">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel " style="background-color: #2a3342; position: fixed;
  top: 0;
  height: 85px;
  width: 100%;
  z-index: 10;">
        {{--logo--}}
        <a href="<?php if (Auth::check()) echo "/home"; else echo "/"; ?>"><img src="{{asset('storage/images/whiteLogoFastEasy.png')}}" style="width: 200px; height: 150px; margin-top: -10px;" ></a>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('registerPartenaire') }}" style="color: white;margin-top: 10px;font-size: 15px;">{{ __("Devenir partenaire") }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" style="color: white;margin-top: 10px;font-size: 15px;">{{ __("S'inscrire") }}</a>
                    </li>

                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}" style="color: white; margin-top: 10px;font-size: 15px;">{{ __('Se connecter') }}</a>
                </li>

            @else
                <li class="nav-item dropdown">
                    <a style="color: white;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="position: absolute; z-index: 20">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Se deconnecter') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                
                 @if(Auth::user()->statut == "partenaire")
                        <li class="nav-item dropdown" id="partenaireNotif">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="glyphicon glyphicon-globe" style="margin-left:150px"></span><span style="color:white">Notifiations</span> <span class="badge text-white">{{count(auth()->user()->unreadNotifications)}}</span>
                            </a>

                            <ul class="dropdown-menu" role="menu" style="position: absolute; z-index: 0;" >
                                <li>
                                    @forelse(auth()->user()->unreadNotifications as $notification)
                                        @include('layouts.notification.'.snake_case(class_basename($notification->type)))
                                    @empty
                                        <p>Vous n'avez aucune notification</p>

                                    @endforelse
                                </li>

                            </ul>
</div>
                        </li>
                 @endif
                 @if(Auth::user()->statut == "client")
                        <li class="nav-item dropdown" id="clientNotif">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="glyphicon glyphicon-globe" style="margin-left:150px"></span><span style="color:white">Notifiations</span> <span class="badge text-white">{{count(auth()->user()->unreadNotifications)}}</span>
                            </a>

                            <ul class="dropdown-menu" role="menu" style="position: absolute; z-index: 0;" >
                                <li>
                                    @forelse(auth()->user()->unreadNotifications as $notification)
                                        @include('layouts.notification.'.snake_case(class_basename($notification->type)))
                                    @empty
                                        <p>Vous n'avez aucune notification</p>

                                    @endforelse
                                </li>

                            </ul>
                            </div>
                        </li>
                 @endif
                @if(Auth::user()->statut == "admin")
                    <li class="nav-item dropdown" id="adminNotif">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="glyphicon glyphicon-globe" style="margin-left:150px"></span><span style="color:white">Notifiations</span> <span class="badge text-white">{{count(auth()->user()->unreadNotifications)}}</span>
                        </a>

                        <ul class="dropdown-menu" role="menu" style="position: absolute; z-index: 0;" >
                            <li>
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    @include('layouts.notification.'.snake_case(class_basename($notification->type)))
                                @empty
                                    <p>Vous n'avez aucune notification</p>

                                @endforelse
                            </li>

                        </ul>
                        </div>
                    </li>
                @endif

               
            @endguest
        </ul>
    </nav>

    @yield('menu')

    @yield('content')

</div>
{{--FOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOTER--}}


</body>

@if(Auth::check())

        @if(Auth::user()->statut == "client")

            <script>
                loadDoc();
                function loadDoc() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("clientNotif").innerHTML =
                                this.responseText;
                        }
                    };
                    xhttp.open("GET", "notif.blade.php", false);
                    xhttp.send();
                    setTimeout(loadDoc, 1000);
                }
            </script>

        @elseif(Auth::user()->statut == "partenaire")

            <script>
                loadDoc();
                function loadDoc() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("partenaireNotif").innerHTML =
                                this.responseText;
                        }
                    };
                    xhttp.open("GET", "notif.blade.php", false);
                    xhttp.send();
                    setTimeout(loadDoc, 1000);
                }
            </script>

        @else


            <script>
                loadDoc();
                function loadDoc() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("adminNotif").innerHTML =
                                this.responseText;
                        }
                    };
                    xhttp.open("GET", "notif.blade.php", false);
                    xhttp.send();
                    setTimeout(loadDoc, 1000);
                }
            </script>

        @endif

@endif

<script>



    function markAsRead (notif_id) {

        $.get('/read/'+ notif_id);

    }

    function notify() {

        $.get('/notifyForm');
    }

</script>
@include('layouts.footer2')
</html>

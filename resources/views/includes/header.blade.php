<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/heroicons@0.4.2/index.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous" />
@yield('styles')
</head>


<!-- <body> -->

<!-- Header -->
<!-- <div class="col-12" id="header">
        <button class="register-btn btn">
            <a href="register.html"><h6>Regjistrohu</h6></a>
        </button>

        <button class="login-btn btn">
            <a href="login.html"><h6>Kyçu</h6></a>
        </button>
    </div> -->



<body>

<!-- Navbar -->
<div class="navigation-wrap bg-light start-header start-style">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light">

                    <!-- <a class="navbar-brand" href="https://front.codes/" target="_blank"><img
                            src="https://assets.codepen.io/1462889/fcy.png" alt=""></a> -->

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto py-4 py-md-0">

                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="home-btn nav-link" title="Ballina" href="{{route('index')}}"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg> <span id = 'navbar-links-mobile'>Ballina</span> </a>
                            </li>
                            @if (auth()->check())
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="home-btn nav-link" title="Krijo postim" href="{{route('post.create')}}"><svg xmlns="http://www.w3.org/2000/svg"
                                                                           fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg> <span id = 'navbar-links-mobile'>Krijo postim</span></a>
                            </li>

                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="user-profile-btn nav-link" title="Profili" href="{{route('user.show', auth()->user()->slug)}}"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg><span id = 'navbar-links-mobile'>Profili</span></a>
                            </li>
                            @endif
                            @if(auth()->check())
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="login-btn nav-link" href="{{route('logout')}}">Shkyçu</a>
                                </li>
                                @else
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="login-btn nav-link" href="{{route('login')}}">Kyçu</a>
                                </li>
                            @endif

                        </ul>
                    </div>

                </nav>
            </div>
        </div>
    </div>
</div>

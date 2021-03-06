<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="icon" href="{{asset('/images/logo.png')}}" type="image/x-icon" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    @yield('imports')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/individual-posts-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/navbar-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/people-you-may-know-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/post-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/primary-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/search-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/universities-slider.css')}}">
    <link rel="stylesheet" href="{{asset('css/userprofile-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/search-navbar-style.css')}}">

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
@if(session('success_wishlist'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="z-index: 1500;position: fixed; width: 100%; top: 0">
        <strong><b>Njoftim!</b></strong> {{session('success_wishlist')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="cursor: pointer">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('wishlist_failure'))
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="z-index: 1500;position: fixed; width: 100%; top: 0">
        <strong><b>Njoftim!</b></strong> {{session('wishlist_failure')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="cursor: pointer">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('wishlist_item_deleted'))
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="z-index: 1500;position: fixed; width: 100%; top: 0">
        <strong><b>Njoftim!</b></strong> {{session('wishlist_item_deleted')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="cursor: pointer">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


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

                    <div class="collapse navbar-collapse order-1 order-md-2" id="navbarSupportedContent">
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
                                    <a class="home-btn nav-link" href="{{route('bookmarks.index')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg><span id = 'navbar-links-mobile'>Postimet e ruajtura</span>
                                    </a>
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
                                @if( (!Route::is('login')) && !Route::is('register'))
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="login-btn nav-link" href="{{route('login')}}">Kyçu</a>
                                </li>
                                    @endif
                            @endif


                        </ul>
                    </div>
                    @if (!Route::is('index') && !Route::is('login') && !Route::is('register') && !Route::is('search.*'))
                    <div class="navbar-search-wrapper order-2 order-md-1">
                        <form action="{{route('search.posts')}}" method="GET">
                            @csrf
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none"
                             viewBox="0 0 24 24" stroke="#006fa5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>

                            <input class="navbar-search-bar" type="text" placeholder="Kërko..." name="q" autocomplete="off" value="{{isset($_GET['q'])? $_GET['q']: ""}}" style="height: auto!important;">


                        </form>
                    </div>
                        @endif
                </nav>

            </div>
        </div>
    </div>
</div>
@if (!Route::is('index') && !Route::is('login') && !Route::is('register') && !Route::is('search.*'))
<div class="br-mob">
    <br><br>
</div>
    @endif

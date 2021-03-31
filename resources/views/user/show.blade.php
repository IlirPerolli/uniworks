@extends('layouts.index')

@section('title')
    <title>{{$user->name . " " . $user->surname . " - Profili"}}</title>
@endsection

@section('content')



    <!-- User Header Info -->
    <div class="container">
        <div class="user-profile-header-info">
            <div class="row">
                <div class="col">
                    <div class="user-profile-info card">
                        <div class="row no-gutters">
                            <div class="col-md-4" id="user-photo">
                                <img src="/images/{{$user->photo->name}}" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" id="user-info">
                                    <h3 class="card-title">{{$user->name . " " . $user->surname}} @if (auth()->check()) @if (auth()->user()->slug == $user->slug)<a href="{{route('user.edit')}}"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg></a>
                                        @endif
                                        @endif
                                    </h3>

                                    <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                  clip-rule="evenodd" />
                                        </svg>Gjakovë</p>
                                    <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                                  clip-rule="evenodd" />
                                            <path
                                                d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                        </svg>{{$user->university->name}}</p>
                                    <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>{{$user->email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="user-profile-content-articles">

            <div class="row">
                <div class="user-articles-title col">
                    <h2>Artikujt</h2>
                </div>
            </div>

            <div class="row">
                <div class="col" id="posts-content">
                   @include('includes.posts')




                </div>
            </div>


        </div>
    </div>
@endsection

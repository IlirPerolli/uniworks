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
                                    <h3 class="card-title">{{$user->name . " " . $user->surname}}</h3>
                                    <p><i class="fas fa-map-marker-alt mr-2"></i>Gjakovë</p>
                                    <p><i class="fas fa-briefcase mr-2"></i>Universiteti i Gjakovës "Fehmi Agani"</p>
                                    <p><i class="fas fa-envelope mr-2"></i>{{$user->email}}</p>
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

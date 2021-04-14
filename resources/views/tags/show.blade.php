@extends('layouts.index')

@section('title')
    <title>{{'Tagu - '.$tag->name}}</title>
@endsection

@section('content')



    <!-- User Header Info -->
    <div class="container">

        <div class="user-profile-wrapper">
            <div class="row" id="user-profile-photo-row">
                <div class="col" id="user-profile-photo">
                    <svg width="100" height="92" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>

                    <div class="user-profile-name">
                        <h5>Tagu: {{$tag->name}}

                        </h5>
                    </div>
                </div>
            </div>




            <div class="user-profile-bio text-center" >
                <h6>Numri i postimeve: {{$posts->count()}} </h6>

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

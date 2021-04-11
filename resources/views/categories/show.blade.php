@extends('layouts.index')

@section('title')
    <title>{{'Kategoria - '.$category->name}}</title>
@endsection

@section('content')



    <!-- User Header Info -->
    <div class="container">

        <div class="user-profile-wrapper">
            <div class="row" id="user-profile-photo-row">
                <div class="col" id="user-profile-photo">
                    <svg width="100" height="92"  xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>

                    <div class="user-profile-name">
                        <h5>Kategoria: {{$category->name}}

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

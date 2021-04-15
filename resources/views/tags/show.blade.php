@extends('layouts.index')

@section('title')
    <title>{{'Fjala kyçe - '.$tag->name}}</title>
@endsection

@section('content')



    <!-- User Header Info -->
    <div class="container">

        <div class="user-profile-wrapper">
            <div class="row" id="user-profile-photo-row">
                <div class="col" id="user-profile-photo">

                    <img src="/images/tag.png" alt="">

                    <div class="user-profile-name">
                        <h5>Fjala kyçe: {{$tag->name}}

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

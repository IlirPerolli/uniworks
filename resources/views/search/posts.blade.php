@extends('layouts.index')

@section('title')
    <title>Kërko postime - {{$_GET['q']}}</title>
@endsection

@section('content')
    @include('includes.search_form_for_posts')

    <div class="container" id="posts-container">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-9" id="posts-content">
             @include('includes.posts')
            </div>

        </div>
    </div>

@endsection

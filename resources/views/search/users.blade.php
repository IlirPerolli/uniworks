@extends('layouts.index')

@section('title')
    <title>Kërko përdorues</title>
@endsection

@section('content')
@include('includes.search_form')



<div class="search-content">
    <div class="container">
        <div class="searched-result-text">
            @if(isset($_GET['q']))
                <h4>Rezultatet e kërkuara për: {{$_GET['q']}} <span style="font-size: 15px; color:grey">({{$users_count}} Rezultate)</span></h4>
                @endif
        </div>


        <div class="row">
            @if(isset($_GET['q']))
            @if(count($users_from_search)>0)
                @foreach($users_from_search as $user)
            <div class="searched-user-profile-col col-md-3 col-lg-2">
                <div class="searched-user-profile card">
                    <img src="/images/{{$user->photo->name}}" class="card-img-top" alt="...">
                    <div class="searched-user-profile-content card-body">
                        <a href="#">
                            <h6 class="card-title">{{$user->name. " ". $user->surname}}</h6>
                        </a>
                        <p class="text-muted">Universiteti</p>
                    </div>
                </div>
            </div>
                @endforeach
                @else
                <h5 style="color:red; margin-left: 15px">Nuk u gjetën përdorues</h5>
                @endif
                @endif


        </div>
        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center">
                {{$users_from_search->links()}}
            </ul>
        </nav>


    </div>
</div>
    @endsection

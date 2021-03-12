@extends('layouts.index')

@section('title')
    <title>Kërko përdorues - {{$_GET['q']}}</title>@endsection

@section('content')
@include('includes.search_form_for_users')



<div class="search-content">
    <div class="container">
        <div class="searched-result-text">
            @if(isset($users_from_search))
                <h4>Rezultatet e kërkuara për: {{$_GET['q']}} <span style="font-size: 15px; color:grey">({{$users_count}} Rezultate)</span></h4>
                @endif
        </div>


        <div class="row">
            @if(isset($users_from_search))
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
                <h6 style="color:red; margin-left: 15px">Nuk u gjetën përdorues</h6>
                @endif
                @endif
                @if(session('min_length_input'))
                    <h6 style="color:red; margin-left: 15px">{{session('min_length_input')}}</h6>
                @endif

        </div>
        @if(isset($users_from_search))
            @if(count($users_from_search)>0)
        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center">
                {{$users_from_search->links()}}
            </ul>
        </nav>
            @endif
            @endif

    </div>
</div>
    @endsection

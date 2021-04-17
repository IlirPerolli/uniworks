@extends('layouts.index')
@section('content')
@section('title')
    <title>Uniworks - Ballina</title>
@endsection

<!-- Search -->
<div class="container" id="search-container">


        <h1 class="logo-text">Uniworks</h1>

    @if(session('min_length_input'))
        <h6 style="color:red; margin-left: 15px">{{session('min_length_input')}}</h6>
    @endif
        <form>
            <div class="search-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20" fill="#006fa5">
                <path fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd" />
            </svg><input class="main-search-bar" type="text" id="q" name="q" placeholder="Kërko..." autocomplete="off">
            </div>


    <div class="works-users-radio">
        <input type="radio" id="users" name="search" value="posts" checked>
        <label for="users"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg></label>

        <input type="radio" id="posts" name="search" value="users" class="ml-5">
        <label for="posts"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></label>
    </div>
            <input type="submit" style="display: none">
        </form>

    <!-- Random Articles -->
    <div class="random-articles">
        <h6>Disa artikuj</h6>

        <div class="row random-articles-content">
            @foreach($tags as $tag)
                <div class="col">
                    <h3><a href="{{route('tag.show',$tag->slug)}}">{{$tag->name}}</a></h3>
                </div>
            @endforeach



        </div>

    </div>
</div>

@endsection
@section('scripts')
<script>
    $(function(){
        $('form').on('submit',function(){

            event.preventDefault();
        var value = $("input[name='search']:checked").val();
        var search_term = $('#q').val();
        //alert(value);
        if (value == 'posts'){
            window.location.href = '/search/posts?q='+search_term;
        }
        else if (value == 'users'){
            window.location.href = '/search/users?q='+search_term;
        }
        });
    });
</script>
    @endsection

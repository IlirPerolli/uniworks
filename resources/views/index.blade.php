@extends('layouts.index')
@section('content')


<!-- Search -->
<div class="container" id="search-container">

    <div class="logo-text">
        <h1>Uniworks</h1>
        <i class="fas fa-search"></i><input class="main-search-bar" type="text" placeholder="Kërko...">

    </div>

    <div class="works-users-radio">
        <input type="radio" id="userat" name="users" value="users" checked>
        <label for="userat"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg></label>

        <input type="radio" id="userat" name="users" value="users" class="ml-5">
        <label for="userat"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></label>
    </div>


    <!-- Random Articles -->
    <div class="random-articles">
        <h6>Disa artikuj</h6>

        <div class="row random-articles-content">
            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

            <div class="col">
                <h3><a href="#">Prova</a></h3>
            </div>

        </div>

    </div>
</div>

@endsection

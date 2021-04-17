
<div class="search-header">
    <div class="container" id="search-results-container">
        <div class="search-results-wrapper">

            <form action="{{route('search.posts')}}" method="GET">
                @csrf
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20" fill="#006fa5">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd" />
                </svg>
               <input class="main-search-bar" type="text" placeholder="Kërko..." name="q" autocomplete="off" value="{{isset($_GET['q'])? $_GET['q']: ""}}">
                @if (isset($_GET['order']))<input type="hidden" name="order" value="{{$_GET['order']}}">@endif
                @if (isset($_GET['year']))<input type="hidden" name="year" value="{{$_GET['year']}}">@endif
                @if (isset($_GET['startyear']))<input type="hidden" name="startyear" value="{{$_GET['startyear']}}">@endif
                @if (isset($_GET['endyear']))<input type="hidden" name="endyear" value="{{$_GET['endyear']}}">@endif
                @if (isset($_GET['category']))<input type="hidden" name="category" value="{{$_GET['category']}}">@endif
            </form>

        </div>
    </div>
</div>

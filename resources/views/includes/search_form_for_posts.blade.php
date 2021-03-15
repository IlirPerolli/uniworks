
<div class="search-header">
    <div class="container">
        <div class="logo-text">
            <form action="{{route('search.posts')}}" method="GET">
                @csrf
                <i class="fas fa-search"></i><input class="main-search-bar" type="text" placeholder="Kërko..." name="q" autocomplete="off" value="{{isset($_GET['q'])? $_GET['q']: ""}}">
                @if (isset($_GET['order']))<input type="hidden" name="order" value="{{$_GET['order']}}">@endif
                @if (isset($_GET['year']))<input type="hidden" name="year" value="{{$_GET['year']}}">@endif
                @if (isset($_GET['startyear']))<input type="hidden" name="startyear" value="{{$_GET['startyear']}}">@endif
                @if (isset($_GET['endyear']))<input type="hidden" name="endyear" value="{{$_GET['endyear']}}">@endif
                @if (isset($_GET['category']))<input type="hidden" name="category" value="{{$_GET['category']}}">@endif
            </form>

        </div>
    </div>
</div>

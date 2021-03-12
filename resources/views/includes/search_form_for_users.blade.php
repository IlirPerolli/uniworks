
<div class="search-header">
    <div class="container">
        <div class="logo-text">
            <form action="{{route('search.users')}}" method="GET">
                @csrf
                <i class="fas fa-search"></i><input class="main-search-bar" type="text" placeholder="Kërko..." name="q" autocomplete="off" value="{{isset($_GET['q'])? $_GET['q']: ""}}">
            </form>

        </div>
    </div>
</div>

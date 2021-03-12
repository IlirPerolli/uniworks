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
                @if(isset($posts))
                    @if(count($posts)>0)
                        @foreach($posts as $post)
                <div class="posts-col">
                    <a href="#">
                        <h5>{{Str::limit($post->title,150)}}</h5>
                    </a>
                    <p><i class="fas fa-user-friends mr-2"></i>
                        @foreach($post->user as $user)
                            @if ($user->username == null)
                                <a href="#">{{$user->name}}</a>
                            @else
                                <a href="#">{{$user->name . " ". $user->surname}}</a>
                            @endif
                            @if(!$loop->last),
                                @endif


                        @endforeach

                         </p>
                    <p class="post-description">{{Str::limit($post->abstract,500)}}</p>
                </div>@endforeach
                    @else
                        <h6 style="color:red;text-align: center">Nuk u gjetën postime.</h6>
            @endif
            @endif
                    @if(isset($posts))
                        @if(count($posts)>0)
                            <nav aria-label="Pagination">
                                <ul class="pagination justify-content-center">
                                    {{$posts->links()}}
                                </ul>
                            </nav>
                        @endif
                    @endif


            </div>

        </div>
    </div>

@endsection

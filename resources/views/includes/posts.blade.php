@if(isset($posts))
    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="posts-col">
                <a href="{{route('post.show', $post->slug)}}">
                    <h5>{{Str::limit($post->title,150)}}</h5>
                </a>
                <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    @foreach($post->user as $user)
                        @if ($user->username == null)
                            <a href="{{route('user.show',$user->slug)}}">{{$user->name}}</a>
                        @else
                            <a href="{{route('user.show',$user->slug)}}">{{$user->name . " ". $user->surname}}</a>
                        @endif
                        @if(!$loop->last),
                        @endif
                    @endforeach
                </p>
                <p class="post-description">{{Str::limit($post->abstract,500)}}</p>
            </div>
        @endforeach
    @else
        <h6 style="color:red;text-align: center">Nuk u gjetën postime.</h6>
    @endif
@endif
@if(isset($posts))
    @if(count($posts)>0)
        <nav aria-label="Pagination" style="margin-top: 50px">
            <ul class="pagination justify-content-center">
                {{$posts->links()}}
            </ul>
        </nav>
    @endif
@endif

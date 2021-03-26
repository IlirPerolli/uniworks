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
                            <span>{{$user->name}}</span>
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

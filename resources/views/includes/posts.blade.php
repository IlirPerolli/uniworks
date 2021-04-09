@if(isset($posts))
    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="posts-col">
                <a href="{{route('post.show', $post->slug)}}">
                    <h5>{{Str::limit($post->title,150)}}</h5>
                </a>
                <div class="other-articles-partners">
                    <div class="other-articles-partners-photo">
                        @foreach($post->user as $user)
                            <a href="{{route('user.show',$user->slug)}}"> <img src="/images/{{$user->photo->name}}" alt="" title="{{$user->name . " " . $user->surname}}"></a>
                        @endforeach

                    </div>
                </div>
                <p class="post-description">{{Str::limit($post->abstract,500)}}</p>
            </div>
        @endforeach
    @else
        <h6 style="color:red;text-align: center; margin-top: 20px;">Nuk u gjetën postime.</h6>
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

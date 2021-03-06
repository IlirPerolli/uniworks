@error('q')
<span style="color: #e3342f; font-size: 14px;">{{ $message }}</span>
@enderror

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

                <div class="post-options">
                        <svg width="26" style="display: inline-block" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                             id="pdf-icon">
                            <path
                                d="M18 22H6C4.89543 22 4 21.1046 4 20V3.99999C4 2.89542 4.89543 1.99999 6 1.99999H13C13.009 1.99882 13.018 1.99882 13.027 1.99999H13.033C13.0424 2.00294 13.0522 2.00495 13.062 2.00599C13.1502 2.01164 13.2373 2.02878 13.321 2.05699H13.336H13.351H13.363C13.3815 2.06991 13.3988 2.08429 13.415 2.09999C13.5239 2.14841 13.6232 2.21617 13.708 2.29999L19.708 8.29999C19.7918 8.38477 19.8596 8.48404 19.908 8.59299C19.917 8.61499 19.924 8.63599 19.931 8.65899L19.941 8.68699C19.9689 8.77038 19.9854 8.85717 19.99 8.94499C19.9909 8.95495 19.9932 8.96472 19.997 8.97399V8.97999C19.9986 8.98654 19.9996 8.99324 20 8.99999V20C20 20.5304 19.7893 21.0391 19.4142 21.4142C19.0391 21.7893 18.5304 22 18 22ZM14.424 14V19H15.364V16.96H16.824V16.122H15.364V14.841H17V14H14.424ZM10.724 14V19H11.93C12.4359 19.0249 12.9258 18.8189 13.262 18.44C13.6069 17.9999 13.7797 17.4492 13.748 16.891V16.081C13.7712 15.5286 13.5936 14.9865 13.248 14.555C12.9226 14.1846 12.4476 13.9807 11.955 14H10.724ZM7 14V19H7.94V17.241H8.566C8.98402 17.2641 9.39232 17.1094 9.69 16.815C9.97408 16.4974 10.1214 16.0806 10.1 15.655C10.1186 15.2192 9.97135 14.7926 9.688 14.461C9.40772 14.1502 9.00309 13.9811 8.585 14H7ZM13 3.99999V8.99999H18L13 3.99999ZM11.946 18.162H11.664V14.841H12.006C12.2489 14.8267 12.4824 14.9366 12.626 15.133C12.7726 15.4363 12.8354 15.7732 12.808 16.109V16.978C12.83 17.2977 12.7606 17.6171 12.608 17.899C12.4441 18.0903 12.1965 18.1887 11.946 18.162ZM8.585 16.4H7.939V14.841H8.594C8.75752 14.8428 8.90863 14.9285 8.994 15.068C9.10222 15.2466 9.15447 15.4534 9.144 15.662C9.15654 15.8565 9.1049 16.0497 8.997 16.212C8.89754 16.3368 8.74447 16.4067 8.585 16.4Z"
                                fill="#dc143c">
                            </path>
                        </svg>
                    @if (auth()->guest())
                        <form action="{{route('bookmarks.store',$post->slug)}}" method="POST" style="display: inline-block">
                            @csrf
                            <button type="submit" class="btn btn-link" style="color:black;padding: 0"> <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24"
                                                                                                 stroke="#006fa5" >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg></button>
                        </form>
                    @endif
                    @if (auth()->check())
                        @if(auth()->user()->bookmark->contains($post->id))
                            <form action="{{route('bookmarks.destroy',$post->slug)}}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link" style="color:black;padding: 0"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#006fa5" viewBox="0 0 24 24"
                                                                                                               stroke="#006fa5" >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg></button>
                            </form>
                        @else
                            <form action="{{route('bookmarks.store',$post->slug)}}" method="POST" style="display: inline-block">
                                @csrf

                                <button type="submit" class="btn btn-link" style="color:black; padding: 0"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24"
                                                                                                                stroke="#006fa5" >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg></button>
                            </form>
                        @endif
                    @endif

                </div>










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

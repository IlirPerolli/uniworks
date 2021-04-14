@extends('layouts.index')

@section('title')
    <title>{{$post->title}}</title>
@endsection
@section('styles')
    <style>
        input[type=text], input[type=number]{

            height: 50px !important;
        }
        select{
            height: 50px !important;
        }
        .form-group{
            margin-bottom: 0px !important;
        }
    </style>
@endsection

@section('content')


    <div class="container" id="user-post-container">
        <div class="user-post-title">
            <h1>{{$post->title}}</h1>
        </div>

        <div class="user-post-time-date">
            <h6>{{$post->created_at->format('H:i:s')}} | {{$post->created_at->format('d.m.Y')}}</h6>

        </div>

        <div class="user-post-partners">
            <div class="partners-photo">
                @foreach($users as $user)
                @if($user->slug != null)    <a href="{{route('user.show', $user->slug)}}"> <img src="/images/{{$user->photo->name}}" alt="{{$user->name . " " . $user->surname}}" title="{{$user->name . " " . $user->surname}}" style="cursor: pointer"></a>
                    @else
                        <img src="/images/{{$user->photo->name}}" alt="{{$user->name}}" title="{{$user->name}}" style="cursor: pointer">
                    @endif
                @endforeach
            </div>
        </div>

        <div class="user-post-file-button d-flex">

            <a href="/files/{{$post->file->name}}" target="_blank">
                <button class="file-button btn">
                    <svg width="90" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18 22H6C4.89543 22 4 21.1046 4 20V3.99999C4 2.89542 4.89543 1.99999 6 1.99999H13C13.009 1.99882 13.018 1.99882 13.027 1.99999H13.033C13.0424 2.00294 13.0522 2.00495 13.062 2.00599C13.1502 2.01164 13.2373 2.02878 13.321 2.05699H13.336H13.351H13.363C13.3815 2.06991 13.3988 2.08429 13.415 2.09999C13.5239 2.14841 13.6232 2.21617 13.708 2.29999L19.708 8.29999C19.7918 8.38477 19.8596 8.48404 19.908 8.59299C19.917 8.61499 19.924 8.63599 19.931 8.65899L19.941 8.68699C19.9689 8.77038 19.9854 8.85717 19.99 8.94499C19.9909 8.95495 19.9932 8.96472 19.997 8.97399V8.97999C19.9986 8.98654 19.9996 8.99324 20 8.99999V20C20 20.5304 19.7893 21.0391 19.4142 21.4142C19.0391 21.7893 18.5304 22 18 22ZM14.424 14V19H15.364V16.96H16.824V16.122H15.364V14.841H17V14H14.424ZM10.724 14V19H11.93C12.4359 19.0249 12.9258 18.8189 13.262 18.44C13.6069 17.9999 13.7797 17.4492 13.748 16.891V16.081C13.7712 15.5286 13.5936 14.9865 13.248 14.555C12.9226 14.1846 12.4476 13.9807 11.955 14H10.724ZM7 14V19H7.94V17.241H8.566C8.98402 17.2641 9.39232 17.1094 9.69 16.815C9.97408 16.4974 10.1214 16.0806 10.1 15.655C10.1186 15.2192 9.97135 14.7926 9.688 14.461C9.40772 14.1502 9.00309 13.9811 8.585 14H7ZM13 3.99999V8.99999H18L13 3.99999ZM11.946 18.162H11.664V14.841H12.006C12.2489 14.8267 12.4824 14.9366 12.626 15.133C12.7726 15.4363 12.8354 15.7732 12.808 16.109V16.978C12.83 17.2977 12.7606 17.6171 12.608 17.899C12.4441 18.0903 12.1965 18.1887 11.946 18.162ZM8.585 16.4H7.939V14.841H8.594C8.75752 14.8428 8.90863 14.9285 8.994 15.068C9.10222 15.2466 9.15447 15.4534 9.144 15.662C9.15654 15.8565 9.1049 16.0497 8.997 16.212C8.89754 16.3368 8.74447 16.4067 8.585 16.4Z">
                        </path>
                    </svg>
                </button>
            </a>
            @if (auth()->check())
                @if ((auth()->user()->id == $post->user_id) || (($user->id == auth()->user()->id) && ($post->user_id != auth()->user()->id )) || ($post->user_id == auth()->user()->id) )
                    <div class="vl"></div>
                @endif
                @endif


            @if (auth()->check())
                @if (auth()->user()->id == $post->user_id)
                    <button onclick="window.location.href='{{route('post.edit',$post->slug)}}'" class="edit-button btn">
                        <svg width="30" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.41999 20.579C4.13948 20.5785 3.87206 20.4603 3.68299 20.253C3.49044 20.0475 3.39476 19.7695 3.41999 19.489L3.66499 16.795L14.983 5.48103L18.52 9.01703L7.20499 20.33L4.51099 20.575C4.47999 20.578 4.44899 20.579 4.41999 20.579ZM19.226 8.31003L15.69 4.77403L17.811 2.65303C17.9986 2.46525 18.2531 2.35974 18.5185 2.35974C18.7839 2.35974 19.0384 2.46525 19.226 2.65303L21.347 4.77403C21.5348 4.9616 21.6403 5.21612 21.6403 5.48153C21.6403 5.74694 21.5348 6.00146 21.347 6.18903L19.227 8.30903L19.226 8.31003Z">
                            </path>
                        </svg>
                        Edito
                    </button>

                @endif
            @endif


            @if (auth()->check())
                @foreach($users as $user)
                    @if (($user->id == auth()->user()->id) && ($post->user_id != auth()->user()->id ))
                        <form action="{{route('post.remove.tag',$post->slug)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="remove-tag-button btn">
                                <svg width="30" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 22C9.34711 22.0024 6.80218 20.9496 4.9263 19.0737C3.05042 17.1978 1.99762 14.6529 2 12V11.8C2.08179 7.79223 4.5478 4.22016 8.26637 2.72307C11.9849 1.22597 16.2381 2.0929 19.074 4.92601C21.9365 7.78609 22.7932 12.0893 21.2443 15.8276C19.6955 19.5659 16.0465 22.0024 12 22ZM12 13.41L14.59 16L16 14.59L13.41 12L16 9.41001L14.59 8.00001L12 10.59L9.41001 8.00001L8.00001 9.41001L10.59 12L8.00001 14.59L9.41001 16L12 13.411V13.41Z">
                                    </path>

                                </svg>
                                Hiq tagun
                            </button>
                        </form>

                    @endif
                @endforeach
            @endif

            @if (auth()->check())
                @if ($post->user_id == auth()->user()->id)
                    <form action="{{route('post.destroy',$post->slug)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="remove-tag-button btn">
                                <svg width="30" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 22C9.34711 22.0024 6.80218 20.9496 4.9263 19.0737C3.05042 17.1978 1.99762 14.6529 2 12V11.8C2.08179 7.79223 4.5478 4.22016 8.26637 2.72307C11.9849 1.22597 16.2381 2.0929 19.074 4.92601C21.9365 7.78609 22.7932 12.0893 21.2443 15.8276C19.6955 19.5659 16.0465 22.0024 12 22ZM12 13.41L14.59 16L16 14.59L13.41 12L16 9.41001L14.59 8.00001L12 10.59L9.41001 8.00001L8.00001 9.41001L10.59 12L8.00001 14.59L9.41001 16L12 13.411V13.41Z">
                                </path>

                            </svg>
                            Fshij
                        </button>
                    </form>

                @endif
            @endif



        </div>


        <div class="user-post-year-published">
            <em>
                <h6>Viti i krijimit: <span>{{$post->year}}</span></h6>
            </em>
        </div>
        <div class="user-post-category">
            <em>
                <h6>Kategoria: <span><a href="{{route('category.show',$post->category->slug)}}" style="color:black; text-decoration: none">{{$post->category->name}}</a></span></h6>
            </em>
        </div>
        Tagjet:
        @foreach($post->tags as $tag)
            <a href="{{route('tag.show',$tag->slug)}}" class="badge badge-secondary">{{$tag->name}}</a>
        @endforeach


        <div class="user-post-abstract">
            <h2>Abstrakti</h2>

            <div class="abstract-content">
                <p>{{$post->abstract}}
                </p>
            </div>
        </div>
        @if ($post->resource != null)
            <div class="user-post-source">
                <h2>Burimi</h2>

                <div class="source-links">
                    <a href="http://{{$post->resource}}">
                        <p>{{$post->resource}}</p>
                    </a>

                </div>
            </div>

    @endif






    <!-- Other Articles -->
        <div class="other-articles">

            <div class="user-post-other-articles">
                <h2>Artikujt nga autorë të tjerë</h2>
            </div>

@if (count($other_posts)>0)
            @foreach($other_posts as $post)
                <div class="other-articles-content">
                    <div class="other-articles-title">
                        <a href="{{route('post.show',$post->slug)}}">
                            <h5>{{Str::limit($post->title,150)}}</h5>
                        </a>
                        <div class="other-articles-partners">
                            <div class="other-articles-partners-photo">
                                @foreach($post->user as $user)
                                    <a href="{{route('user.show',$user->slug)}}"> <img src="/images/{{$user->photo->name}}" alt="" title="{{$user->name . " " . $user->surname}}"></a>
                                @endforeach

                            </div>
                        </div>
                        <p class="other-articles-description">{{Str::limit($post->abstract,500)}}</p>
                    </div>
                </div>

        @endforeach
            @else
    <br>

    <span style="color:red">Nuk u gjeten artikuj</span>
            @endif
{{--        <!-- People You May Know -->--}}
        <div class="row" id="pymk-row">
            <div class="col-12">
                <h2 id="pymk-title">Përdorues që mund ti njihni</h2>
            </div>
        </div>

        <div class="wrapper mb-5">
            @if(count($suggested_users)>0)
            <ul id="pymk">


                @foreach($suggested_users as $user)


                <li class="pymk-item mr-2">
                    <a href="{{route('user.show',$user->slug)}}">
                        <div class="pymk-photo">
                            <img src="/images/{{$user->photo->name}}" alt="">
                        </div>
                        <div class="pymk-name">
                            {{$user->name . " " . $user->surname}}
                        </div>
                    </a>
                    <!-- <div class="follow-button">
                        <button class="follow-btn btn">Follow</button>
                    </div> -->
                </li>

                @endforeach

            </ul>
            @else
                <span style="color:red">Nuk u gjeten perdorues</span>
            @endif
        </div>




    </div>
    </div>

@endsection



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


    <div class="container">
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


        <div class="user-post-abstract">
            <h2>Abstrakti</h2>

            <div class="abstract-content">
                <p>{{$post->abstract}}
                </p>
            </div>
        </div>


        <div class="user-post-pdf">
{{--            <h2>PDF Example with iframe</h2>--}}
            <embed src="/files/{{$post->file->name}}" width="50%" height="500px" style="border: 5px solid gray">
            </embed>

        </div>

    @if ($post->user_id == auth()->user()->id)
        <form action="{{route('post.destroy',$post->slug)}}" method="POST">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Fshij postimin</button>
        </form>

        @endif
        @foreach($users as $user)
        @if (($user->id == auth()->user()->id) && ($post->user_id != auth()->user()->id ))
                <form action="{{route('post.remove.tag',$post->slug)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Fshij tagun</button>
                </form>

        @endif
        @endforeach
        @if (auth()->user()->id == $post->user_id)
            <a href="{{route('post.edit',$post->slug)}}">Edito</a>
            @endif
    <!-- Other Articles -->
        <div class="other-articles mb-5">

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
                        <a href="{{route('post.show',$post->slug)}}"> <p class="other-articles-description">{{Str::limit($post->abstract,500)}}</p></a>
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



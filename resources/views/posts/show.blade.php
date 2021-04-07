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
            <object width="100%" height="500" type="application/pdf" data="/files/{{$post->file->name}}?#zoom=100&scrollbar=0&toolbar=0&navpanes=0">
                <p style="color:red">Kërkojmë falje. Nuk mund te shfaqet dokumenti.</p>
            </object>

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
        <div class="user-post-about-author mb-5">
            <h2>Rreth autorit</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus dolorum pariatur ullam iure, ipsam
                sint magnam. Nam exercitationem blanditiis non fugiat sunt sapiente eligendi dolores. Voluptatibus nisi
                eos asperiores nobis fuga. Delectus commodi ullam accusantium cum veniam eveniet consequuntur inventore
                similique! Illum ad veritatis natus, qui sequi odit eligendi vitae. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus dolorum pariatur ullam iure, ipsam
                sint magnam. Nam exercitationem blanditiis non fugiat sunt sapiente eligendi dolores. Voluptatibus nisi
                eos asperiores nobis fuga. Delectus commodi ullam accusantium cum veniam eveniet consequuntur inventore
                similique! Illum ad veritatis natus, qui sequi odit eligendi vitae.
            </p>
        </div>
        <!-- People You May Know -->
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


@endsection



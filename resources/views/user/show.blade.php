@extends('layouts.index')

@section('title')
    <title>{{$user->name . " " . $user->surname . " - Profili"}}</title>
@endsection

@section('content')



    <!-- User Header Info -->
    <div class="container">

        <div class="user-profile-wrapper">
            <div class="row" id="user-profile-photo-row">
                <div class="col" id="user-profile-photo">
                    <img src="/images/{{$user->photo->name}}" alt="">

                    <div class="user-profile-name">
                        <h5>{{$user->name . " " . $user->surname}}
                            @if (auth()->check())
                            @if($user->id == auth()->user()->id)
                            <a href="{{route('user.edit')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg></a>
                                @endif
                                @endif
                        </h5>
                    </div>
                </div>
            </div>

            <div class="row" id="user-profile-info-row">
                @if ($user->city_id !=null)
                <div class="col-md-6 col-lg-4">
                    <h6>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                  clip-rule="evenodd" />
                        </svg>
                        {{$user->city->name}}
                    </h6>
                </div>
                @endif
                    @if ($user->university_id !=null)
                <div class="col-md-6 col-lg-4 mt-1">
                    <h6>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                  clip-rule="evenodd" />
                            <path
                                d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                        </svg> {{$user->university->name}}
                    </h6>
                </div>
                @endif
                    @if ($user->email !=null)
                <div class="col-md-6 col-lg-4 mt-1">
                    <h6>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg> <a href="mailto:{{$user->mail}}" style="color: black; text-decoration: none">{{$user->email}}</a>
                    </h6>
                </div>
                    @endif
                    @if ($user->linkedin !=null)
                <div class="col-md-6 col-lg-4 mt-1" id="linkedin-div">
                    <h6>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13 21H9V9H13V11C13.8526 9.91525 15.1456 9.26857 16.525 9.237C19.0056 9.25077 21.0072 11.2694 21 13.75V21H17V14.25C16.84 13.1326 15.8818 12.3036 14.753 12.306C14.2593 12.3216 13.7932 12.5378 13.4624 12.9046C13.1316 13.2715 12.9646 13.7573 13 14.25V21ZM7 21H3V9H7V21ZM5 7C3.89543 7 3 6.10457 3 5C3 3.89543 3.89543 3 5 3C6.10457 3 7 3.89543 7 5C7 5.53043 6.78929 6.03914 6.41421 6.41421C6.03914 6.78929 5.53043 7 5 7Z"
                                fill="#006fa5"></path>
                        </svg>

                        <a href="http://linkedin.com/in/{{$user->linkedin}}" target="_blank" style="color: black; text-decoration: none"> {{$user->linkedin}} </a>
                    </h6>
                </div>
                    @endif
                    @if ($user->github !=null)
                <div class="col-md-6 col-lg-4 mt-2" id="github-div">
                    <h6>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.026 2C7.13295 1.99937 2.96183 5.54799 2.17842 10.3779C1.395 15.2079 4.23061 19.893 8.87302 21.439C9.37302 21.529 9.55202 21.222 9.55202 20.958C9.55202 20.721 9.54402 20.093 9.54102 19.258C6.76602 19.858 6.18002 17.92 6.18002 17.92C5.99733 17.317 5.60459 16.7993 5.07302 16.461C4.17302 15.842 5.14202 15.856 5.14202 15.856C5.78269 15.9438 6.34657 16.3235 6.66902 16.884C6.94195 17.3803 7.40177 17.747 7.94632 17.9026C8.49087 18.0583 9.07503 17.99 9.56902 17.713C9.61544 17.207 9.84055 16.7341 10.204 16.379C7.99002 16.128 5.66202 15.272 5.66202 11.449C5.64973 10.4602 6.01691 9.5043 6.68802 8.778C6.38437 7.91731 6.42013 6.97325 6.78802 6.138C6.78802 6.138 7.62502 5.869 9.53002 7.159C11.1639 6.71101 12.8882 6.71101 14.522 7.159C16.428 5.868 17.264 6.138 17.264 6.138C17.6336 6.97286 17.6694 7.91757 17.364 8.778C18.0376 9.50423 18.4045 10.4626 18.388 11.453C18.388 15.286 16.058 16.128 13.836 16.375C14.3153 16.8651 14.5612 17.5373 14.511 18.221C14.511 19.555 14.499 20.631 14.499 20.958C14.499 21.225 14.677 21.535 15.186 21.437C19.8265 19.8884 22.6591 15.203 21.874 10.3743C21.089 5.54565 16.9181 1.99888 12.026 2Z"
                                fill="#006fa5"></path>
                        </svg>
                        <a href="http://github.com/{{$user->github}}" target="_blank" style="color: black; text-decoration: none"> {{$user->github}} </a>
                    </h6>
                </div>
                    @endif
                    @if ($user->website !=null)
                <div class="col-md-6 col-lg-4 mt-2" id="website-div">
                    <h6>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z"
                                  clip-rule="evenodd" />
                        </svg>
                        <a href="http://{{$user->website}}" target="_blank" style="color: black; text-decoration: none"> {{$user->website}} </a>
                    </h6>
                </div>
            @endif
            </div>

            @if ($user->about !=null)
            <div class="user-profile-bio">
                <h6>Biografia</h6>
                <p>{{$user->about}}
                </p>
            </div>
        @endif
        </div>

        <div class="user-profile-content-articles">

            <div class="row">

                <div class="user-articles-title col">
                    @if(session()->has('deleted_post'))
                    <div class="alert alert-danger" style="margin-top: 20px" role="alert">
                        {{session('deleted_post')}}
                    </div>
                    @endif
                    <h2>Artikujt</h2>
                </div>
            </div>

            <div class="row">
                <div class="col" id="posts-content">
                   @include('includes.posts')




                </div>
            </div>


        </div>
    </div>
@endsection

@extends('layouts.index')

@section('title')
    <title>{{$user->name . " " . $user->surname . " - Ndrysho usernamin"}}</title>
@endsection
@section('styles')
    <style>
        input[type=text]{

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

    <div class="user-edit-account">
        <div class="container">
            <div class="row">
                @include('includes.edit_profile_sidebar')


                <div class="col-md-8" id="change-password-fields">
                    <h1 class="edit-account-text">Ndrysho usernamin</h1>
                    @if(session()->has('username_changed'))
                        <div class="alert alert-success" style="margin-top: 20px" role="alert">
                            {{session('username_changed')}}
                        </div>
                    @endif
                    @if (auth()->user()->username_changed != 1)
                    <form class="change-password-form-fields" action="{{route('user.username.update')}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group" id="change-password-field">
                            <label for="username">Shkruani usernamin e ri</label>
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off">
                        </div>
                        <span style="font-size: 13px"><i><strong>Kujdes!</strong> Vetem një herë lejohet ndërrimi i usernamit.</i></span>
                       <br>
                        @if (session('username_exceeded'))
                            <span style="color:red">{{ session('username_exceeded') }}</span>
                            <br>
                        @endif
                        @if (session('current_username'))
                            <span style="color:red">{{ session('current_username') }}</span>
                            <br>
                        @endif
                        @error('username')
                        <span style="color:red">{{ $message }}</span>
                        <br>
                        @enderror


                        <div class="change-password-buttons">

                            <button class="save-button btn">
                                <h5> Ruaj</h5>
                            </button>
                        </div>

                    </form>
                    @else
                        <h6 style="color:red">Kërkojmë falje, username mund të ndërrohet vetëm një herë.</h6>
                    @endif


                </div>
            </div>

        </div>
    </div>

@endsection





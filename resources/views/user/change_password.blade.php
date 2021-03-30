@extends('layouts.index')

@section('title')
    <title>{{$user->name . " " . $user->surname . " - Ndrysho fjalekalimin"}}</title>
@endsection
@section('styles')
    <style>
        input[type=password]{

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
                <div class="col-md-4" id="edit-account-side">
                    <a href="userEditProfile.html">
                        <h2 class="edit-profile-side-text">Edito profilin</h2>
                    </a>

                    <!-- <a href="userEditAccount.html">
                        <h2 class="edit-account-side-text">Llogaria juaj</h2>
                    </a> -->

                    <a href="userChangePassword.html">
                        <h2 class="edit-profile-side-text">Ndrysho fjalëkalimin
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7" />
                            </svg>
                        </h2>
                    </a>
                </div>


                <div class="col-md-8" id="change-password-fields">
                    <h1 class="edit-account-text">Ndrysho fjalëkalimin</h1>
                    @if(session()->has('password_changed'))
                        <div class="alert alert-success" style="margin-top: 20px" role="alert">
                            {{session('password_changed')}}
                        </div>
                    @endif

                    <form class="change-password-form-fields" action="{{route('user.password.update')}}" method="POST">
                       @csrf
                        @method('PATCH')
                        <div class="form-group" id="change-password-field">
                            <label for="password">Fjalëkalimi i tanishëm</label>
                            <input type="password" class="form-control" name="current_password" id="password">
                        </div>
                        @if (session('invalid-current-password'))
                        <span style="color:red">{{ session('invalid-current-password') }}</span>
                        <br>
                        @endif
                        @error('current_password')
                        <span style="color:red">{{ $message }}</span>
                        <br>
                        @enderror

                        <div class="form-group">
                            <label for="password">Fjalëkalimi i ri</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        @error('password')
                        <span style="color:red">{{ $message }}</span>
                        <br>
                        @enderror
                        <div class="form-group">
                            <label for="password">Rishkruaj fjalëkalimin e ri</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password">
                        </div>
                        @error('password_confirmation')
                        <span style="color:red">{{ $message }}</span>
                        <br>
                        @enderror
                        <div class="change-password-buttons">
                            <div class="cancel-button btn">
                                <h5>Anulo</h5>
                            </div>

                            <button class="save-button btn">
                                <h5> Ruaj</h5>
                            </button>
                        </div>

                    </form>




                </div>
            </div>

        </div>
    </div>

@endsection





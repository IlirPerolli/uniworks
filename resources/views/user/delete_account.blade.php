@extends('layouts.index')

@section('title')
    <title>{{$user->name . " " . $user->surname . " - Fshij llogarinë"}}</title>
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
                @include('includes.edit_profile_sidebar')


                <div class="col-md-8" id="change-password-fields">
                    <h1 class="edit-account-text">Fshij llogarinë</h1>
                    @if(session()->has('password_changed'))
                        <div class="alert alert-success" style="margin-top: 20px" role="alert">
                            {{session('password_changed')}}
                        </div>
                    @endif

                    <form class="change-password-form-fields" action="{{route('user.destroy')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="form-group" id="change-password-field">
                            <label for="password">Fjalëkalimi i tanishëm</label>
                            <input type="password" class="form-control" name="current_password" id="password" autocomplete="off" required>
                        </div>
                        @if (session('invalid-current-password'))
                            <span style="color:red">{{ session('invalid-current-password') }}</span>
                            <br>
                        @endif
                        @error('current_password')
                        <span style="color:red">{{ $message }}</span>
                        <br>
                        @enderror


                        <div class="change-password-buttons">

                            <button class="save-button btn" style="background: #dc3545; border-color:#dc3545;   ">
                                <h5> Fshij</h5>
                            </button>
                        </div>

                    </form>




                </div>
            </div>

        </div>
    </div>

@endsection





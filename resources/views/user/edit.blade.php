@extends('layouts.index')

@section('title')
    <title>{{$user->name . " " . $user->surname . " - Ndrysho profilin"}}</title>
@endsection
@section('styles')
    <style>
        input[type=text]{

            height: 50px !important;
        }
        input[type=email]{

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


    <div class="user-edit-profile">
        <div class="container">
            <div class="row">
      @include('includes.edit_profile_sidebar')


                <div class="col-md-8" id="edit-profile-fields">
                    <h1 class="edit-profile-text">Edito profilin</h1>

                    <div id="edit-profile-user-photo">


                        <form class="edit-profile-form-fields" action="{{route('user.photo.update')}}" method="POST" enctype="multipart/form-data" id="input-form">
                            @csrf
                            @method('PATCH')

                            <label for="file" class="upload-photo-btn">
                                <input class="upload-photo-input" type="file" name="photo_id" id="file"
                                       accept=".jpeg,.jpg,.png,.svg">

                                <img src="/images/{{$user->photo->name}}" alt="..." style="max-width: 300px; max-height: 300px; width: 50%; cursor: pointer">
                                <input type="submit" style="display: none">
                            </label>
                            @error('file_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                        </form>
                        @if (auth()->user()->photo_id != 1)
                            <form action="{{route('user.photo.destroy')}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-link" id="remove-photo-link" type="submit">Fshij foton</button>
                            </form>
                        @endif
                    </div>

                    @if(session()->has('updated_user'))
                        <div class="alert alert-success" style="margin-top: 20px" role="alert">
                            {{session('updated_user')}}
                        </div>
                    @endif
                    <form class="edit-profile-form-fields" action="{{route('user.update')}}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Emri</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required autocomplete="off">
                            </div>
                            @error('name')
                            <span style="color:red">{{ $message }}</span>
                            <br>
                            @enderror
                            <div class="form-group col-md-6">
                                <label for="surname">Mbiemri</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}" required autocomplete="off">
                            </div>
                        </div>
                        @error('surname')
                        <span style="color:red">{{ $message }}</span>
                        <br>
                        @enderror
                        <div class="form-group">
                            <label for="location">Qyteti</label>
                            <input type="text" class="form-control" id="location" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="work">Universiteti</label>
                            <input type="text" class="form-control" id="university_id" name="university" value="{{$user->university->name}}">
                            <input type="hidden" id="id" name="university_id">
                        </div>

                        <div class="form-group">
                            <label for="email">Email adresa</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required autocomplete="off">
                        </div>
                        @error('email')
                        <span style="color:red">{{ $message }}</span>
                        <br>
                        @enderror

                        <div class="form-group">
                            <label for="about-you">Rreth jush</label>
                            <textarea class="form-control" id="about-you" rows="3" name="about">{{$user->about}}</textarea>
                        </div>
                        @error('about')
                        <span style="color:red">{{ $message }}</span>
                        <br>
                        @enderror
                        <div class="edit-profile-buttons">

                            <button class="save-button btn">
                                <h5>Ruaj</h5>
                            </button>
                        </div>
                    </form>



                </div>
            </div>

        </div>
    </div>


@endsection


@section('scripts')

    <script type="text/javascript">


        $('#university_id').autocomplete({
            source:'{!!URL::route('user.university.autocomplete')!!}',
            minlength:1,
            autoFocus:true,
            select:function(e,ui)
            {
                $('#university_id').val(ui.item.value);
                $('#id').val(ui.item.id);
                return false;
            }
        });


    </script>
    <script>
        document.getElementById("file").onchange = function() {
            document.getElementById("form").submit();
        };
    </script>
    <script>
        document.getElementById("file").onchange = function() {
            document.getElementById("input-form").submit();
        };
    </script>

@endsection




@extends('layouts.index')

@section('title')
    <title>{{$user->name . " " . $user->surname . " - Ndrysho foton"}}</title>
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


    <div class="user-edit-profile">
        <div class="container">
            <div class="row">
                @include('includes.edit_profile_sidebar')


                <div class="col-md-8" id="edit-profile-fields">
                    <h1 class="edit-profile-text">Edito foton</h1>

                    <div id="edit-profile-user-photo">
                        <img src="/images/{{$user->photo->name}}" alt="...">
                    </div>
                    @if(session()->has('updated_photo'))
                        <div class="alert alert-success" style="margin-top: 20px" role="alert">
                            {{session('updated_photo')}}
                        </div>
                    @endif
                    @if(session()->has('deleted_photo'))
                        <div class="alert alert-danger" style="margin-top: 20px" role="alert">
                            {{session('deleted_photo')}}
                        </div>
                    @endif
                    @if (auth()->user()->photo_id != 1)
                    <form action="{{route('user.photo.destroy')}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-danger" type="submit">Fshij foton</button>
                    </form>
                    @endif
                    <form class="edit-profile-form-fields" action="{{route('user.photo.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-row">
                            <div class="col-sm-12">
                                <div class="form-group" id="upload-article">
                                    <label for="upload">Ngarko foton e profilit</label>
                                    <div style="width: 100%;  word-break: break-all">
                                        <div class='file-input' style="border:1px solid #ced4da;">

                                            <input type='file' name="photo_id" accept=".jpeg,.jpg,.png,.svg">
                                            <span class='button'>Zgjedh</span>

                                            <span class='label' data-js-label >Zgjedhni foton...</span>
                                        </div>

                                    </div></div>
                                @error('file_id')
                                <span style="color:red">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>



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
    <script>
        var inputs = document.querySelectorAll('.file-input')

        for (var i = 0, len = inputs.length; i < len; i++) {
            customInput(inputs[i])
        }

        function customInput (el) {
            const fileInput = el.querySelector('[type="file"]')
            const label = el.querySelector('[data-js-label]')

            fileInput.onchange =
                fileInput.onmouseout = function () {
                    if (!fileInput.value) return

                    var value = fileInput.value.replace(/^.*[\\\/]/, '')
                    el.className += ' -chosen'
                    label.innerText = value
                }
        }
    </script>
    @endsection





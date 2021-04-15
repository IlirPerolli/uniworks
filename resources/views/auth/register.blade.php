@extends('layouts.index')
<link rel="stylesheet" href="{{asset('css/register-style.css')}}">
@section('styles')
    <style>
        .form-group label {
            margin-top: 0px;
        }
    </style>
@endsection
@section('content')
<div class="container" style="margin-top: 100px">

    <div class="register-container">

        <h1 class="register-title">Krijo llogari</h1>


        <form class="register-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="register-form-row">
                <label for="first-name" class="register-form-label">Emri</label>
                <div>
                    <input type="text" id="first-name" name="name" class="register-form-input" value="{{old('name')}}" required autocomplete="off" autofocus>
                    @error('name')

                    <span style="color: #e3342f; font-size: 14px; padding-left: 12px">{{ $message }}</span>

                    @enderror
                </div>
            </div>

            <div class="register-form-row">
                <label for="last-name" class="register-form-label">Mbiemri</label>
                <div>
                    <input type="text" id="last-name" name="surname" class="register-form-input" value="{{old('surname')}}" required autocomplete="off" autofocus>
                    @error('surname')

                    <span style="color: #e3342f; font-size: 14px; padding-left: 12px">{{ $message }}</span>

                    @enderror
                </div>
            </div>

            <div class="register-form-row">
                <div class="username">
                    <label for="username" class="register-form-label" data-toggle="tooltip" data-placement="bottom"
                           value="uni.epizy.com/përdoruesi">Përdoruesi
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20"
                             fill="#006fa5" class="register-form-info-icon">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                  clip-rule="evenodd" />
                        </svg>
                    </label>
                </div>
                <div>
                    <input type="text" id="username" name="username" class="register-form-input" value="{{ old('username') }}" required autocomplete="off" autofocus>
                    @error('username')

                    <span style="color: #e3342f; font-size: 14px; padding-left: 12px">{{ $message }}</span>

                    @enderror
                </div>
            </div>

            <div class="register-form-row">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <input type="radio" id="male" name="gender" {{ old('gender') == 0 ? 'checked' : ''}} value="0">
                        <label for="male" class="radio-text ml-1 mt-1">Mashkull</label>
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <input type="radio"  id="female" {{ old('gender') == 1 ? 'checked' : ''}} name="gender" value="1">
                        <label for="female" class="radio-text ml-1 mt-1">Femër</label>
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <input type="radio" id="other" {{ old('gender') == 2 ? 'checked' : ''}} name="gender" value="2">
                        <label for="other" class="radio-text ml-1 mt-1">Tjetër</label>
                    </div>
                </div>
            </div>

            <div class="register-form-row">
                <label for="email" class="register-form-label">Email adresa</label>
                <div>
                    <input type="email" name="email" id="email" class="register-form-input" value="{{ old('email') }}" required autocomplete="off">
                    @error('email')

                    <span style="color: #e3342f; font-size: 14px; padding-left: 12px">{{ $message }}</span>

                    @enderror
                </div>
            </div>

            <div class="register-form-row">
                <label for="city_id" class="register-form-label">Qyteti</label>
                <div>
                    <input type="text" id="city_id" class="register-form-input" name="city" value="{{ old('city') }}" required autocomplete="city">
                    <input type="hidden" id="id_city" name="city_id" value="{{old('city_id')}}">
                    @error('city')

                    <span style="color: #e3342f; font-size: 14px; padding-left: 12px">{{ $message }}</span>

                    @enderror
                </div>
            </div>

            <div class="register-form-row">
                <label for="university_id" class="register-form-label">Universiteti</label>
                <div>
                    <input type="text" id="university_id" class="register-form-input" name="university" value="{{ old('university') }}" required autocomplete="university">
                    <input type="hidden" id="id_university" name="university_id" value="{{old('university_id')}}">
                    @error('university')

                    <span style="color: #e3342f; font-size: 14px; padding-left: 12px">{{ $message }}</span>

                    @enderror
                </div>
            </div>

            <div class="register-form-row">
                <div class="password">
                    <label for="password" class="register-form-label" data-toggle="tooltip" data-placement="bottom"
                           value="Fjalëkalimi duhet të jetë se paku 8 karaktere i gjatë.">Fjalëkalimi
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20"
                             fill="#006fa5" class="register-form-info-icon">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                  clip-rule="evenodd" />
                        </svg>
                    </label>
                </div>

                <div>
                    <input type="password" name="password" id="password" class="register-form-input" required autocomplete="new-password">
                </div>
            </div>

            <div class="register-form-row">
                <div class="recheck-password">
                    <label for="recheck-password" class="register-form-label" data-toggle="tooltip"
                           data-placement="bottom" value="Fjalëkalimet duhen të përshtaten">Rishkruaj fjalëkalimin
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20"
                             fill="#006fa5" class="register-form-info-icon">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                  clip-rule="evenodd" />
                        </svg>
                    </label>
                </div>

                <div>
                    <input type="password" name="password_confirmation" id="recheck-password" class="register-form-input" required autocomplete="new-password">
                    @error('password')

                    <span style="color: #e3342f; font-size: 14px; padding-left: 12px">{{ $message }}</span>

                    @enderror
                </div>
            </div>


            <div class="form-buttons">
                <div class="login-now-button btn">
                    <a href="{{route('login')}}">
                        <h6>Kam llogari</h6>
                    </a>
                </div>
                <button class="register-now-button btn" type="submit">
                    <h6>Regjistrohu</h6>
                </button>
            </div>

        </form>



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
                $('#id_university').val(ui.item.id);
                return false;
            }
        });
        $('#city_id').autocomplete({
            source:'{!!URL::route('user.city.autocomplete')!!}',
            minlength:1,
            autoFocus:true,
            select:function(e,ui)
            {
                $('#city_id').val(ui.item.value);
                $('#id_city').val(ui.item.id);
                return false;
            }
        });


    </script>
    @endsection

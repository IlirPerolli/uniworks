@extends('layouts.index')

@section('title')
    <title>Krijo postim</title>
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

        .bootstrap-tagsinput{
            width: 100% !important;
            border-radius: 10px!important;
            /* background-color: #f4f4f4; */
            border: 3px solid #f4f4f4!important;
            outline: none!important;
            -webkit-box-shadow: 0px 15px 50px -15px rgba(233,233,233,0.9)!important;
            box-shadow: 0px 15px 50px -15px rgba(233,233,233,0.9)!important;
            padding-left:10px;
            text-indent: 5px;


        }
        .label-info{
            background-color: #eee;

        }
        .bootstrap-tagsinput .tag{
            color:black;
        }
        .bootstrap-tagsinput .label {
            display: inline-block;
            padding: 1em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            margin-top: 10px;
        }
    </style>
@endsection
@section('imports')
    <!-- Taggable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>
    <!-- End of Taggable -->
@endsection
@section('content')

    <!-- Add Article -->
    <div class="container">
        <div class="row" id="title-row">
            <div class="col">
                <h1>Krijo një artikull</h1>
            </div>
        </div>
        @if(session()->has('added_post'))
            <div class="alert alert-success" role="alert">
                {{session('added_post')}}
            </div>
        @endif
        <div class="row" id="content-row">
            <form id="add-article-form" action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id1" name="id[]">
                <input type="hidden" id="id2" name="id[]">
                <input type="hidden" id="id3" name="id[]">
                <input type="hidden" id="id4" name="id[]">


                <div class="form-group">
                    <label for="title">Titulli</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Titulli i artikullit" autocomplete="off">
                </div>
                @error('title')
                <span style="color:red">{{ $message }}</span>
                <br>
                @enderror

               <div style="margin-bottom: -50px; margin-top: 30px">Autoret</div>
                <div class="form-row">

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="author1"></label>
                            <input type="text" class="form-control" name="author[]" id="author1" placeholder="Shtoni autore">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="author2"></label>
                            <input type="text" class="form-control" name="author[]" id="author2" placeholder="Shtoni autore">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="author3"></label>
                            <input type="text" class="form-control" name="author[]" id="author3" placeholder="Shtoni autore">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="author4"></label>
                            <input type="text" class="form-control" name="author[]" id="author4" placeholder="Shtoni autore">
                        </div>
                    </div>


                </div>
                @if(session()->has('duplicate_username'))
                    <br>
                    <div class="alert alert-danger" role="alert">
                        {{session('duplicate_username')}}
                    </div>
                @endif

                @if(session()->has('user_error'))
                    <br>
                    <div class="alert alert-danger" role="alert">
                        {{session('user_error')}}
                    </div>
                @endif

                <div class="form-group">
                    <label for="abstract">Abstrakti</label>
                    <textarea class="form-control" id="abstract" name="abstract" rows="3"
                              placeholder="Shkruani abstraktin e artikullit...">{{old('abstract')}}</textarea>
                    @error('abstract')
                    <span style="color:red">{{ $message }}</span>
                    @enderror

                </div>

{{--                @error('author.*')--}}
{{--                <span style="color:red">{{ $message }}</span>--}}
{{--                @enderror--}}
                <div class="form-group">
                    <label for="resource">Burimi</label>
                    <input type="text" class="form-control" id="resource" value="{{ old('resource') }}" name="resource" placeholder="Burimi i artikullit" autocomplete="off">
                    @error('resource')
                    <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="resource">Viti</label>
                    <input type="number" min="1900" max="2021" class="form-control" id="year" value="{{ old('year') }}" name="year" placeholder="Viti i publikimit" autocomplete="off">
                    @error('year')
                    <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="category">Kategoria</label>
                                <select class="form-control" name="category_id" id="category">
                                    <option value="">Zgjedh kategorine</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span style="color:red">{{ $message }}</span>
                                @enderror
                                @if(session()->has('category_error'))
                                    <span style="color:red">{{session('category_error')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                                <div class="form-group" id="upload-article">
                                    <label for="upload">Ngarko artikullin</label>
                                    <div style="width: 100%;  word-break: break-all">
                                    <div class='file-input' style="border:1px solid #ced4da;">

                                        <input type='file' name="file_id">
                                        <span class='button' style="font-size: 14px; border-radius: 10px">Zgjedh</span>

                                            <span class='label' data-js-label >Zgjedhni artikullin...</span>
                                            </div>

                                    </div></div>
                            @error('file_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>

    <div class="form-group">
                    <label>Fjalët kyçe: </label>
                    <input type="text" data-role="tagsinput" name="tags" class="form-control"  value="{{ old('tags') }}" >
    </div>
            <button class="post-article-btn btn">
                <a href="#">
                    <h6>Posto</h6>
                </a>
            </button>
    </form>
        </div>
    </div>



@endsection


@section('scripts')

<script type="text/javascript">


    $('#author1').autocomplete({
        source:'{!!URL::route('autocomplete')!!}',
        minlength:1,
        autoFocus:true,
        select:function(e,ui)
        {
            $('#author1').val(ui.item.value);
            $('#id1').val(ui.item.id);
            return false;
        }
    });
    $('#author2').autocomplete({
        source:'{!!URL::route('autocomplete')!!}',
        minlength:1,
        autoFocus:true,
        select:function(e,ui)
        {
            $('#author2').val(ui.item.value);
            $('#id2').val(ui.item.id);
        }
    });
    $('#author3').autocomplete({
        source:'{!!URL::route('autocomplete')!!}',
        minlength:1,
        autoFocus:true,
        select:function(e,ui)
        {
            $('#author3').val(ui.item.value);
            $('#id3').val(ui.item.id);
        }
    });
    $('#author4').autocomplete({
        source:'{!!URL::route('autocomplete')!!}',
        minlength:1,
        autoFocus:true,
        select:function(e,ui)
        {
            $('#author4').val(ui.item.value);
            $('#id4').val(ui.item.id);
        }
    });
    $("#author1").data("ui-autocomplete")._renderItem = function (ul, item) {
        // return $('<li/>', {'data-value': item.value}).append($('<a/>', {href: "#"})
        return $('<li/>', {'data-value': item.value}).append($('<a/>')
            .append($('<img/>', {style:'margin-right:10px; border-radius:50%',width:50,height:50, src: '/images/'+item.photo})).append(item.value))
            .appendTo(ul);
    };
    $("#author2").data("ui-autocomplete")._renderItem = function (ul, item) {
        return $('<li/>', {'data-value': item.value}).append($('<a/>')
            .append($('<img/>', {style:'margin-right:10px; border-radius:50%',width:50,height:50,src: '/images/'+item.photo})).append(item.value))
            .appendTo(ul);
    };
    $("#author3").data("ui-autocomplete")._renderItem = function (ul, item) {
        return $('<li/>', {'data-value': item.value}).append($('<a/>')
            .append($('<img/>', {style:'margin-right:10px; border-radius:50%',width:50,height:50,src: '/images/'+item.photo})).append(item.value))
            .appendTo(ul);
    };
    $("#author4").data("ui-autocomplete")._renderItem = function (ul, item) {
        return $('<li/>', {'data-value': item.value}).append($('<a/>')
            .append($('<img/>', {style:'margin-right:10px; border-radius:50%',width:50,height:50,src: '/images/'+item.photo})).append(item.value))
            .appendTo(ul);
    };

</script>
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

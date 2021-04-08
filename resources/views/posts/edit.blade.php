@extends('layouts.index')

@section('title')
    <title>Edito postimin</title>
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

    <!-- Add Article -->
    <div class="container">
        <div class="row" id="title-row">
            <div class="col">
                <h1>Ndrysho postimin</h1>
            </div>
        </div>
        @if(session()->has('updated_post'))
            <div class="alert alert-success" role="alert">
                {{session('updated_post')}}
            </div>
        @endif
        <div class="row" id="content-row">
            <form id="add-article-form" action="{{route('post.update',$post->slug)}}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" id="id1" name="id[]">
                <input type="hidden" id="id2" name="id[]">
                <input type="hidden" id="id3" name="id[]">
                <input type="hidden" id="id4" name="id[]">


                <div class="form-group">
                    <label for="title">Titulli</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}" placeholder="Titulli i artikullit" autocomplete="off">
                </div>
                @error('title')
                <span style="color:red">{{ $message }}</span>
                <br>
                @enderror

                <div style="margin-bottom: -20px; margin-top: 10px">Autoret ({{$post_user_count}}/5)</div>
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
                <br>
                @if(session()->has('user_error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('user_error')}}
                    </div>
                @endif
                @if(session()->has('duplicate_username'))
                    <div class="alert alert-danger" role="alert">
                        {{session('duplicate_username')}}
                    </div>
                @endif

                <div class="form-group">
                    <label for="abstract">Abstrakti</label>
                    <textarea class="form-control" id="abstract" name="abstract" rows="3"
                              placeholder="Shkruani abstraktin e artikullit...">{{$post->abstract}}</textarea>
                    @error('abstract')
                    <span style="color:red">{{ $message }}</span>
                    @enderror

                </div>

                {{--                @error('author.*')--}}
                {{--                <span style="color:red">{{ $message }}</span>--}}
                {{--                @enderror--}}
                <div class="form-group">
                    <label for="resource">Burimi</label>
                    <input type="text" class="form-control" id="resource" value="{{ $post->resource }}" name="resource" placeholder="Burimi i artikullit" autocomplete="off">
                    @error('resource')
                    <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="resource">Viti</label>
                    <input type="number" min="1900" max="2021" class="form-control" id="year" value="{{$post->year}}" name="year" placeholder="Viti i publikimit" autocomplete="off">
                    @error('year')
                    <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="category">Kategoria</label>
                            <select class="form-control" name="category_id" id="category">
                                <option value="">Zgjedh kategorine</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ $post->category_id == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
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

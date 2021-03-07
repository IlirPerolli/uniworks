@extends('layouts.index')

@section('title')
    <title>Krijo postim</title>
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
                @enderror

                <div class="form-group">
                    <label for="abstract">Abstrakti</label>
                    <textarea class="form-control" id="abstract" name="abstract" rows="1"
                              placeholder="Shkruani abstraktin e artikullit...">{{old('abstract')}}</textarea>
                </div>
                @error('abstract')
                <span style="color:red">{{ $message }}</span>
                @enderror
                <br>
                <span> Autoret </span>
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
                    <div class="alert alert-danger" role="alert">
                        {{session('duplicate_username')}}
                    </div>
                @endif
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
                                    <input type="file" name="file_id" class="form-control-file" id="upload">
                                </div>
                            @error('file_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror

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

</script>
@endsection

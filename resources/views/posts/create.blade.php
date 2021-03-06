@extends('layouts.index')
@section('content')

    <!-- Add Article -->
    <div class="container">
        <div class="row" id="title-row">
            <div class="col">
                <h1>Krijo një artikull</h1>
            </div>
        </div>
        <div class="row" id="content-row">
            <form id="add-article-form" action="{{route('post.store')}}" method="POST">
                @csrf
                <input type="hidden" id="username1" name="username[]">
                <input type="hidden" id="username2" name="username[]">
                <input type="hidden" id="username3" name="username[]">
                <input type="hidden" id="username4" name="username[]">


                <div class="form-group">
                    <label for="title">Titulli</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titulli i artikullit" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="abstract">Abstrakti</label>
                    <textarea class="form-control" id="abstract" name="abstract" rows="1"
                              placeholder="Shkruani abstraktin e artikullit..."></textarea>
                </div><span> Autoret </span>
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


                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="category">Kategoria</label>
                                <select class="form-control" id="category">
                                    <option>Prova</option>
                                    <option>Prova</option>
                                    <option>Prova</option>
                                    <option>Prova</option>
                                    <option>Prova</option>
                                    <option>Prova</option>
                                    <option>Prova</option>
                                    <option>Prova</option>
                                    <option>Prova</option>
                                    <option>Prova</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                                <div class="form-group" id="upload-article">
                                    <label for="upload">Ngarko artikullin</label>
                                    <input type="file" class="form-control-file" id="upload">
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
            $('#author1').val(ui.item.username);
            $('#username1').val(ui.item.username);
        }
    });
    $('#author2').autocomplete({
        source:'{!!URL::route('autocomplete')!!}',
        minlength:1,
        autoFocus:true,
        select:function(e,ui)
        {
            $('#author2').val(ui.item.value);
            $('#username2').val(ui.item.username);
        }
    });
    $('#author3').autocomplete({
        source:'{!!URL::route('autocomplete')!!}',
        minlength:1,
        autoFocus:true,
        select:function(e,ui)
        {
            $('#author3').val(ui.item.value);
            $('#username3').val(ui.item.username);
        }
    });
    $('#author4').autocomplete({
        source:'{!!URL::route('autocomplete')!!}',
        minlength:1,
        autoFocus:true,
        select:function(e,ui)
        {
            $('#author4').val(ui.item.value);
            $('#username4').val(ui.item.username);
        }
    });

</script>
@endsection

@extends('layouts.index')
@section('title')
    <title>Krijo kategori</title>
@endsection
@section('content')

    <!-- Add category -->
    <div class="container">
        <div class="row" id="title-row">
            <div class="col">
                <h1>Krijo një kategori</h1>
            </div>
        </div>
        @if(session()->has('added_category'))
            <div class="alert alert-success" role="alert">
                {{session('added_category')}}
            </div>
        @endif
        <div class="row" id="content-row">
            <form id="add-article-form" action="{{route('category.store')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Titulli</label>
                    <input type="text" class="form-control" id="title" name="name" placeholder="Titulli i kategorise" autocomplete="off">
                </div>
                @error('name')
                <span style="color:red">{{ $message }}</span>
                @enderror

                <button class="post-article-btn btn">
                    <a href="#">
                        <h6>Krijo</h6>
                    </a>
                </button>
            </form>
        </div>
        @if(session()->has('deleted_category'))
            <div class="alert alert-danger mt-4" role="alert">
                {{session('deleted_category')}}
            </div>
        @endif
        <table class="table table-bordered" style="margin-top: 50px">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kategoria</th>
                <th scope="col">Opsionet</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td><a href="{{route('category.show',$category->slug)}}">{{$category->name}}</a></td>
                    <td>
                        <form action="{{route('category.destroy',$category->id)}}" method="post" style="float: right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" style="cursor: pointer">Fshij</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>



@endsection


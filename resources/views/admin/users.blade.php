@extends('layouts.index')
@section('title')
    <title>Përdoruesit</title>
@endsection
@section('content')

    <!-- Add category -->
    <div class="container">
        <div class="row" id="title-row">
            <div class="col">
                <h1>Përdoruesit</h1>
            </div>
        </div>

        <table class="table table-bordered" style="margin-top: 50px">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Përdoruesi</th>
                <th scope="col">Opsionet</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>@if ($user->slug != null)<a href="{{route('user.show',$user->slug)}}">{{$user->name. " ". $user->surname}}</a>@else {{$user->name}}@endif</td>
                    <td>
                        <form action="{{route('admin.users.destroy',$user->id)}}" method="post" style="float: right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" style="cursor: pointer">Fshij</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        @if(isset($users))
            @if(count($users)>0)
                <nav aria-label="Pagination" style="margin-top: 50px">
                    <ul class="pagination justify-content-center">
                        {{$users->links()}}
                    </ul>
                </nav>
            @endif
        @endif
    </div>



@endsection


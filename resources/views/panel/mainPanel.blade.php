@extends('panel.layout')

@section('content')
    <div class="container">
        <a class="btn btn-danger" href="{{url('/logout')}}">Wyloguj</a><br><br>
        <a class="btn btn-primary" href="{{url('/create')}}">Dodaj użytkownika</a><br><br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <form action="{{url('/main',$user->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <a class="btn btn-primary" href="{{url('/edit',$user->id)}}">Edytuj</a>
                            <button class="btn btn-danger" type="submit" title="delete">Usun</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

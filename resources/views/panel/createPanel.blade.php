@extends('panel.layout')

@section('content')
        <div class="container">
            <a class="btn btn-primary" href="{{ url('/main') }}"> Powrot</a><br><br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="{{url('/create')}}" method="post">
                @csrf
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="text" placeholder="imie" name="name"><br><br>
                <input type="email" placeholder="email" name="email"><br><br>
                <input type="password" placeholder="haslo" name="password"><br><br>
                <input type="submit" class="btn btn-primary" value="Dodaj "/>
            </form>
        </div>
@endsection

@extends('panel.layout')

@section('content')
    <div class="container">
        <a class="btn btn-primary" href="{{ url('/main') }}"> Powrot</a><br><br>
        <form action="{{route('panel.edit', $id)}}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="text" placeholder="email" name="email" ><br><br>
            <input type="submit" class="btn btn-primary" value="Uktualizuj"/>
        </form>
    </div>
@endsection

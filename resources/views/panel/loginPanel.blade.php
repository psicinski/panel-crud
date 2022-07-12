@extends('panel.layout')

@section('content')
    <div class="container">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @elseif($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <form action="{{url('/')}}" method="post">
            <div class="form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="email" name="email" class="form-control" placeholder="email" ><br>
                <input type="password" name="password" class="form-control" placeholder="password"><br>
                <div class="d-grid mx-auto">
                    <button type="submit" class="btn btn-primary">Zaloguj</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')

<br/>
    <form action="/hello" method="post">

        <input type="text" name="age">
        <input type="submit" value="Submit">
    </form>

@endsection



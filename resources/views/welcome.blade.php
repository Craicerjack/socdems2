@extends('layouts.app')

@section('content')
<div class="container">
@if (Auth::check())
    <div class="row">
        @if (Auth::user()->isAdmin)
            <h1>user is admin</h1>
        @endif
        <a href=""><div class="col-xs-3 col-xs-offset-1 dash-unit">
            <h2>Account</h2>
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </div></a>
        <a href="/contacts"><div class="col-xs-3 dash-unit">
            <h2>Contact</h2>
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        </div></a>
        <div class="col-xs-3 dash-unit">
            <h2>Walksheet</h2>
            <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3 col-xs-offset-1 dash-unit">
            <h2>Voter</h2>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </div>
        <a href="/upload"><div class="col-xs-3 dash-unit">
            <h2>Uploads</h2>
            <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
        </div></a>
        <a href="/boxes"><div class="col-xs-3 dash-unit">
            <h2>Boxes</h2>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </div></a>
    </div>
</div>
@else
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 ">
            <h2>Please Log In.</h2>
        </div>
    </div>
@endif

@endsection

@extends('layouts.app')

@section('content')

<div class="container">
    @foreach ($streets as $street)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $street["street"] }}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-2"><h4>House</h4></div>
                <div class="col-xs-10"><h4>Results - Support Lvl</h4></div>
            </div>
            @foreach ($street["houses"] as $house)
            <div class="row striped">
                <div class="col-xs-2">{{ $house["house"] }}</div>
                @foreach ($house["contacts"] as $contact)
                    <div class="col-xs-1">
                        {{$contact->result}} - {{$contact->support_lvl}}
                    </div>
                @endforeach

            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection
@section('scripts')

    <!-- TODO: Current Tasks -->
@endsection

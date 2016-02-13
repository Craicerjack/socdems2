@extends('layouts.app')

@section('content')

<div class="container">
    @foreach ($streets as $street)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $street["street"] }}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th>House Name</th>
                    <th>Results</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($street["houses"] as $house)
                    <tr>
                        <td>{{ $house }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>
@endsection
@section('scripts')

    <!-- TODO: Current Tasks -->
@endsection

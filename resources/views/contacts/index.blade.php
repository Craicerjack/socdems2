@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <a href="{{ url('/contacts/add') }}" class=" col-md-4 col-md-offset-4 btn btn-info">Add a Contact</a>
        <br/>
        <br/>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (count($contacts) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">Contacts</div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th class="theaders">Date</th>
                                <th class="theaders">Volunteer</th>
                                <th class="theaders">Address</th>
                                <th class="theaders">Result</th>
                                <th class="theaders">Support Level</th>
                                <th class="theaders">Notes</th>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->date }}</td>
                                        <td>{{ $contact['user']['first_name'] }} {{ $contact['user']['last_name'] }} </td>
                                        <td>{{ $contact['address']['address_no'] }} {{ $contact['address']['address_st'] }}</td>
                                        <td>{{ $contact['result'] }}</td>
                                        <td>{{ $contact['support_lvl'] }}</td>
                                        <td>{{ $contact['notes'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


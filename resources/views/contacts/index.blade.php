@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('/contacts/add') }}" class="btn btn-info">Add</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Contacts</div>

                <!-- Current Tasks -->
                @if (count($contacts) > 0)
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
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Contact</h2>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/contacts') }}">
                {!! csrf_field() !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Contact Basic</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Choose User:</label>
                            <div class="col-md-6">
                                <select id="user-list" class="form-control" name='user_id'>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" >{{ $user['first_name'] }} {{ $user['last_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Choose Area:</label>
                            <div class="col-md-6">
                                <select id="address-list-1" class="form-control" name="address">
                                    @foreach ($locale as $loc)
                                        <option value="{{ $loc }}" >{{ $loc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="date" value="{{ $sesh['date'] }}">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Contact Specific</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Choose Address:</label>
                            <div class="col-md-6">
                                <select id="address-list-2" class="form-control" name="address">
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Result</label>
                            <div class="col-md-6">
                                <select class="form-control" name="result">
                                    <option value="NI">Not In</option>
                                    <option value="SC" selected="selected">Short Chat</option>
                                    <option value="LC">Long Chat</option>
                                    <option value="NV">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Support Level</label>
                            <div class="col-md-6">
                                <select class="form-control" name="support_lvl">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3" selected="selected">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Notes</label>
                            <div class="col-md-6">
                            <textarea rows="10" class="form-control" name="notes" placeholder="Notes..."></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-user"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/contact.js') }}"></script>
    <!-- TODO: Current Tasks -->
@endsection

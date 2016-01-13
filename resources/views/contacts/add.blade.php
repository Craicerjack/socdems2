@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contact</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/contacts') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Pick User:</label>
                            <div class="col-md-6">
                                <select class="form-control" name='user_id'>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" >{{ $user['first_name'] }} {{ $user['last_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Pick Address:</label>
                            <div class="col-md-6">
                                <select id="address-list" class="form-control" name="address">
                                    @foreach ($addresses as $address)
                                        {{ $new_ad = $address['address_st'].", ".$address['address_no'] }}
                                        <option value="{{ $address->id }}" >{{ $new_ad }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="date" value="{{ old('date') }}">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $('#address-list').select2();
</script>
    <!-- TODO: Current Tasks -->
@endsection

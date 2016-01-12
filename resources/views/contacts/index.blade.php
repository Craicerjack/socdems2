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

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('result') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Result</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="result" value="{{ old('result') }}">
                                @if ($errors->has('result'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('result') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('support_lvl') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Support Level</label>

                            <div class="col-md-6">
                                <input type="support_lvl" class="form-control" name="support_lvl" value="{{ old('support_lvl') }}">

                                @if ($errors->has('support_lvl'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('support_lvl') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Notes</label>

                            <div class="col-md-6">
                            <textarea rows="3" cols="20" class="form-control" name="notes">Notes...</textarea>:
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Current Tasks -->
    @if (count($contacts) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">Contacts</div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead><th>Contact</th><th>&nbsp;</th></thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="table-text"><div>{{ $contact->name }}</div></td>
                                <td>
                                    <form action="/box/{{ $contact->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button>Delete Box</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


</div>

    <!-- TODO: Current Tasks -->
@endsection
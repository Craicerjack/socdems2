@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Walksheets</h2>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/walksheets') }}">
                {!! csrf_field() !!}

                <div class="panel panel-default">

                    <div class="panel-heading">Support Level</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2 col-sm-offset-1">
                                    <input type="checkbox" id="support1" name="support1" value="1">
                                    <label for="support1"> 1 </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" id="support2" name="support2" value="2">
                                    <label for="support2"> 2 </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" id="support3" name="support3" value="3">
                                    <label for="support3"> 3 </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" id="support4" name="support4" value="4">
                                    <label for="support4"> 4 </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" id="support5" name="support5" value="5">
                                    <label for="support5"> 5 </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 col-sm-offset-3">
                                    <input type="checkbox" id="supportNI" name="supportNI" value="NI">
                                    <label for="supportNI"> NI </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="supportNC" name="supportNC" value="NC">
                                    <label for="supportNC"> NC </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-heading">Voting Rights</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3 col-sm-offset-1">
                                    <input type="checkbox" id="vrP" name="vrP" value="P">
                                    <label for="vrP"> P </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="vrD" name="vrD" value="D">
                                    <label for="vrD"> D </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="vrL" name="vrL" value="L">
                                    <label for="vrL"> L </label>
                                </div>
                            </div>
                            <div>
                                <div class="col-sm-3 col-sm-offset-1">
                                    <input type="checkbox" id="vrA" name="vrA" value="A">
                                    <label for="vrA"> A </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="vrPS" name="vrPS" value="PS">
                                    <label for="vrPS"> PS </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="vrTS" name="vrTS" value="TS">
                                    <label for="vrTS"> TS </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-heading">Choose Area</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-sm-4 col-sm-offset-1 control-label">Choose Electoral Area:</label>
                            <div class="col-sm-6">
                                <select id="address-list-0" class="form-control" name="area">
                                    @foreach ($electDivs as $ediv)
                                        <option value="{{ $ediv }}" >{{ $ediv }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 col-sm-offset-1 control-label">Choose Area:</label>
                            <div class="col-sm-6">
                                <select id="address-list-1" class="form-control" name="address"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 col-sm-offset-1 control-label">Choose Street:</label>
                            <div class="col-sm-6">
                                <select id="address-list-2" class="form-control" name="street"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 col-sm-offset-1 control-label">Streets:</label>
                            <div class="col-sm-6">
                                <fieldset disabled>
                                    <ul id="picks" name="picks" class="list-group">

                                    </ul>
                                </fieldset>
                            </div>
                        </div>

                    </div>

                </div>
                <button type="submit" class="btn btn-info" id="generate">Generate Walksheet</button>
            </form>
        </div>
    </div>
</div>
<div>
<br/>
<br/>
<br/>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/walksheet.js') }}"></script>

    <!-- TODO: Current Tasks -->
@endsection

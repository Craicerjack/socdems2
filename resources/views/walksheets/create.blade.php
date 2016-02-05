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
                                    <input type="checkbox" id="support1" aria-label="">
                                    <label for="support1"> 1 </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" id="support2" aria-label="...">
                                    <label for="support2"> 2 </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" id="support3" aria-label="...">
                                    <label for="support3"> 3 </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" id="support4" aria-label="...">
                                    <label for="support4"> 4 </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" id="support5" aria-label="...">
                                    <label for="support5"> 5 </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 col-sm-offset-3">
                                    <input type="checkbox" id="supportNI" aria-label="...">
                                    <label for="supportNI"> NI </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="supportNC" aria-label="...">
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
                                    <input type="checkbox" id="vrP" aria-label="">
                                    <label for="vrP"> P </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="vrD" aria-label="...">
                                    <label for="vrD"> D </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="vrL" aria-label="...">
                                    <label for="vrL"> L </label>
                                </div>
                            </div>
                            <div>
                                <div class="col-sm-3 col-sm-offset-1">
                                    <input type="checkbox" id="vrA" aria-label="...">
                                    <label for="vrA"> A </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="vrPS" aria-label="...">
                                    <label for="vrPS"> PS </label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="checkbox" id="vrTS" aria-label="...">
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
                                <select id="address-list-0" class="form-control" name="address">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 col-sm-offset-1 control-label">Choose Area:</label>
                            <div class="col-sm-6">
                                <select id="address-list-1" class="form-control" name="address">

                                </select>
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

    <!-- TODO: Current Tasks -->
@endsection

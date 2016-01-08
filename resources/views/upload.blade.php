@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Upload</div>
                <div class="panel-body">
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" name="upload" action="{{ url('/upload') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <div class="col-md-6">
                                <input id="upload-file" type="file" name="userfile"/>
                            </div>
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary" id="upload-button">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
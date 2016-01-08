@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="/boxes" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group">
                <label for="box" class="col-sm-3 control-label">Box Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="box-name" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Box
                    </button>
                </div>
            </div>
        </form>


        <!-- Current Tasks -->
        @if (count($boxes) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">Boxes</div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <!-- Table Headings -->
                        <thead><th>Box</th><th>&nbsp;</th></thead>
                        <!-- Table Body -->
                        <tbody>

                            @foreach ($boxes as $box)
                                <tr>
                                    <td class="table-text"><div>{{ $box->name }}</div></td>
                                    <!-- Delete Button -->
                                    <td>
                                        <form action="/box/{{ $box->id }}" method="POST">
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
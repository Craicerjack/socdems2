@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        @if (Auth::user()->isAdmin)
        <!-- New Task Form -->
        <form action="{{ url('/boxes') }}" method="POST" class="form-horizontal">
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
        @endif


        <!-- Current Tasks -->
        @if (count($boxes) > 0)
            <div class="col-sm-8 col-sm-offset-2">
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
                                        @if (Auth::user()->isAdmin)
                                        <!-- Delete Button -->
                                        <td>
                                            <form action="{{ URL::to('/box').'/'.$box->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button>Delete Box</button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <!-- TODO: Current Tasks -->
@endsection
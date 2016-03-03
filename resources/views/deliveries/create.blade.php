

<!-- resources/views/deliveries/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">
        <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
             <div class="panel-heading">Add Delivery</div>
            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/delivery') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Reference Number: </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="reference" value="{{ old('reference') }}">

                                @if ($errors->has('reference'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reference') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Description: </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Size: </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="size" value="{{ old('size') }}">

                                @if ($errors->has('size'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Weight: </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="weight" value="{{ old('weight') }}">

                                @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i>Add Package
                                </button>
                            </div>
                        </div>




                    <table class="table table-striped delivery-table {{ $errors->has('user_id') ? ' has-error' : '' }}">

                                <!-- Table Headings -->
                                <thead>
                                     <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Choose</th>
                                </thead>


                                <!-- Table Body -->
                                <tbody>

                    @foreach ($users as $user)

                            <tr class="{{ $errors->has('user_id') ? ' danger' : '' }}">
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $user->firstName }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $user->lastName }}</div>
                                </td>

                                <td class="table-text">
                                    <input type="radio" name="user_id" value="{{ $user->id }}" />
                                </td>



                            </tr>

                    @endforeach
                      </tbody>
                    </table>
                </form>
            </div>
        </div>
        </div>
        </div>
    </div>


@endsection
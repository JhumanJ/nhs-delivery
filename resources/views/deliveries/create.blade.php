

<!-- resources/views/deliveries/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="outer">
        <div class="con">
             <div class="usertitle head" style="margin-left:20px">Add Delivery</div>
             <div class="text2">
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


                    <form id="user-search" class="form-horizontal" role="form" method="POST" action="{{ url('/delivery') }}">
                        <label class="col-md-4 control-label">Search for User: </label>
                        <div class="input-group col-md-6">
                          <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-user"></i></span>
                          <input type="text" id="input-search" class="form-control" placeholder="First name, last name, department..." aria-describedby="sizing-addon2">
                        </div>
                    </form>

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

    <script>

    $( document ).ready(function() {
        console.log('ok');

        $('#input-search').on('input',function(){
            //$('#user-search').submit();
           console.log("ok");
        });

        //Script for the user search
        $('#user-search').submit(function( event ) {
            event.preventDefault();
            $.ajax({
                url: 'http://localhost:8888/myAjaxCallURI',
                type: 'post',
                data: $('form').serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
                success: function( _response ){
                    // Handle your response..
                },
                error: function( _response ){
                    // Handle error
                }
            });
        });
    });



    </script>
@endsection

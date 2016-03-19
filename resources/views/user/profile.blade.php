@extends('layouts.app')

@section('content')

        <!-- Edit profile modal-->
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalTitle">Edit Profile </h4>
                </div>

                <div class="modal-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile') }}">

                        @include('common.errors')

                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="firstName" value="{{ $user->firstName }}">

                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="lastName" value="{{ $user->lastName }}">

                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('primaryLocation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Primary Location</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="primaryLocation" value="{{ $user->primaryLocation }}">

                                @if ($errors->has('primaryLocation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('primaryLocation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="department" value="{{ $user->department }}">

                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Update Profile
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">My Profile</div>

                    <div class="panel-body">
                        <div class="col-md-6 col-md-offset-3">
                            <div><div class="col-md-6">First Name:</div><div class="col-md-6">{{$user->firstName}}</div></div>
                            <div><div class="col-md-6">Last Name:</div><div class="col-md-6">{{$user->lastName}}</div></div>
                            <div><div class="col-md-6">Primary Location:</div><div class="col-md-6">{{$user->primaryLocation}}</div></div>
                            <div><div class="col-md-6">Department:</div><div class="col-md-6">{{$user->department}}</div></div>
                            <div><div class="col-md-6">Email:</div><div class="col-md-6">{{$user->email}}</div></div>
                            <div><div class="col-md-6">Phone:</div><div class="col-md-6">{{$user->phone}}</div></div>
                            <button class="btn btn-primary center-block btn-sm" data-toggle="modal" data-target="#profileModal">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')

@if (Auth::guest())
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        Welcome to NHS Delivery Tracker!
                    </div>
                </div>
            </div>
        </div>
    </div>
@else

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome {{ Auth::user()->name }}</div>

                    <div class="panel-body">
                        From here you can check your deliveries.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@endsection

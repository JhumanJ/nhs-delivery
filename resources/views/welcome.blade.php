@extends('layouts.app')

@section('content')

@if (Auth::guest())
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        Your Application's Landing Page.
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
                        Your Application's Logged Page. From there you can check your deliveries, or check your profile.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@endsection

@extends('layouts.app')

@section('content')


@if (Auth::guest())
<div class="outer">
<div class="con">

<div class="usertitle head">


                    Welcome

                    </div>


                        <div class="text2">

                    <div class="panel-body">
                        Your Application's Landing Page.

</div>

                    </div>
                </div>
            </div>

@else


<div class="outer">
<div class="con">
  <div class="usertitle head">


                    Welcome {{ Auth::user()->name }}
</div>

  <div class="text2">

                    <div class="panel-body">
                        Your Application's Logged Page. From there you can check your deliveries, or check your profile.
                    </div>
                </div>
            </div>

@endif

@endsection

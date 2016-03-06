

<!-- resources/views/deliveries/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        @if (count($awaiting_deliveries) > 0)
            <div class="outer">
                <div class="con">
                     <div class="usertitle head"><i class="fa fa-clock-o"></i> Awaiting Deliveries</div>


                <div class="text2">
                    <table class="table table-striped delivery-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Size</th>
                         <th>Weight</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($awaiting_deliveries as $delivery)
                            @if($delivery->status==1)
                                <tr>
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <div>{{ $delivery->reference }}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>{{ $delivery->description }}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>{{ $delivery->size }}</div>
                                    </td>

                                     <td class="table-text">
                                        <div>{{ $delivery->weight }}</div>
                                    </td>


                                </tr>
                                @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
</div>
                </div>
                @endif

                 @if (count($past_deliveries) > 0)
                 <div class="outer">
                <div class="con">
                    <div class="usertitle head"> <i class="fa fa-check-circle"></i> Past Deliveries</div>

                <div class="text2">
                    <table class="table table-striped delivery-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Weight</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($past_deliveries as $delivery)
                            @if($delivery->status==2)
                                <tr>
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <div>{{ $delivery->reference }}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>{{ $delivery->description }}</div>
                                    </td>

                                     <td class="table-text">
                                        <div>{{ $delivery->size }}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>{{ $delivery->weight }}</div>
                                    </td>


                                </tr>
                                @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

                </div>
                </div>
                </div>
</div>

         @else
            @if (count($awaiting_deliveries) < 1)
            <div class="outer">
                <div class="con">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">

                            <div class="text2">
                                You don't have any deliveries, either past or awaiting.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             @endif
         @endif
@endsection

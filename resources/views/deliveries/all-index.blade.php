

<!-- resources/views/deliveries/all-index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">


              <!-- Display Validation Errors -->
        @include('common.errors')

        @if (count($awaiting_deliveries) > 0)
        <div class="outer">
        <div class="con">
                <div class="usertitle head">
                     <i class="fa fa-clock-o"></i> Awaiting Deliveries
                </div>
                <div class="text2">
                    <table class="table table-striped delivery-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Size</th>
                         <th>Weight</th>
                         <th >Destinate to</th>
                         <th class="text-center">Edit</th>
                         <th class="text-center">Mark as Collected</th>
                         <th class="text-center">Cancel</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($awaiting_deliveries as $delivery)

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

                                    <td class="table-text">
                                        {{ $delivery->firstName.' '.$delivery->lastName }}
                                    </td>

                                     <td class="table-text">
                                        <button type="button" class="btn btn-primary btn-sm center-block"><i class="fa fa-pencil"></i> Edit</button>
                                    </td>

                                     <td class="table-text">
                                        <button type="button" class="btn btn-warning btn-sm center-block"><i class="fa fa-archive"></i> Collect</button>
                                    </td>

                                     <td class="table-text">
                                        <button type="button" class="btn btn-danger btn-sm center-block"><i class="fa fa-times"></i> Cancel</button>
                                    </td>


                                </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
</div></div>

                @endif

                 @if (count($past_deliveries) > 0)
                 <div class="outer">
                 <div class="con">
                <div class="usertitle head">
                     <i class="fa fa-check-circle"></i> Past Deliveries
                </div>

                <div class="text2">
                    <table class="table table-striped delivery-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Weight</th>
                        <th>Destinate to</th>

                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($past_deliveries as $delivery)

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

                                    <td class="table-text">
                                        {{ $delivery->firstName.' '.$delivery->lastName }}
                                    </td>



                                </tr>

                        @endforeach
                        </tbody>
                    </table>
              
                </div>
              </div></div>

             @endif


            @if (Auth::user()->isAdmin())
                @if (count($cancelled_deliveries) > 0)

                <div class="outer">
                <div class="con">
                <div class="usertitle head">
                     <i class="fa fa-times-circle-o"></i> Cancelled Deliveries
                </div>

                <div class="text2">
                    <table class="table table-striped delivery-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Weight</th>
                        <th>Destinate to</th>
                       <th class="text-center">Delete</th>

                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($cancelled_deliveries as $delivery)

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

                                    <td class="table-text">
                                        {{ $delivery->firstName.' '.$delivery->lastName }}
                                    </td>

                                    <td class="table-text">
                                        <button type="button" class="btn btn-danger btn-sm center-block"><i class="fa fa-trash"></i> Delete</button>
                                    </td>


                                </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                </div>
                </div>
              </div></div>

            @endif
         @else
            @if (count($awaiting_deliveries) < 1)
                @if (count($past_deliveries) < 1)
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                There are no deliveries yet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif
         @endif

       </div>
@endsection

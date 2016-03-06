

<!-- resources/views/deliveries/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="row">
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <form id="delivery-search" class="form-horizontal" role="form" method="POST" action="{{ url('/delivery') }}">
                <label class="col-md-4 control-label">Search for delivery: </label>
                <div class="input-group col-md-6">
                  <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-archive"></i></span>
                  <input type="text" id="input-search" class="form-control" placeholder="Reference or description" aria-describedby="sizing-addon2" name="search">
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2">

            <div class="panel-body">


                @if (count($awaiting_deliveries) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <i class="fa fa-clock-o"></i> Awaiting Deliveries
                        </div>

                        <div class="panel-body">
                            @if (count($awaiting_deliveries) > 0)
                            <table class="table table-striped delivery-table">

                                <!-- Table Headings -->
                                <thead>
                                <th>Reference</th>
                                <th>Description</th>
                                <th>Size</th>
                                 <th>Weight</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody id="awaiting-delivery-list">
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
                            @else
                                <div class="awaiting-text">No awatiting deliveries at the moment.</div>
                            @endif
                        </div>

                    </div>




                         <div class="panel panel-default">
                        <div class="panel-heading">
                             <i class="fa fa-check-circle"></i> Past Deliveries
                        </div>

                        <div class="panel-body">
                            @if (count($past_deliveries) > 0)
                            <table class="table table-striped delivery-table">

                                <!-- Table Headings -->
                                <thead>
                                <th>Reference</th>
                                <th>Description</th>
                                <th>Size</th>
                                <th>Weight</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody id="past-delivery-list">
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
                            @else
                                <div>You don't have any past deliveries at the moment.</div>
                            @endif
                        </div>

                        </div>
                        </div>
                        </div>



                 @endif

                 <script>

                    $( document ).ready(function() {



                        $('#input-search').on('input',function(){
                            $search = $('#input-search').val();
                            if ($search == "" || $search == ' '){
                                $search = "all";
                            }

                            console.log('test');

                            $.get('search/delivery/'+$search, function(data){

                                $('#awaiting-delivery-list').empty();
                                $('#past-delivery-list').empty();
                                for (i = 0; i < data.length; i++) {
                                    if (data[i].status ==1){
                                        $('#awaiting-delivery-list').append('<tr><td class="table-text"><div>'+ data[i].reference + '</div></td><td class="table-text"><div>'+ data[i].description +'</div></td><td class="table-text"><div>'+ data[i].size +'</div></td><td class="table-text"><div>'+ data[i].weight +'</div></td></tr>');
                                    }
                                    if(data[i].status ==2){
                                        $('#past-delivery-list').append('<tr><td class="table-text"><div>'+ data[i].reference + '</div></td><td class="table-text"><div>'+ data[i].description +'</div></td><td class="table-text"><div>'+ data[i].size +'</div></td><td class="table-text"><div>'+ data[i].weight +'</div></td></tr>');
                                    }

                                }

                            })

                        });

                    });



    </script>


@endsection
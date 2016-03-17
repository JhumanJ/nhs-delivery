

<!-- resources/views/deliveries/all-index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="row">
    <div class="col-md-8 col-md-offset-2">


        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- Signature modal-->
        <div class="modal fade" id="signatureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalTitle">Collect </h4>
                    </div>

                    <div class="modal-body">
                        <form action="{{ url('collect/') }}" method="POST">
                            {!! csrf_field() !!}


                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- View modal-->
        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalTitle">Delivery </h4>
                </div>
                    <div class="modal-body">

                        <div class="container">

                            <div class="row">
                                <div class="col-md-6 center-block col-sm-12">
                                    <img class="img-thumbnail center-block size150" id="modalPicture" src="#" alt="Delivery Picture" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <strong><p class="col-md-6">Reference: </p></strong>
                                    <p class="col-md-6" id="modalReference"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <strong><p class="col-md-6">Description: </p></strong>
                                    <p class="col-md-6" id="modalDescription"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <strong><p class="col-md-6">Size: </p></strong>
                                    <p class="col-md-6" id="modalSize"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <strong><p class="col-md-6">Weight: </p></strong>
                                    <p class="col-md-6" id="modalWeight"></p>
                                </div>
                            </div>

                        </div>

                    </div>

            </div>
        </div>
    </div>

        <!-- Edit modal-->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Edit Delivery</h4>
              </div>
              <form method="POST" role="form" action="{{ url('/edit') }}">
              <div class="modal-body">
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Reference:</label>
                    <input type="text" class="form-control" name="reference" id="modalReference">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Description:</label>
                    <input type="text" class="form-control" name="description" id="modalDescription">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Size:</label>
                    <input type="text" class="form-control" name="size" id="modalSize">
                  </div>
                    <div class="form-group">
                    <label for="recipient-name" class="control-label">Weight:</label>
                    <input type="text" class="form-control" name="weight" id="modalWeight">
                  </div>

                  <input type="hidden" class="form-control" name="id" id="modalId"></imput>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        @if (count($awaiting_deliveries) == 0 && count($past_deliveries) == 0 && count($cancelled_deliveries) == 0)
                     <div class="panel panel-default">
                        <div class="panel-body">
                        No deliveries yet.
                        </div>
                     </div>
        @endif

        @if (count($awaiting_deliveries) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                     <i class="fa fa-clock-o"></i> Awaiting Deliveries
                </div>

                <div class="panel-body">
                    <table class="table table-striped delivery-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Size</th>
                         <th>Weight</th>
                         <th >Destinate to</th>
                         <th class="text-center">Show</th>
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
                                            <button type="button" class="btn btn-primary btn-sm center-block" data-toggle="modal" data-target="#showModal" data-reference="{{$delivery->reference}}" data-status="{{$delivery->status}}" data-description="{{$delivery->description}}" data-size="{{$delivery->size}}" data-weight="{{$delivery->weight}}" data-src="{{ url('/image/delivery/'.$delivery->deliveryId.'') }}"><i class="fa fa-search"></i> Details</button>
                                    </td>

                                     <td class="table-text">
                                        <button type="button" class="btn btn-primary btn-sm center-block" data-toggle="modal" data-target="#editModal" data-reference="{{$delivery->reference}}" data-description="{{$delivery->description}}" data-size="{{$delivery->size}}" data-weight="{{$delivery->weight}}" data-id="{{$delivery->deliveryId}}"><i class="fa fa-pencil"></i> Edit</button>
                                    </td>

                                     <td class="table-text">

                                             <button type="submit" class="btn btn-warning btn-sm center-block" data-toggle="modal" data-target="#signatureModal"><i class="fa fa-archive"></i> Collect</button>

                                    </td>

                                     <td class="table-text">
                                        <form action="{{ url('cancel/'.$delivery->deliveryId) }}" method="POST">
                                            {!! csrf_field() !!}

                                             <button type="submit" class="btn btn-danger btn-sm center-block"><i class="fa fa-times"></i> Cancel</button>

                                        </form>
                                    </td>


                                </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                </div>
                @endif

                 @if (count($past_deliveries) > 0)
                 <div class="panel panel-default">
                <div class="panel-heading">
                     <i class="fa fa-check-circle"></i> Past Deliveries
                </div>

                <div class="panel-body">
                    <table class="table table-striped delivery-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Weight</th>
                        <th>Destinate to</th>
                        <th class="text-center">Show</th>

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

                                    <td class="table-text">
                                            <button type="button" class="btn btn-primary btn-sm center-block" data-toggle="modal" data-target="#showModal" data-reference="{{$delivery->reference}}" data-status="{{$delivery->status}}" data-description="{{$delivery->description}}" data-size="{{$delivery->size}}" data-weight="{{$delivery->weight}}" data-src="{{ url('/image/delivery/'.$delivery->deliveryId.'') }}"><i class="fa fa-search"></i> Details</button>
                                    </td>



                                </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                </div>



             @endif


            @if (Auth::user()->isAdmin())
                @if (count($cancelled_deliveries) > 0)


                 <div class="panel panel-default">
                <div class="panel-heading">
                     <i class="fa fa-times-circle-o"></i> Cancelled Deliveries
                </div>

                <div class="panel-body">
                    <table class="table table-striped delivery-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Weight</th>
                        <th>Destinate to</th>
                        <th class="text-center">Show</th>
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
                                            <button type="button" class="btn btn-primary btn-sm center-block" data-toggle="modal" data-target="#showModal" data-reference="{{$delivery->reference}}" data-status="{{$delivery->status}}" data-description="{{$delivery->description}}" data-size="{{$delivery->size}}" data-weight="{{$delivery->weight}}" data-src="{{ url('/image/delivery/'.$delivery->deliveryId.'') }}"><i class="fa fa-search"></i> Details</button>
                                    </td>

                                    <td class="table-text">
                                        <form action="{{ url('delete/'.$delivery->deliveryId) }}" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}


                                             <button type="submit" class="btn btn-danger btn-sm center-block"><i class="fa fa-trash"></i> Delete</button>

                                        </form>
                                    </td>


                                </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                </div>
                </div>
                </div>

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

         <script>
            $('#editModal').on('show.bs.modal', function (event) {
                  var button = $(event.relatedTarget); // Button that triggered the modal
                  var recipient = button.data('reference'); // Extract info from data-* attributes
                  var modal = $(this);
                  modal.find('.modal-title').text('Edit Delivery: ' + recipient);
                  modal.find('.modal-body #modalReference').val(recipient);

                  recipient = button.data('description');
                   modal.find('.modal-body #modalDescription').val(recipient);

                   recipient = button.data('size');
                   modal.find('.modal-body #modalSize').val(recipient);

                   recipient = button.data('weight');
                   modal.find('.modal-body #modalWeight').val(recipient);

                   recipient = button.data('id');
                   modal.find('.modal-body #modalId').val(recipient);
            })

            $('#showModal').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget); // Button that triggered the modal
                            var recipient = button.data('reference'); // Extract info from data-* attributes
                            var modal = $(this);
                            if (button.data('status')==1) {
                                modal.find('.modal-title').text('Delivery: ' + recipient);
                            } else {
                                modal.find('.modal-title').text('Past Delivery: ' + recipient);
                            }

                            modal.find('.modal-body #modalReference').text(recipient);

                            recipient = button.data('description');
                            modal.find('.modal-body #modalDescription').text(recipient);

                            recipient = button.data('size');
                            modal.find('.modal-body #modalSize').text(recipient);

                            recipient = button.data('weight');
                            modal.find('.modal-body #modalWeight').text(recipient);

                            recipient = button.data('src');
                            modal.find('.modal-body #modalPicture').attr("src", recipient);

                        })
        </script>

@endsection
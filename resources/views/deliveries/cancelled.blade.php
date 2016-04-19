

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
                        <p class="text-center">Signature: </p>
                        <!--[if lt IE 9]>
                        <script type="text/javascript" src="{!! asset('js/flashcanvas.js') !!}"></script>
                        <![endif]-->
                        <script src="{!! asset('js/jSignature.min.js') !!}"></script>

                        <div id="signature" class="height-250"></div>

                        <button id="clearButton" class="btn btn-warning">Clear</button>
                        <button id="collectButton" class="btn btn-primary">Collect</button>

                        <form id="collectForm" action="{{ url('collect/') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input id="imageForm" type="hidden" name="signature">
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- View active deliveries modal-->
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

    <!-- Show past modal -->

    <div class="modal fade" id="showPastModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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

                            <div class="row">
                                <div class="col-md-6 center-block col-sm-12">
                                    <img class="center-block smaller-signature" id="modalSignature" src="#" alt="Delivery Picture" />
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

        @if (count($cancelled_deliveries) == 0)
                     <div class="panel panel-default">
                        <div class="panel-body">
                        No deliveries yet.
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
                                            <button type="button" class="btn btn-primary btn-sm center-block" data-toggle="modal" data-target="#showModal" data-reference="{{$delivery->reference}}" data-status="{{$delivery->status}}" data-description="{{$delivery->description}}" data-size="{{$delivery->size}}" data-weight="{{$delivery->weight}}" data-src="{{ url('/image/delivery/'.$delivery->deliveryId.'') }}"><i class="fa fa-search-plus"></i> Details</button>
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

                <div style="height:200px;opacity:0.0"></div>
                </div>
                </div>

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

            $('#signatureModal').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget); // Button that triggered the modal
                            var recipient = button.data('reference'); // Extract info from data-* attributes
                            var modal = $(this);

                            modal.find('.modal-title').text('Collect: ' + recipient);

                            recipient = button.data('id');

                            modal.find('.modal-body form').attr("action", modal.find('.modal-body form').attr("action")+'/'+recipient);

                        })

            //------RESET Signature
            $('#clearButton').click(function(){
                $('#signature').jSignature("reset");
            });

            //-------Collect package and save signature

             $('#collectButton').click(function(){
                 $('#imageForm').val($('#signature').jSignature("getData"));
                 $('#collectForm').submit();
            });

            $(document).ready(function() {
                    $('#fileForm').hide();
                    $('#signature').jSignature({ lineWidth: 0, height: 200, width: 550 });

            });

            $('#showPastModal').on('show.bs.modal', function (event) {
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

                            recipient = button.data('srcsignature');
                            modal.find('.modal-body #modalSignature').attr("src", recipient);

                        })
        </script>

@endsection

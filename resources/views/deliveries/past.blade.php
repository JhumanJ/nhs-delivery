

<!-- resources/views/deliveries/all-index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="row">
    <div class="col-md-10 col-md-offset-1">


        <!-- Display Validation Errors -->
        @include('common.errors')


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

      
        @if (count($past_deliveries) == 0)
                     <div class="panel panel-default">
                        <div class="panel-body">
                        No deliveries yet.
                        </div>
                     </div>

         @else

            <div class="marg-20-btm">
                <form id="delivery-search" class="form-horizontal" role="form" method="POST" action="{{ url('/delivery') }}">
                    <label class="col-md-4 control-label search-label"><i class="fa fa-search"></i> SEARCH </label>
                    <div class="input-group col-md-6">
                      <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-archive"></i></span>
                      <input type="text" id="input-search" class="form-control" placeholder="Reference or description" aria-describedby="sizing-addon2" name="search">
                    </div>
                </form>
            </div>

        @endif



                 @if (count($past_deliveries) > 0)
                 <div class="panel panel-default">
                <div class="panel-heading">
                     <i class="fa fa-check-circle"></i> Past Deliveries
                </div>

                <div class="panel-body">
                    <table class="table table-responsive table-condensed table-striped delivery-table">

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
                        <tbody id="past-delivery-list">
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
                                            <button type="button" class="btn btn-primary btn-sm center-block" data-toggle="modal" data-target="#showPastModal" data-reference="{{$delivery->reference}}" data-status="{{$delivery->status}}" data-description="{{$delivery->description}}" data-size="{{$delivery->size}}" data-weight="{{$delivery->weight}}" data-src="{{ url('/image/delivery/'.$delivery->deliveryId.'') }} " data-srcSignature="{{ url('/image/signature/'.$delivery->deliveryId.'') }}"><i class="fa fa-search-plus"></i> Details</button>
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



             @if (Auth::user()->isAdmin())

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





         <script>

            $token = '{!! csrf_field() !!}';
            $deleteMethod = '{!! method_field('DELETE') !!}';


            $('#input-search').on('input',function(){
                $search = $('#input-search').val();
                if ($search == "" || $search == ' '){
                    $search = "all";
                }

                $.get('/search/admin/'+$search, function(data){

                    console.log(data);

                    $('#awaiting-delivery-list').empty();
                    $('#past-delivery-list').empty();
                    $('#cancelled-delivery-list').empty();
                    for (i = 0; i < data.length; i++) {

                        if(data[i].status ==2){
                            $toAppend = '<tr><td class="table-text"><div>'+ data[i].reference + '</div></td><td class="table-text"><div>'+ data[i].description +'</div></td><td class="table-text"><div>'+ data[i].size +'</div></td><td class="table-text"><div>'+ data[i].weight +'</div></td><td><div>'+ data[i].firstName +' '+data[i].lastName + '</div></td>';
                            $toAppend = $toAppend + '<td><button type="button" class="btn btn-primary btn-sm center-block" data-toggle="modal" data-target="#showPastModal" data-reference="'+data[i].reference+'" data-description="'+data[i].description+'" data-size="'+data[i].size+'" data-weight="'+data[i].weight+'" data-src="/image/delivery/'+ data[i].id + '" data-srcsignature="/image/signature/'+data[i].id+' " ><i class="fa fa-search"></i> Details</button>';
                            $toAppend = $toAppend +'</td></tr>';

                            $('#past-delivery-list').append($toAppend);
                        }



                    }

                })

            });

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

@extends('user.layouts.master')


@section('user_content')



   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">
                <div id="messageContainer"></div>

                <div class="col">
                    <div class="card">
                      @if(Session::has('transfer_fund'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
         <svg class="bi flex-shrink-0 me-2" width="24" height="24">
             <use xlink:href="#check-circle-fill" />
         </svg>
         <div>
             {{Session::get('transfer_fund')}}
         </div>
     </div>
     @elseif(Session::has('transfer_error'))
               <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
            <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
            {{Session::get('transfer_error')}}
            </div>
            </div>
     @endif



                    <div class="card-body">
                        <h4 class="card-title">MUSD Transfer History</h4>
                         @if(Auth::user()->status == 0)
                         <button disabled  type="button" class="btn btn-primary float-right">SEND MUSD</button>
                         @else
                        <a class="btn btn-primary float-right" href="#" data-bs-toggle="modal" data-bs-target="#fundtransfer">SEND MUSD</a>
                        @include('user.modals.fundtransfermodal')
                        @endif
                        <hr>
                        <h6>Available MUSD: {{$data['sum_deposit'] ? '$'.number_format((float)$data['sum_deposit'], 2, '.', '') : '$00.00'}}</h6>

                        <hr>
                        <div class="bd-example table-responsive">
                               <table class="table table-bordered table-border">
                                   <thead>
                                       <tr>
                                           <th scope="col">#</th>
                                           <th scope="col">Transfer Date</th>
                                              <th scope="col">MUSD Transfer To</th>
                                                 <th scope="col">Description</th>
                                                    <th scope="col">Type</th>
                                                       <th scope="col">Amount</th>
                                                       <th scope="col">Status</th>



                                       </tr>
                                   </thead>

<!-- Display validation errors -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                                    @foreach($transfer as $row)
                                       <tr>
                                          <td >{{$loop->index+1}}</td>
                                           <td>{{$row->created_at}}</td>
                                           <td>
                                               @if($row->receiver_id != null)
                                              {{$row->receiver->user_name}}
                                              @else 
                                              -- 
                                              @endif
                                           </td>
                                           <td>{{$row->description}}</td>
                                           <td>{{$row->method}}</td>
                                           <td>{{$row->amount}}</td>
                                           <td>
                                            @if($row->status == 'pending')
                                            <a data-bs-toggle="modal" data-bs-target="#fundtransferconfirmation" data-id="{{ $row->id }}" class="btn btn-danger">Confirm Transfer</a>
                                            @else
                                           {{$row->status}}
                                        @endif</td>


                                       </tr>
                                       <!--@include('user.modals.fundtransferconfirmationmodal')-->
                                       @endforeach




                                   </tbody>
                               </table>
                           </div>




                    </div>

                    </div>
                </div>


            </div>
        </div>
        
        <div class="modal fade text-left" id="fundtransferconfirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Confirm Transfer</h4>


                <button type="button" class="btn-primary close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <section id="multiple-column-form">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">

                              <div class="card-body">
                                

                              <form id="preventtt" method="post" action="javascript:void(0)">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="id" id="transferId" value="">


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Enter Confirmation Code</label>

                            <input type="text" name="confirmation_code"   class="form-control"required/>
                            <div id="suggestUser"></div>
                        </div>
                        
                        
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">

                {{-- <button type="submit" id="submitButton">Submit</button> --}}

                <button type="submit" class="btn btn-primary" id="confirmFundTransfer">Submit</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>



        
        @push('scripts')
        
       
        <script>
        
        
        
        $("body").on("keyup", "#sponsor", function () {
    let searchData = $("#sponsor").val();
    if (searchData.length > 0) {
        $.ajax({
            type: 'POST',
            url: '{{route("get-users")}}',
            data: {search: searchData},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
                $('#suggestUser').html(result.success);
                console.log(result.data);
                if (result.data) {
                    $("#fundTransferForm").removeAttr('data-user-not-found');
                } else {
                    $("#fundTransferForm").attr('data-user-not-found', 'true');
                }
            }
        });
    }
    if (searchData.length < 1) {
        $('#suggestUser').html("");
        $("#fundTransferForm").removeAttr('data-user-not-found');
    }
});

$("#fundTransferForm").submit(function (event) {
    if ($("#fundTransferForm").attr('data-user-not-found') === 'true') {
        event.preventDefault(); // Prevent form submission
        alert('User not found. Please enter a valid receiver ID.');
    }
});





    // Get the input element
    document.addEventListener("DOMContentLoaded", function () {
    let amountInput = document.getElementById("amount");
    let form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        let amountValue = amountInput.value;

        if (!/^\d+$/.test(amountValue)) {
            event.preventDefault();
            alert("Please enter a valid numeric amount.");
        }
    });
});


//Fund transfer Modal
   $(document).ready(function() {
       $('#fundtransferconfirmation').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var transferId = button.data('id');
            var modal = $(this);
            modal.find('#transferId').val(transferId); // Set the transferId value in the hidden input field
        });
        
        $("#preventtt").on("submit", function(event) {
            console.log("tes1111t");

            event.preventDefault();
    
            var submitButton = $("#confirmFundTransfer");
            submitButton.prop("disabled", true);
    
            var formData = $(this).serialize();
    
            $.ajax({
                type: "POST",
                url: "{{ route('send-fund-confirmation') }}",
                data: formData,
                dataType: "json",
                success: function(response) {
                    // Hide the modal
                    $("#fundtransferconfirmation").modal("hide");
    
                    // Handle the success response here
                    //console.log("Form submitted successfully", response);

                    $("#messageContainer").html('<div class="alert alert-success">Confirmation successful!</div>');
                    setTimeout(function() {
                            window.location.reload();
                            $("#messageContainer").empty();
                        }, 10000); // 10000 milliseconds = 10 seconds
                        // location.reload();
                    
                    // Show a success message
    
                    // Disable the submit button
                    submitButton.prop("disabled", true);
                },
                error: function(error) {
                    // Handle the error response here
                    console.log(error);
                    $("#messageContainer").html('<div class="alert alert-danger"> You have entered wrong code</div>');

                    setTimeout(function() {
                            $("#messageContainer").empty();
                        }, 10000); 
                    // You can display an error message to the user
                    $("#fundtransferconfirmation").modal("hide");
                    // Re-enable the submit button
                    submitButton.prop("disabled", false);
                }
            });
        });
    });

//End fund transfer Modal



  </script>
  
  
  

@endpush



@endsection

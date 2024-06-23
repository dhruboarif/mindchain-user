@extends('user.layouts.master')


@section('user_content')



   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">

                <div class="col">
                    <div class="card">
                      @if(Session::has('withdraw_added'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
         <svg class="bi flex-shrink-0 me-2" width="24" height="24">
             <use xlink:href="#check-circle-fill" />
         </svg>
         <div>
             {{Session::get('withdraw_added')}}
         </div>
     </div>
              @elseif(Session::has('withdraw_error'))
                 <div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24">
              <use xlink:href="#check-circle-fill" />
              </svg>
              <div>
              {{Session::get('withdraw_error')}}
              </div>
              </div>

     @endif
                    <div class="card-body">
                      @if(Auth::user()->kyc == 0)
                      <h6 style="color:red;">Please Complete KYC Verification to activate Withdrawal</h6>
                      @else
                        <h4 class="card-title">MUSD Withdraw</h4>
                        @if(Auth::user()->status == 0 && Auth::user()->kyc == 1)
                         <a class="btn btn-primary float-right disabled" href="#" data-bs-toggle="modal" data-bs-target="#withdrawfund">Add Request</a>
                        @else
                        <a class="btn btn-primary float-right" href="#" data-bs-toggle="modal" data-bs-target="#withdrawfund">Make Withdraw</a>
                        @include('user.modals.withdrawmodal')
                        @endif
                        <hr>
                        <h6>Available Balance: {{$data['sum_deposit'] ? '$'.number_format((float)$data['sum_deposit'], 2, '.', '') : '$00.00'}}</h6>

                        <hr>
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                    @enderror
                        <div class="bd-example table-responsive">
                               <table class="table table-bordered table-border">
                                   <thead>
                                       <tr>
                                           <th scope="col">#</th>

                                              <th scope="col"> MY WALLET</th>
                                                 <th scope="col">REQUEST DATE</th>
                                                    <th scope="col">AMOUNT</th>
                                                     <th scope="col">CASHABLE AMOUNT</th>
                                                       <th scope="col">STATUS</th>

                                           <th scope="col">APPROVAL DATE</th>
                                           <th scope="col">TRANSACTION HASH</th>

                                       </tr>
                                   </thead>
                                   @foreach($data['withdraws'] as $row)

                                       <tr>
                                          <td >{{$loop->index+1}}</td>

                                           <td>
                                            {{$row->wallet_id}}
                                           </td>
                                           <td>{{$row->created_at}}</td>
                                           <td>{{$row->amount}}</td>
                                            <td>{{$row->payable}}</td>
                                           <td>
                                            @if($row->status == 'awaiting')
                                            <a data-bs-toggle="modal" data-bs-target="#fundwithdrawconfirmation{{$row->id}}" class="btn btn-danger">Confirm Withdraw</a>
                                            @elseif($row->status == 'pending')
                                            <a data-bs-toggle="modal" data-bs-target="#musdwithdrawcancel{{$row->id}}" class="btn btn-danger">Cancel</a>
                                            @else
                                           {{$row->status}}
                                            @endif</td>
                                           <td>{{$row->updated_at}}</td>
                                           <td>{{$row->transaction_hash}}</td>


                                       </tr>
                                        @include('user.modals.fundwithdrawconfirmationmodal')
                                        @include('user.modals.withdrawMusdCancel')

                                       @endforeach



                                   </tbody>
                               </table>
                           </div>



                           @endif
                    </div>

                    </div>
                </div>


            </div>
        </div>
        <script type="text/javascript">

            //alert('success');
            //console.log(this.getAttribute('id'));
            //console.log(e.target.options[e.target.selectedIndex].getAttribute('id'));
            //var wallet=  document.getElementById("wallet_id");
            //wallet.innerHTML= id.value;
            document.getElementById('DestinationOptions').addEventListener('change', function (e) {
                var wallet2 = e.target.options[e.target.selectedIndex].getAttribute('id');
                //console.log(wallet2);
                var wallet = document.getElementById("wallet_id").value = wallet2;
                //console.log(wallet);
                //wallet.innerHTML= wallet2;
            });

            //  document.getElementById('').value(id.value);

$("#fundTransferForm").submit(function (event) {
    if ($("#fundTransferForm").attr('data-user-not-found') === 'true') {
        event.preventDefault(); // Prevent form submission
        alert('User not found. Please enter a valid receiver ID.');
    }
});


         // Get the input element
    var amountInput = document.querySelector('input[name="amount"]');

    // Add an event listener to restrict input values
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


        </script>




@endsection

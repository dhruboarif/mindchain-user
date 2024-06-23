@extends('user.layouts.master')


@section('user_content')



   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">

                <div class="col">
                    <div class="card">
                      @if(Session::has('Money_added'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
         <svg class="bi flex-shrink-0 me-2" width="24" height="24">
             <use xlink:href="#check-circle-fill" />
         </svg>
         <div>
             {{Session::get('Money_added')}}
         </div>
     </div>
     @endif



                    <div class="card-body">
                        <h4 class="card-title">We accept only MIND20</h4>
                        <a class="btn btn-primary float-right" href="#" data-bs-toggle="modal" data-bs-target="#addfundauto">Pay Automatic</a>

                         @if(Auth::user()->status == 0)
                         
                        <a class="btn btn-primary float-right disabled" href="#" data-bs-toggle="modal" data-bs-target="#addaatoken2">Pay aa Manually</a>
                        @else
                       
                        <a class="btn btn-primary float-right" href="#" data-bs-toggle="modal" data-bs-target="#addtoken2">Pay Manually</a>
                       
                          @include('user.modals.addtokenmodal2')
                          @include('user.modals.addfundauto')

                          @endif
                        <hr>
                        <h6>Available Balance: {{$data['sum_deposit_bonus'] ? number_format((float)$data['sum_deposit_bonus'], 2, '.', '') .' MIND' : '00.00 MIND'}}</h6>

                        <hr>
                        <div class="bd-example table-responsive">
                               <table class="table table-bordered table-border">
                                   <thead>
                                       <tr>
                                           <th scope="col">#</th>
                                           <th scope="col">TRANX ID</th>
                                              <th scope="col"> MERCHANT NO</th>
                                                 <th scope="col">REQUEST DATE</th>
                                                    <th scope="col">AMOUNT</th>
                                                       <th scope="col">STATUS</th>

                                           <th scope="col">APPROVAL DATE</th>

                                       </tr>
                                   </thead>
                                   @foreach($deposit as $row)

                                       <tr>
                                          <td >{{$loop->index+1}}</td>
                                           <td>{{$row->txn_id}}</td>
                                           <td>
                                             @if($row->wallet_id != null)
                                             Manually(
                                            {{$row->merchant->wallet_no}})
                                            @else
                                            Automatic
                                            @endif
                                           </td>
                                           <td>{{$row->created_at}}</td>
                                           <td>{{$row->amount}}</td>
                                           <td>{{$row->status}}</td>
                                           <td>{{$row->updated_at}}</td>


                                       </tr>
                                       @endforeach



                                   </tbody>
                               </table>
                           </div>




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

<script>
    function startProcess() {
        if ($('#inp_amount').val() > 0) {
            // run metamsk functions here
            EThAppDeploy.loadEtherium();
        } else {
            alert('Please Enter Valid Amount');
        }
    }


    EThAppDeploy = {
        loadEtherium: async () => {
            if (typeof window.ethereum !== 'undefined') {
                EThAppDeploy.web3Provider = ethereum;
                EThAppDeploy.requestAccount(ethereum);
            } else {
                alert(
                    "Not able to locate an Ethereum connection, please install a Metamask wallet"
                );
            }
        },
        /****
         * Request A Account
         * **/
        requestAccount: async (ethereum) => {
            ethereum
                .request({
                    method: 'eth_requestAccounts'
                })
                .then((resp) => {
                    //do payments with activated account
                    EThAppDeploy.payNow(ethereum, resp[0]);
                })
                .catch((err) => {
                    // Some unexpected error.
                    console.log(err);
                });
        },
        /***
         *
         * Do Payment
         * */
        payNow: async (ethereum, from) => {
            var amount = $('#inp_amount').val();
            ethereum
                .request({
                    method: 'eth_sendTransaction',
                    params: [{
                        from: from,
                        to: "0x9837eC39273b0E07BBf8de9E7B56F99AB5D12528",
                        value: '0x' + ((amount * 1000000000000000000).toString(16)),
                    }, ],
                })
                .then((txHash) => {
                    if (txHash) {
                        console.log(txHash);
                        storeTransaction(txHash, amount);
                    } else {
                        console.log("Something went wrong. Please try again");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    }
    /***
     *
     * @param Transaction id
     *
     */
    function storeTransaction(txHash, amount) {
        $.ajax({
            url: "{{ route('metamask.create') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: {
                txHash: txHash,
                amount: amount,
            },
            success: function (response) {
                $('#addfundauto').modal('hide');
                // reload page after success
                window.location.reload();
            }
        });
    }

</script>


@endsection

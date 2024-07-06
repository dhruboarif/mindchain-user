@extends('user.layouts.master')


@section('user_content')
    <div class="section-admin container-fluid">
        <div class="row admin">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="admin-content res-mg-t-15 d-flex row justify-content-between">


                    <div class="row page-top-section">
                        <!-- breadcome title Section  -->
                        <div class="col-sm-6 breadcome-heading">
                            <h3>MUSD Deposit History</h3>
                        </div>
                        <div class="col-sm-6">
                            <div class=" breadcome-price-section">
                                <p class="breadcome-section-name">Available Balance:</p>
                                <p class="breadcome-section-price">{{$data['sum_deposit'] ? '$'.number_format((float)$data['sum_deposit'], 2, '.', '') : '$00.00'}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row page-section-btn">
                        <div class="col-sm-12">
                            <button type="button" data-toggle="modal" data-target="#usdtDeposit" data-whatever=""  class="page-button">Pay Manually</button>
                                <div class="modal withdraw-modal fade" id="usdtDeposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">USDT Pay Manually</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('money-store-manual')}}">
                                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                              <div class="form-group">
                                                <?php
                          $account_info= App\Models\AccountInfo::where('payment_type_id','!=',2)->get();

                           ?>
                                                <label for="selectUsdtDepositWalletMenu" class="col-form-label">Select Wallet</label>
                                                <select class="form-select form-control" id="DestinationOptions_usd2" name="payment_wallet_id"  aria-label="Default select example" required onchange="UsdtDepositWalletMenu()">
                                                  <option selected disabled>choose Wallet</option>
                                                  @foreach($account_info as $payment)

                                                <option id="{{$payment->wallet_no}}" value="{{$payment->id}}">{{$payment->payment_way->payment_way}} </option>
                                                @endforeach
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                  <label for="usdtDepositAddressMenu" class="col-form-label">Wallet Address</label>
                                                  <input type="text" class="form-control" name="wallet_id" disabled id="wallet_id_usd2" readonly>
                                                  <button class="copy-button" onclick="copyUsdtDepositWalletMenu(event)">
                                                      <i class="fa-solid fa-copy copy-usdt-depo-wall-menu"></i>
                                                          <i class="fa-solid fa-clipboard clipboard-usdt-depo-wall-menu text-warning"></i>
                                                      </button>
                                                </div>
                                                <div class="form-group">
                                                  <label for="usdt-amount-deposit" class="col-form-label">Amount (USDT)</label>
                                                  <input type="text" class="form-control" name="amount" id="usdt-amount-deposit">
                                                </div>
                                                <div class="form-group">
                                                  <label for="usdt-hash-deposit" class="col-form-label">Transaction Hash</label>
                                                  <input type="text" class="form-control" id="usdt-hash-deposit" name="txn_id">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-primary">Deposit</button>
                                        </div>
                                    </form>

                                      </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="transection-staus mg-t-30  mg-b-30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="transaction-status-wrap">

                                        <div class="transaction-table">
                                            <table id="myTable" class="">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">DATE</th>
                                                        <th scope="col">AMOUNT</th>

                                                        <th scope="col">DESCRIPTION</th>
                                                        <th scope="col">TYPE</th>
                                                        <th scope="col">Status</th>

                                                    </tr>
                                                </thead>


                                                @foreach ($deposit as $row)
                                                    <tr>
                                                        <td id="text-purple">{{ $loop->index + 1 }}</td>

                                                        <td id="text-purple">{{ $row->created_at }}</td>
                                                        <td id="text-purple">

                                                            {{ $row->amount }}USD

                                                        </td>
                                                        <td id="text-purple">{{ $row->description }}</td>
                                                        <td id="text-purple">{{ $row->type }}</td>
                                                        <td id="text-purple">{{ $row->status }}</td>



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
                    <!-- transection Token Wallet section
        ============================================  -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>



    @push('scripts')
        <script type="text/javascript">
            document.getElementById('DestinationOptions_usd2').addEventListener('change', function(e) {
                var wallet2 = e.target.options[e.target.selectedIndex].getAttribute('id');
                //console.log(wallet2);
                var wallet = document.getElementById("wallet_id_usd2").value = wallet2;
                //console.log(wallet);
                //wallet.innerHTML= wallet2;
            });

            //  document.getElementById('').value(id.value);
        </script>

        <script>
            document.getElementById('DestinationOptions').addEventListener('change', function(e) {
                var wallet2 = e.target.options[e.target.selectedIndex].getAttribute('id');
                console.log(wallet2);
                var wallet = document.getElementById("wallet_id").value = wallet2;
                //console.log(wallet);
                //wallet.innerHTML= wallet2;
            });
        </script>

   
    @endpush
@endsection

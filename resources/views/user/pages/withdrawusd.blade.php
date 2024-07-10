@extends('user.layouts.master')


@section('user_content')
    <div class="section-admin container-fluid">
        <div class="row admin">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="admin-content res-mg-t-15 d-flex row justify-content-between">

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

                    <div class="row page-top-section">
                        <!-- breadcome title Section  -->
                        <div class="col-sm-6 breadcome-heading">
                            <h3>USDT Withdraw History</h3>
                        </div>
                        <div class="col-sm-6">
                            <div class=" breadcome-price-section">
                                <p class="breadcome-section-name">Available Balance:</p>
                                <p class="breadcome-section-price">{{$data['sum_deposit'] ? ''.number_format((float)$data['sum_deposit'], 2, '.', '') : '00.00'}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row page-section-btn">
                        <div class="col-sm-12">
                            <button type="button" data-toggle="modal" data-target="#usdtDeposit" data-whatever=""  class="page-button">Make Withdraw</button>
                                <div class="modal withdraw-modal fade" id="usdtDeposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Make withdraw request</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('withdrawUsdStore')}}">
                                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                              <div class="form-group" data-section="4">

                          <?php
                          $payment_method= App\Models\UserWallet::where('user_id',Auth::user()->id)->get();

                           ?>
                                                <label for="selectWallet4" class="col-form-label">Select Wallet</label>
                                                <select class="form-select form-control" id="selectWallet4" name="wallet_method_id"  aria-label="Default select example" required onchange="selectWallet(4)">
                                                  <option selected disabled>choose Wallet</option>
                                                  @foreach($payment_method as $payment)

                                                    <option id="{{$payment->wallet_no}}" value="{{$payment->id}}">{{$payment->wallet_name}}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                              <div class="form-group" data-section="4">
                                                  <label for="copyAddress4" class="col-form-label">Wallet Address</label>
                                                  <input type="text" class="form-control" name="wallet_no" id="copyAddress4" readonly>
                                                  <button class="copy-button" onclick="copyWallet(event, 4)">
                                                      <i class="fa-solid fa-copy copy-icon"></i>
                                                          <i class="fa-solid fa-clipboard clipboard-icon text-warning"></i>
                                                      </button>
                                                </div>

                                                <?php
                                                $withdraw_commission= App\Models\UsdtWithdrawInfo::first();
                                                 ?>
                                                <div class="form-group">
                                                  <label for="usdt-amount-deposit" class="col-form-label">Amount (USDT)</label>
                                                  <input type="number" min="{{$withdraw_commission->withdraw_limit_min}}" max="{{$withdraw_commission->withdraw_limit_max}}" type="text" class="form-control" name="amount" id="amount">
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-primary">Withdraw</button>
                                        </div>
                                        <div class="modal-footer">
                                            <h6>Withdraw limit USDT( >= {{$withdraw_commission->withdraw_limit_min}} & <= {{$withdraw_commission->withdraw_limit_max}})</h6>
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

                                                           <th scope="col"> MY WALLET</th>
                                                              <th scope="col">REQUEST DATE</th>
                                                                 <th scope="col">AMOUNT</th>
                                                                  <th scope="col">CASHABLE AMOUNT</th>
                                                                 <th scope="col">WALLET ID</th>

                                                                    <th scope="col">STATUS</th>

                                                        <th scope="col">APPROVAL DATE</th>
                                                        <th scope="col">TRANSACTION HASH</th>

                                                    </tr>
                                                </thead>
                                                @foreach($data['withdraw_usd'] as $row)

                                                    <tr>
                                                       <td >{{$loop->index+1}}</td>

                                                        <td>
                                                         {{$row->wallet->wallet_name}}
                                                        </td>
                                                        <td>{{$row->created_at}}</td>
                                                        <td>{{$row->amount}}</td>
                                                         <td>{{$row->payable}}</td>

                                                         <td>{{$row->wallet->wallet_no}}</td>
                                                         <td>
                                                         @if($row->status == 'awaiting')
                                                         <a data-toggle="modal" data-target="#withdrawUsdConfirmation{{$row->id}}" class="btn btn-danger">Confirm Withdraw</a>
                                                         @elseif($row->status == 'pending')
                                                         <a data-toggle="modal" data-target="#withdrawUsdCancel{{$row->id}}" class="btn btn-danger">Cancel</a>
                                                         @else
                                                        Cancelled
                                                     @endif</td>
                                                        <td>{{$row->updated_at}}</td>
                                                        <td>{{$row->transaction_hash}}</td>

                                                    </tr>
                                                     @include('user.modals.withdrawUsdConfirmationmodal')
                                                     @include('user.modals.withdrawUsdCancel')

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

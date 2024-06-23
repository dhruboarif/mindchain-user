@extends('user.layouts.master')


@section('user_content')



   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">

                <div class="col">
                    <div class="card">
                        @if(Session::has('token_rate_updated'))
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('token_rate_updated')}}
           </div>
       </div>
       @elseif(Session::has('ambassador_updated'))
       <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24">
        <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
        {{Session::get('ambassador_updated')}}
        </div>
        </div>
        @elseif(Session::has('transfer_updated'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
         <svg class="bi flex-shrink-0 me-2" width="24" height="24">
         <use xlink:href="#check-circle-fill" />
         </svg>
         <div>
         {{Session::get('transfer_updated')}}
         </div>
         </div>
         @elseif(Session::has('withdraw_updated'))
         <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24">
          <use xlink:href="#check-circle-fill" />
          </svg>
          <div>
          {{Session::get('withdraw_updated')}}
          </div>
          </div>


       @endif

                    <div class="card-body">
                        <h2 class="card-title">Transactions Report</h2>




                          <hr>
                        <div class="bd-example">
          <ul class="nav nav-pills" data-toggle="slider-tab" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="logo-tab" data-bs-toggle="tab" data-bs-target="#pills-logo1" type="button" role="tab" aria-controls="logo" aria-selected="true">CashWallet</button>
              </li>
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="icon-tab" data-bs-toggle="tab" data-bs-target="#pills-icon1" type="button" role="tab" aria-controls="icon" aria-selected="false">CoinWallet</button>
              </li>
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#pills-info2" type="button" role="tab" aria-controls="info" aria-selected="false">BonusWallet</button>
              </li>
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#pills-info2" type="button" role="tab" aria-controls="info" aria-selected="false">Staking wallet</button>
              </li>
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#pills-infousd" type="button" role="tab" aria-controls="info" aria-selected="false">USD wallet</button>
              </li>
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#pills-info3" type="button" role="tab" aria-controls="info" aria-selected="false">Ambassador wallet</button>
              </li>
              @if(Auth::user()->merchant_status == 1)
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#pills-info4" type="button" role="tab" aria-controls="info" aria-selected="false">Coupon wallet</button>
              </li>
              @endif

          </ul>
          <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-logo1" role="tabpanel"
                  aria-labelledby="pills-logo-tab1">
                  <p>
                    <h6 class="text-left">CashWallet Balance:  {{$data['sum_deposit'] ? '$'.number_format((float)$data['sum_deposit'], 2, '.', '') : '$00.00'}}</h6>
                  <hr>
                  <div class="bd-example table-responsive">
                         <table id="myTable" class="table table-bordered table-border">
                             <thead>
                                 <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">DATE</th>
                                        <th scope="col"> CATEGORY</th>
                                           <th scope="col">RCVD FRM/PAY TO</th>
                                              <th scope="col">DESCRIPTION</th>
                                                 <th scope="col">AMOUNT</th>

                                     <th scope="col">TYPE</th>
                                             <th scope="col">ACTIONS</th> <!-- Add a column for the details button -->


                                 </tr>
                             </thead>


                             @foreach($cashwallet_history as $cash)
                                 <tr>
                                    <td >{{$loop->index+1}}</td>
                                     <td>{{$cash->created_at}}
                                     </td>
                                     <td>{{$cash->method}}</td>
                                     <td>
                                       @if($cash->received_from != null)
                                       {{$cash->sender->user_name}}
                                       @elseif($cash->receiver_id != null)
                                       {{$cash->receiver->user_name}}
                                       @else
                                       System Transactions
                                       @endif


                                     </td>
                                     <td>{{$cash->description}}</td>
                                     <td>{{$cash->amount}}$</td>
                                     <td>{{$cash->type}}</td>
                                        <td>
                                            <!-- Details button trigger -->
                                            <button class="btn btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#detailsModal{{$loop->index}}">Details</button>
                                        </td>

                                 </tr>
@include('user.modals.transaction.cashwalletDetails')
                                 @endforeach




                             </tbody>
                         </table>
                     </div>

                  </p>

              </div>
             <div class="tab-pane fade" id="pills-icon1" role="tabpanel" aria-labelledby="pills-icon-tab1">
    <p>
        <h6 class="text-left">Token Balance: {{$data['sum_deposit_token'] ? number_format((float)$data['sum_deposit_token'], 2, '.', '') : '00.00'}}</h6>
        <hr>
        <div class="bd-example table-responsive">
            <table id="myTable1" class="table table-bordered table-border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">RCVD FRM/PAY TO</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tokenwallet_history as $token)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$token->created_at}}</td>
                        <td>{{$token->method}}</td>
                        <td>
                            @if($token->received_from != null)
                            {{$token->sender->user_name}}
                            @elseif($token->receiver_id != null)
                            {{$token->receiver->user_name}}
                            @else
                            System Transactions
                            @endif
                        </td>
                        <td>{{$token->description}}</td>
                        <td>{{$token->amount}} MIND</td>
                        <td>{{$token->type}}</td>
                        <td>
                            <!-- Details button trigger -->
                            <button class="btn btn-primary btn-details" data-toggle="modal" data-target="#detailsModal{{$loop->index}}">Details</button>
                        </td>
                    </tr>

                    <!-- Modal for displaying details -->
                    <div class="modal fade" id="detailsModal{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{$loop->index}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailsModalLabel{{$loop->index}}">Transaction Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Content to display details -->
                                    <p>Date: {{$token->created_at}}</p>
                                    <p>Category: {{$token->method}}</p>
                                    <p>Received from/Paid to:
                                        @if($token->received_from != null)
                                        {{$token->sender->user_name}}
                                        @elseif($token->receiver_id != null)
                                        {{$token->receiver->user_name}}
                                        @else
                                        System Transactions
                                        @endif
                                    </p>
                                    <p>Description: {{$token->description}}</p>
                                    <p>Amount: {{$token->amount}} MIND</p>
                                    <p>Type: {{$token->type}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </p>
</div>
              <div class="tab-pane fade" id="pills-info1" role="tabpanel"
                  aria-labelledby="pills-info-tab1">
                  <p>


                      <h6 class="text-left">MIND Balance:  {{$data['sum_deposit_bonus'] ? number_format((float)$data['sum_deposit_bonus'], 2, '.', '') : '00.00'}}</h6>
                      <hr>
                      <div class="bd-example table-responsive">
                             <table id="myTable2" class="table table-bordered table-border">
                                 <thead>
                                     <tr>
                                       <th scope="col">#</th>
                                       <th scope="col">DATE</th>
                                          <th scope="col"> CATEGORY</th>
                                             <th scope="col">RCVD FRM/PAY TO</th>
                                                <th scope="col">DESCRIPTION</th>
                                                   <th scope="col">AMOUNT</th>

                                       <th scope="col">TYPE</th>
                                       <th scope="col">STATUS</th>

                                     </tr>
                                 </thead>


                                 @foreach($bonuswallet_history as $bonus)
                                     <tr>
                                        <td >{{$loop->index+1}}</td>
                                         <td>{{$bonus->created_at}}
                                         </td>
                                         <td>{{$bonus->method}}</td>
                                         <td>
                                           @if($bonus->received_from != null)
                                           {{$bonus->sender->user_name}}
                                           @elseif($bonus->receiver_id != null)
                                           {{$bonus->receiver->user_name}}
                                           @else
                                           System Transactions
                                           @endif


                                         </td>
                                         <td>{{$bonus->description}}</td>
                                         <td>{{$bonus->amount}} MIND</td>
                                         <td>{{$bonus->type}}</td>
                                         <td>{{$bonus->status}}</td>


                                     </tr>
                                     @endforeach





                                 </tbody>
                             </table>
                         </div>
                  </p>


              </div>
              <div class="tab-pane fade" id="pills-info2" role="tabpanel" aria-labelledby="pills-info-tab1">
    <p>
        <h6 class="text-left">Staking Balance: {{$data['sum_deposit_staking'] ? number_format((float)$data['sum_deposit_staking'], 2, '.', '') : '00.00'}}</h6>
        <hr>
        <div class="bd-example table-responsive">
            <table id="myTable3" class="table table-bordered table-border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">RCVD FRM/PAY TO</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($StakingWallet_history as $staking)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$staking->created_at}}</td>
                        <td>{{$staking->method}}</td>
                        <td>
                            @if($staking->received_from != null)
                            {{$staking->sender->user_name}}
                            @elseif($staking->receiver_id != null)
                            {{$staking->receiver->user_name}}
                            @else
                            System Transactions
                            @endif
                        </td>
                        <td>{{$staking->description}}</td>
                        <td>{{$staking->amount}} MIND</td>
                        <td>{{$staking->type}}</td>
                        <td>{{$staking->status}}</td>
                        <td>
                            <!-- Details button trigger -->
                            <button class="btn btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#bonusdetailsModal{{$loop->index}}">Details</button>
                        </td>
                    </tr>

                   @include('user.modals.transaction.stakingwalletDetails')
                    @endforeach
                </tbody>
            </table>
        </div>
    </p>
</div>

              
              <div class="tab-pane fade" id="pills-infousd" role="tabpanel" aria-labelledby="pills-info-tab1">
    <p>
        <h6 class="text-left">USD Balance: {{$data['sum_usd_wallet'] ? number_format((float)$data['sum_usd_wallet'], 2, '.', '') : '00.00'}}</h6>
        <hr>
        <div class="bd-example table-responsive">
            <table id="myTable4" class="table table-bordered table-border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">RCVD FRM/PAY TO</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($UsdWallet_history as $usd)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$usd->created_at}}</td>
                        <td>{{$usd->method}}</td>
                        <td>
                            @if($usd->received_from != null)
                            {{$usd->sender->user_name}}
                            @elseif($usd->receiver_id != null)
                            {{$usd->receiver->user_name}}
                            @else
                            System Transactions
                            @endif
                        </td>
                        <td>{{$usd->description}}</td>
                        <td>{{$usd->amount}} USD</td>
                        <td>{{$usd->type}}</td>
                        <td>{{$usd->status}}</td>
                        <td>
                            <!-- Details button trigger -->
                            <button class="btn btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#usddetailsModal{{$loop->index}}">Details</button>
                        </td>
                    </tr>

                    @include('user.modals.transaction.usdwalletDetails')
                    @endforeach
                </tbody>
            </table>
        </div>
    </p>
</div>

              
              <div class="tab-pane fade" id="pills-info3" role="tabpanel" aria-labelledby="pills-info-tab1">
    <p>
        <h6 class="text-left">Ambassador Balance: {{$data['sum_deposit_ambassador'] ? number_format((float)$data['sum_deposit_ambassador'], 2, '.', '') : '00.00'}}</h6>
        <hr>
        <div class="bd-example table-responsive">
            <table id="myTable5" class="table table-bordered table-border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">RCVD FRM/PAY TO</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($AmbassadorWallet_history as $ambassador)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$ambassador->created_at}}</td>
                        <td>{{$ambassador->method}}</td>
                        <td>
                            @if($ambassador->received_from != null)
                            {{$ambassador->sender->user_name}}
                            @elseif($ambassador->receiver_id != null)
                            {{$ambassador->receiver->user_name}}
                            @else
                            System Transactions
                            @endif
                        </td>
                        <td>{{$ambassador->description}}</td>
                        <td>{{$ambassador->amount}} MIND</td>
                        <td>{{$ambassador->type}}</td>
                        <td>{{$ambassador->status}}</td>
                        <td>
                            <!-- Details button trigger -->
                            <button class="btn btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#ambassadordetailsModal{{$loop->index}}">Details</button>
                        </td>
                    </tr>
@include('user.modals.transaction.ambassadorwalletDetails')
                                        @endforeach
                </tbody>
            </table>
        </div>
    </p>
</div>

             <div class="tab-pane fade" id="pills-info4" role="tabpanel" aria-labelledby="pills-info-tab1">
    <p>
        <h6 class="text-left">Coupon Balance: {{$data['sum_deposit_coupon'] ? number_format((float)$data['sum_deposit_coupon'], 2, '.', '') : '$00.00'}}</h6>
        <hr>
        <div class="bd-example table-responsive">
            <table id="myTable6" class="table table-bordered table-border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">RCVD FRM/PAY TO</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($CouponWallet_history as $coupon)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$coupon->created_at}}</td>
                        <td>{{$coupon->method}}</td>
                        <td>
                            @if($coupon->received_from != null)
                            {{$coupon->sender->user_name}}
                            @elseif($coupon->receiver_id != null)
                            {{$coupon->receiver->user_name}}
                            @else
                            System Transactions
                            @endif
                        </td>
                        <td>{{$coupon->description}}</td>
                        <td>{{$coupon->amount}}$</td>
                        <td>{{$coupon->type}}</td>
                        <td>{{$coupon->status}}</td>
                        <td>
                            <!-- Details button trigger -->
                            <button class="btn btn-primary btn-details" data-bs-toggle="modal" data-bs-target="#couponwalletdetailsModal{{$loop->index}}">Details</button>
                        </td>
                    </tr>

                    @include('user.modals.transaction.couponwalletDetails')
                    @endforeach
                </tbody>
            </table>
        </div>
    </p>
</div>

          </div>
      </div>


                    </div>

                    </div>
                </div>


            </div>
        </div>


<script>
    // JavaScript to handle click event on the details button
    $(document).ready(function() {
        $('.btn-details').click(function() {
            //console.log('working'); 
            // Clear any previous modal body content
            $('#detailsModal .modal-body').empty();
            // Get the details content for the corresponding row
            var detailsContent = $(this).closest('tr').find('.details-content').html();
            // Set the details content in the modal body
            $('#detailsModal .modal-body').html(detailsContent);
        });
    });
    
 
</script>


@endsection

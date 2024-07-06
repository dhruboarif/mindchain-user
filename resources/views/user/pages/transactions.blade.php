@extends('user.layouts.master')


@section('user_content')



   <div class="section-admin container-fluid">
    <div class="row admin ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="admin-content res-mg-t-15 d-flex row justify-content-between">

                <div class="row page-top-section">
                        <!-- breadcome title Section  -->
                    <div class="col-sm-6 breadcome-heading">
                        <h3>Transactions Report</h3>
                    </div>
                </div>

                         <!-- transection section 
 ============================================  -->
                <div class="transection-staus mg-t-30  mg-b-30 all-transection">
                    <div class="container-fluid">
                        <div class="row mg-b-30">
                            <div class="tab ">
                                <button class="tablinks" onclick="openWallet(event, 'CashWallet')">Cash Wallet</button>
                                <button class="tablinks" onclick="openWallet(event, 'CoinWallet')">Coin Wallet</button>
                                <button class="tablinks" onclick="openWallet(event, 'BonusWallet')">Bonus Wallet</button>
                                <button class="tablinks" onclick="openWallet(event, 'StakingWallet')">Staking Wallet</button>
                                <button class="tablinks" onclick="openWallet(event, 'USDWallet')">USD Wallet</button>
                                <button class="tablinks" onclick="openWallet(event, 'AmbassadorWallet')">Ambassador Wallet</button>
                                <button class="tablinks" onclick="openWallet(event, 'CouponWallet')">Coupon Wallet</button>
                            </div>
                        </div>
                        <div id="CashWallet" class="row tabcontent">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="transaction-status-wrap">
                                    <div class="tab-heading mg-b-30">
                                        <div class=" breadcome-price-section">
                                            <p class="breadcome-section-name">Cash Wallet Balance:</p>
                                            <p class="breadcome-section-price">{{$data['sum_deposit'] ? '$'.number_format((float)$data['sum_deposit'], 2, '.', '') : '$00.00'}}</p>
                                        </div>
                                    </div>
                                   
                                    <div class="transaction-table">
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
                                                           <button class="btn btn-primary btn-details" data-toggle="modal" data-target="#detailsModal{{$loop->index}}">Details</button>
                                                       </td>
               
                                                </tr>
               @include('user.modals.transaction.cashwalletDetails')
                                                @endforeach
               
               
               
               
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div id="CoinWallet" class="row tabcontent">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="transaction-status-wrap">
                                    <div class="tab-heading mg-b-30">
                                        <div class=" breadcome-price-section">
                                            <p class="breadcome-section-name">Token Wallet Balance:</p>
                                            <p class="breadcome-section-price">{{$data['sum_deposit_token'] ? number_format((float)$data['sum_deposit_token'], 2, '.', '') : '00.00'}}</p>
                                        </div>
                                    </div>
                                    
                                    
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
                                </div>
                            </div>
                        </div>
                        <div id="BonusWallet" class="row tabcontent">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="transaction-status-wrap">
                                    <div class="tab-heading mg-b-30">
                                        <div class=" breadcome-price-section">
                                            <p class="breadcome-section-name">Bonus Wallet Balance:</p>
                                            <p class="breadcome-section-price">{{$data['sum_deposit_bonus'] ? number_format((float)$data['sum_deposit_bonus'], 2, '.', '') : '00.00'}}</p>
                                        </div>
                                    </div>
                                    
                                    
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
                            </div>
                        </div>
                        <div id="StakingWallet" class="row tabcontent">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="transaction-status-wrap">
                                    <div class="tab-heading mg-b-30">
                                        <div class=" breadcome-price-section">
                                            <p class="breadcome-section-name">Staking Wallet Balance:</p>
                                            <p class="breadcome-section-price">{{$data['sum_deposit_staking'] ? number_format((float)$data['sum_deposit_staking'], 2, '.', '') : '00.00'}}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="transaction-table">
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
                                                        <button class="btn btn-primary btn-details" data-toggle="modal" data-target="#bonusdetailsModal{{$loop->index}}">Details</button>
                                                    </td>
                                                </tr>
                            
                                               @include('user.modals.transaction.stakingwalletDetails')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div id="USDWallet" class="row tabcontent">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="transaction-status-wrap">
                                    <div class="tab-heading mg-b-30">
                                        <div class=" breadcome-price-section">
                                            <p class="breadcome-section-name">USD Wallet Balance:</p>
                                            <p class="breadcome-section-price">{{$data['sum_usd_wallet'] ? number_format((float)$data['sum_usd_wallet'], 2, '.', '') : '00.00'}}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="transaction-table">
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
                                                        <button class="btn btn-primary btn-details" data-toggle="modal" data-target="#usddetailsModal{{$loop->index}}">Details</button>
                                                    </td>
                                                </tr>
                            
                                                @include('user.modals.transaction.usdwalletDetails')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div id="AmbassadorWallet" class="row tabcontent">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="transaction-status-wrap">
                                    <div class="tab-heading mg-b-30">
                                        <div class=" breadcome-price-section">
                                            <p class="breadcome-section-name">Ambassador Wallet Balance:</p>
                                            <p class="breadcome-section-price">{{$data['sum_deposit_ambassador'] ? number_format((float)$data['sum_deposit_ambassador'], 2, '.', '') : '00.00'}}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="transaction-table">
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
                                                        <button class="btn btn-primary btn-details" data-toggle="modal" data-target="#ambassadordetailsModal{{$loop->index}}">Details</button>
                                                    </td>
                                                </tr>
                            @include('user.modals.transaction.ambassadorwalletDetails')
                                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div id="CouponWallet" class="row tabcontent">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="transaction-status-wrap">
                                    <div class="tab-heading mg-b-30">
                                        <div class=" breadcome-price-section">
                                            <p class="breadcome-section-name">Coupon Wallet Balance:</p>
                                            <p class="breadcome-section-price">{{$data['sum_deposit_coupon'] ? number_format((float)$data['sum_deposit_coupon'], 2, '.', '') : '$00.00'}}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="transaction-table">
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
                                                        <button class="btn btn-primary btn-details" data-toggle="modal" data-target="#couponwalletdetailsModal{{$loop->index}}">Details</button>
                                                    </td>
                                                </tr>
                            
                                                @include('user.modals.transaction.couponwalletDetails')
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

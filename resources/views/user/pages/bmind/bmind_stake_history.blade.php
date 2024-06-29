@extends('user.layouts.master')


@section('user_content')
    <div class="section-admin container-fluid">
        <div class="row admin">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="admin-content res-mg-t-15 d-flex row justify-content-between">


                    <div class="row page-top-section">
                        <!-- breadcome title Section  -->
                        <div class="col-sm-6 breadcome-heading">
                            <h3>Bmnd Staking History</h3>
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
                                                       <th scope="col">AMOUNT</th>
                                                        <th scope="col">DAYS
                                                     </th>
             
             
                                                        <th scope="col">DAILY BONUS
                                                          </th>
                                                        
                                                         <th scope="col">RECEIVED DAYS</th>
                                                           <th scope="col">REMAINING DAYS</th>
                                                            <th scope="col">STAKING DATE</th>
                                                    </tr>
                                                </thead>


                                                @foreach($purchase as $row)
                                       <tr>
                                          <td >{{$loop->index+1}}</td>
                                          <td>{{$row->token_amount}}</td>

                                          <td>{{$row->bonus_duration}}</td>


                                            <td>{{round($row->daily_bonus,2)}}</td>
                                           
                                            <?php
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$row->created_at);
                                            $from = \Carbon\Carbon::now();

                                            $diff_in_days = $to->diffInDays($from);



                                             ?>


                                           
                                              @if(($row->bonus_duration)-($diff_in_days)< 0)
                                            <td>{{$row->bonus_duration}}</td>
                                            <td>0</td>
                                            
                                            @else 
                                            
                                            <td>{{$diff_in_days}}</td>
                                            <td>{{($row->bonus_duration)-($diff_in_days)}}</td>
                                            
                                            @endif
                                            <td>{{$row->created_at}}</td>
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

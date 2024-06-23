@extends('user.layouts.master')


@section('user_content')
   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">
                <div class="col">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="btn btn-success">Bmind Staking History</h4>
                        <hr>
                        <div class="bd-example table-responsive">
                               <table id="myTable" class="table table-bordered table-border">
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
                                   <tbody>
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




@endsection

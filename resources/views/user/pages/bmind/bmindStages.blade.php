@extends('user.layouts.master')


@section('user_content')
<style>
       .text-right{
           text-align: right;
       }
       .bpaper{
           margin-left:30px !important;
       }
   </style>
   <div class="container-fluid">
       
       
       
       
                      
        <!--Mindchain Product Section-->

    <div class="row">
          <div class="col-lg-3 ">
            <div class="card shining-card-2">
                <div class="card-body d-flex align-items-center">
                    <img src="{{asset('assets/images/coins/bmind.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img60">
        
                    <div class="pt-1 ms-3">
                        <span class="fs-5 me-2">Token Name:</span>
                        <h5 class="" style="visibility: visible;"><span class="fs-5">MindBase</span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="card shining-card-2">
                <div class="card-body d-flex align-items-center">
                    <img src="{{asset('assets/images/coins/bmind.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img60">
        
                    <div class="pt-1 ms-3">
                        <span class="fs-5 me-2">Symbol:</span>
                        <h5 class="" style="visibility: visible;"><span class="fs-5">BMIND</span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="card shining-card-2">
                <div class="card-body d-flex align-items-center">
                    <img src="{{asset('assets/images/coins/network.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img60">
        
                    <div class="pt-1 ms-3">
                        <span class="fs-5 me-2">Network:</span>
                        <h5 class="" style="visibility: visible;"><span class="fs-5">MIND20</span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="card shining-card-2">
                <div class="card-body d-flex align-items-center">
                    <img src="{{asset('assets/images/coins/supply.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img60">
        
                    <div class="pt-1 ms-3">
                        <span class="fs-5 me-2">Supply:</span>
                        <h5 class="" style="visibility: visible;"><span class="fs-5">1 Billion</span></h5>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 ">
            <div class="card shining-card-2">
                <div class="card-body d-flex align-items-center">
                    <img src="{{asset('assets/images/coins/price.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img60">
        
                    <div class="pt-1 ms-3">
                        <span class="fs-5 me-2">Current Price:</span>
                        <h5 class="" style="visibility: visible;"><span class="fs-5">0.03</span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="card shining-card-2">
                <div class="card-body d-flex align-items-center">
                    <img src="{{asset('assets/images/coins/export.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img60">
        
                    <div class="pt-1 ms-3">
                        <span class="fs-5 me-2">Next Price</span>
                        <h5 class="" style="visibility: visible;"><span class="fs-5">0.04</span></h5>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 ">
            <div class="card shining-card-2">
                <div class="card-body d-flex align-items-center">
                    <img src="{{asset('assets/images/coins/current.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img60">
        
                    <div class="pt-1 ms-3">
                        <span class="fs-5 me-2">Current Stage:</span>
                        <h5 class="" style="visibility: visible;"><span class="fs-5">STO</span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="card shining-card-2">
                <div class="card-body d-flex align-items-center">
                    <img src="{{asset('assets/images/coins/export.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img60">
        
                    <div class="pt-1 ms-3">
                        <span class="fs-5 me-2">Next Stage:</span>
                        <h5 class="" style="visibility: visible;"><span class="fs-5">Venus</span></h5>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--Mindchain Product Section end-->
   
        <div class="container">
                      
            <h6 class="text-success">Available USDT: {{$data['sum_usdwallet'] ? '$'.number_format((float)$data['sum_usdwallet'], 2, '.', '') : '$00.00'}}</h6>
           <br>
            <div class="d-flex">
                <h4 class="btn btn-primary">BMIND Stage List</h4>
                <a href=""><h4 class="btn btn-secondary bpaper" src="#">BMINDPAPER</h4></a>
            </div>
        </div>
            
            @if(Session::has('package_purchase'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
            <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
            {{Session::get('package_purchase')}}
            </div>
            </div>
             @elseif(Session::has('purchase_error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
            <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
            {{Session::get('purchase_error')}}
            </div>
            </div>
            @endif
            <br>
            <br>
            <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-2 g-4">
              @foreach($data['bmindstages'] as $row)
                <div class="col-md-12">
                    <div class="card">
                      <br>
                      <div class="text-center">
                          <img src="{{asset('storage/basemind/'.$row->image)}}" style="height:100px;width:100px;" class="bd-placeholder-img card-img-top" width="20%" height="20%" ></img>
                      </div>
                      <hr>

                      <div class="card-body">
                        <div class="input-group mb-3">
                        <!-- <span class="input-group-text" id="basic-addon1"></span> -->
                        <input disabled type="text" id="stage_name" class="form-control" style="color:#D98019; font-weight:100%;" value="{{$row->title}}" >
                          </div>
                             <div class="input-group mb-3">
                            <span class="input-group-text text-right"  id="basic-addon1" style="color:#D98019;width: 70%; font-weight:100%;">Total Token Issued</span>
                            <input disabled type="text" class="form-control" value="{{$row->total_token_issues }}" >
                            </div>
                            
                            <div class="input-group mb-3">
                            <span class="input-group-text text-right"  id="basic-addon1" style="color:#D98019;width: 70%; font-weight:100%;">Available Tokens</span>
                            <input disabled type="text" class="form-control" value="{{$row->total_token_issues - $row->total_token_sell }}" >
                            </div>
                              
                             <div class="input-group mb-3">
                              <span class="input-group-text text-right" style="color:#D98019; width: 70%; font-weight:100%;" id="basic-addon1">
                                                                  Token Base Price</span>
                              <input disabled type="text" class="form-control" id="token_base_price_{{$row->title}}" value="{{$row->token_base_price}}" >
                                </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-right" style="color:#D98019; width: 70%; font-weight:100%;" id="basic-addon1">Bonus Duration
                                                                                      (days)</span>
                                        <input disabled type="text" class="form-control" value="{{$row->duration}}" >
                                    </div>
                              
                                    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-right" style="color:#D98019; width: 70%; font-weight:100%;" id="basic-addon1">Token Amount</span>
                                        <select class="form-select finalamount" name="amount" id="amount_{{$row->title}}" required onchange="updateSelectedAmount('{{$row->title}}')">
                                            @foreach($row->communityTokenPackageSettings as $value)
                                                <option value="{{$value->amount}}">{{$value->amount}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                     <div class="input-group mb-3">
                                      <span class="input-group-text text-right" style="color:#D98019; width: 70%; font-weight:100%;" id="basic-addon1">
                                                                          Total Price (USDT)</span>
                                      <input disabled type="text" id="total_price_{{$row->title}}" class="form-control" value="{{ $row->communityTokenPackageSettings->isNotEmpty() ? $row->communityTokenPackageSettings[0]->amount * $row->token_base_price : '' }}" >
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-right" style="color:#D98019; width: 70%; font-weight:100%;" id="basic-addon1">Daily
                                                                                      Bonus </span>
                                        <input disabled type="text" name="daily_bonus" class="form-control" id="daily_bonus_{{$row->title}}" value="{{ $row->communityTokenPackageSettings->isNotEmpty() ? $row->communityTokenPackageSettings[0]->daily_bonus : '' }}">
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-right" style="color:#D98019; width: 70%; font-weight:100%;" id="basic-addon1">Start Date</span>
                                        <input disabled type="text" class="form-control" value="{{$row->start_date}}" >
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-right" style="color:#D98019; width: 70%; font-weight:100%;" id="basic-addon1">End Date</span>
                                        <input disabled type="text" class="form-control" value="{{$row->end_date}}" >
                                    </div>
                                    
                                    <div class="text-center">
                                        @if($row->status == 'Active')
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bmindbuymodal{{$row->id}}" onclick="captureSelectedAmount('{{$row->title}}')">Buy B-Mind</button>
                                        @include('user.modals.bmind.bmindbuymodal')
                                        @else
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#" disabled>Upcoming</button>
                                        @endif

                                          <!--  @if(Auth::user()->status == 0)-->
                                          <!--  <button disabled type="submit" class="btn btn-primary">Buy B-Mind</button>-->
                                          <!--  @else-->
                                          <!--<button type="button" disabled class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bmindbuymodal{{$row->id}}">Buy B-Mind</button>-->
                                          <!--@include('user.modals.bmind.bmindbuymodal')-->
                                          <!--@endif-->
                                        </form>
                                    </div>

                      </div>
                    </div>
                </div>
                @endforeach



            </div>




@endsection

<script>
    function updateSelectedAmount(stageId) {

        var selectedAmount = document.getElementById('amount_' + stageId).value;

        var stageName = stageId;
        var csrfToken = '{{ csrf_token() }}'; // Retrieve the CSRF token value

        var tokenBasePrice = document.getElementById('token_base_price_' + stageId).value;
        
        // Calculate the total price
        var totalPrice = selectedAmount * tokenBasePrice;
        // Update the total price input
        document.getElementById('total_price_' + stageId).value = totalPrice; 

        // Make an Ajax request to update the daily bonus based on the selected amount
        $.ajax({
            type: 'POST',
            url: '{{ route('bmindDailyBonusUpdate') }}',
            data: {
                selectedAmount: selectedAmount,
                stage_name: stageName,
                _token: csrfToken // Include the CSRF token in the request data
            },
            success: function(response) {
                // Update the daily bonus input value with the received data
                document.getElementById('daily_bonus_' + stageId).value = response.dailyBonus;
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
            }
        });
    }
    


</script>

<script>
    function captureSelectedAmount(stageId) {
        var selectedAmount = document.getElementById('amount_' + stageId).value;
        document.getElementById('selected_amount').value = selectedAmount;
    }
</script>




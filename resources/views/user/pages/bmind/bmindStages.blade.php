@extends('user.layouts.master')


@section('user_content')
    <div class="section-admin container-fluid mg-b-30">
        <div class="row admin text-center">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="admin-content res-mg-t-15 d-flex row justify-content-between">
                    <div class="row page-top-section bmind-top">
                        <!-- breadcome title Section  -->
                    <div class="col-sm-12 ">
                        <div class=" breadcome-price-section ">
                            <p class="breadcome-section-name">Available Balance(USDT):</p>
                            <p class="breadcome-section-price">{{$data['sum_usdwallet'] ? '$'.number_format((float)$data['sum_usdwallet'], 2, '.', '') : '$00.00'}}</p>
                        </div>
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
                             <!-- Content  section 
     ============================================  -->
                    <div class="bmind-page-staus mg-t-30  mg-b-30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bmind-card">
                                            <!-- <div class="card-box">
                                                <div class="card-icon">
                                                    <img src="{{asset('assetsnew/img/img-icon/bmind-icon.png') }}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <p class="card-title">Token Name:</p>
                                                    <h4 class="card-price">190318.89</h4>
                                                </div>
                                            </div> -->
                                            <div class="card-box">
                                                <div class="card-icon">
                                                    <img src="{{asset('assetsnew/img/img-icon/bmind-icon.png')}}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <p class="card-title">Token Name:</p>
                                                    <h4 class="card-price">190318.89</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bmind-card">
                                            <div class="card-box">
                                                <div class="card-icon">
                                                    <img src="{{asset('assetsnew/img/img-icon/bmind-icon.png') }}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <p class="card-title">Symbol:</p>
                                                    <h4 class="card-price">BMIND</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bmind-card">
                                            <div class="card-box">
                                                <div class="card-icon">
                                                    <img src="{{asset('assetsnew/img/img-icon/network.png') }}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <p class="card-title">Network:</p>
                                                    <h4 class="card-price">MIND20</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bmind-card">
                                            <div class="card-box">
                                                <div class="card-icon">
                                                    <img src="{{asset('assetsnew/img/img-icon/supply.png') }}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <p class="card-title">Sypply:</p>
                                                    <h4 class="card-price">1 Billion</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bmind-card">
                                            <div class="card-box">
                                                <div class="card-icon">
                                                    <img src="{{asset('assetsnew/img/img-icon/current-price.png') }}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <p class="card-title">Current Price:</p>
                                                    <h4 class="card-price">0.03</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bmind-card">
                                            <div class="card-box">
                                                <div class="card-icon">
                                                    <img src="{{asset('assetsnew/img/img-icon/next-price.png') }}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <p class="card-title">Next Price:</p>
                                                    <h4 class="card-price">0.04</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bmind-card">
                                            <div class="card-box">
                                                <div class="card-icon">
                                                    <img src="{{asset('assetsnew/img/img-icon/current-stage.png') }}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <p class="card-title">Current Stage:</p>
                                                    <h4 class="card-price">STO</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bmind-card">
                                            <div class="card-box">
                                                <div class="card-icon">
                                                    <img src="{{asset('assetsnew/img/img-icon/next-stage.png') }}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <p class="card-title">Next Stage:</p>
                                                    <h4 class="card-price">Venus</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-30">
                                    <div class="stage-title">
                                        <h3 class="text-left" >Bmind Stage List</h3>
                                    </div>
                                    
                                    <div class="row mg-t-30 mg-b-30">
                                        @foreach($data['bmindstages'] as $row)
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bmind-stage-list ">
                                            <div class="card-box">
                                                <div class="card-icon mg-t-15 mg-b-30">
                                                    <img src="{{asset('assetsnew/img/img-icon/stage-icon.png') }}" alt="">
                                                    <h4 class="mg-t-15 mg-t-30" id="stage_name">
                                                        {{$row->title}}
                                                    </h4>
                                                </div>
                                                <div class="card-content mg-t-30">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="totalTokenIssued" class="col-form-label" >Total Token Issued</label>
                                                            <input disabled type="text" class="form-control" value="{{$row->total_token_issues }}" >
                                                            <input type="text" class="form-control" id="totalTokenIssued" disabled value="30000000">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="availableTokens" class="col-form-label">Available Tokens</label>
                                                            <input type="text" class="form-control" id="availableTokens" disabled value="{{$row->total_token_issues - $row->total_token_sell }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tokenBasePrice" class="col-form-label">Token Base Price</label>
                                                        <input disabled type="text" class="form-control" id="token_base_price_{{$row->title}}" value="{{$row->token_base_price}}" >

                                                          </div>
                                                          <div class="form-group">
                                                            <label for="bonusDuration" class="col-form-label">Bonus Duration (days)</label>
                                                        <input disabled type="text" class="form-control" value="{{$row->duration}}" >

                                                          </div>
                                                          <div class="form-group">
                                                            <label for="tokenAmount" class="col-form-label">Token Amount</label>
                                                            <select class="form-select finalamount" name="amount" id="amount_{{$row->title}}" required onchange="updateSelectedAmount('{{$row->title}}')">
                                                                @foreach($row->communityTokenPackageSettings as $value)
                                                                    <option value="{{$value->amount}}">{{$value->amount}}</option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="totalPrice" class="col-form-label">Total Price (USDT)</label>
                                                            <input disabled type="text" id="total_price_{{$row->title}}" class="form-control" value="{{ $row->communityTokenPackageSettings->isNotEmpty() ? $row->communityTokenPackageSettings[0]->amount * $row->token_base_price : '' }}" >
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="dailyBonus" class="col-form-label">Daily Bonus</label>
                                                            <input disabled type="text" name="daily_bonus" class="form-control" id="daily_bonus_{{$row->title}}" value="{{ $row->communityTokenPackageSettings->isNotEmpty() ? $row->communityTokenPackageSettings[0]->daily_bonus : '' }}">
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="startDate" class="col-form-label">Start Date</label>
                                                        <input disabled type="text" class="form-control" value="{{$row->start_date}}" >

                                                          </div>
                                                          <div class="form-group">
                                                            <label for="endDate" class="col-form-label">End Date</label>
                                                        <input disabled type="text" class="form-control" value="{{$row->end_date}}" >

                                                          </div>
                                                        </form>

                                                        @if($row->status == 'Active')
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bmindbuymodal{{$row->id}}" onclick="captureSelectedAmount('{{$row->title}}')">Buy B-Mind</button>
                                                        @include('user.modals.bmind.bmindbuymodal')
                                                        @else
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#" disabled>Upcoming</button>
                                                        @endif

                                                    </div>
                                            </div>
                                        </div>
                                        
                                        
                                        @endforeach
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                <!--Content    section 
                ============================================  -->
                </div>
            </div>           
        </div>
    </div>



    @push('scripts')
      
      
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

   
    @endpush
@endsection

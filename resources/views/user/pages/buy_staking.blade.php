@extends('user.layouts.master')


@section('user_content')
<style>
       .text-right{
           text-align: right;
       }
   </style>

                  <div class="container">
              <h6 id="text-purple">Available Amount: {{$data['sum_deposit_bonus'] ? number_format((float)$data['sum_deposit_bonus'], 2, '.', ''). ' MIND' : '00.00 MIND'}}</h6>
              <hr>
              <h4 class="btn btn-primary">Simple Earn</h4>
              <h4 class="btn btn-primary">Flexible Savings</h4>
            </div>
            <br>
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
              <div class="col-lg-12 d-flex justify-content-center">
                 <div class="card">
                    <div class="card-header d-flex justify-content-between flex-wrap">
                       <div class="header-title ">
                          <h4 class="card-title">Stake to Earn</h4>
                       </div>

                    </div>
                    <div class="card-body">
                       <form id="stakingForm" class="col-lg-12" method="post" action="{{route('buy-staking')}}">
                         @csrf
                         <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Avl. Balance (MIND)</span>
                               <input type="text" disabled class="form-control col-lg-8" value="{{$data['sum_deposit_bonus'] ? number_format((float)$data['sum_deposit_bonus'], 2, '.', ''). ( ' MIND') : '00.00 MIND'}}" >
                            </div>
                         </div>
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Enter Amount (MIND)</span>
                               <input type="text" min="{{$data['staking']->min_staking}}" max="{{$data['staking']->max_staking}}" name="amount"  class="form-control col-lg-8" id="amount" required>
                            </div>

                         </div>
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Duration</span>
                               <select class="form-control col-lg-8" onchange="calculate()" id="duration"  name="duration" required>
                                 <option value="">Select Days</option>
                                 <!--<option value="{{$data['staking']->days_90}}">90 Days</option>-->
                                 <option value="{{$data['staking']->days_180}}">180 Days</option>
                                 <option value="{{$data['staking']->days_365}}">365 Days</option>
                                 <!--<option value="{{$data['staking']->days_730}}">730 Days</option>-->
                                 <!--<option value="{{$data['staking']->days_1825}}">1825 Days</option>-->


                               </select>

                            </div>
                         </div>
                         <input type="hidden" name="days" id="days" value="">
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >APY Value (MIND)</span>
                               <input type="text" id="apy" readonly class="form-control col-lg-8" name="apy_value"  required>
                            </div>

                         </div>
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Total Staking Value (MIND)</span>
                               <input type="text" id="dailyAmount" name="total_value" readonly class="form-control col-lg-8" value="" required>
                            </div>
                         </div>
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Your Daily Bonus (MIND)</span>
                               <input type="text" id="dailyvalue" name="daily" readonly class="form-control col-lg-8" value="" required>
                            </div>
                         </div>



                         <div class="d-flex justify-content-center">


                          <div class="text-center">
                             <div class="d-grid gap-card">
                                 @if(Auth::user()->status == 0)
                     <button id="stakingButton" class="btn btn-success" type="submit">
    <span>STAKING</span>
    <svg class="rotate-45" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
</button>
                                @else
                                <button id="stakingButton" class="btn btn-success" type="submit">
    <span>STAKING</span>
    <svg class="rotate-45" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
</button>
                                @endif


                             </div>
                          </div>
                          </div>
                       </form>
                    </div>
                 </div>
              </div>


              </div>

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#amount').on('input', function(e) {
            calculate();
    });
})
function calculate(){



  var duration = document.getElementById('duration').value;
  console.log(duration);
  var amount = document.getElementById('amount').value;
  var apy= amount*duration/100;
  //console.log(apy);
  document.getElementById('apy').value= apy;
  if (duration == <?php echo $data['staking']->days_90 ?>) {
    dailyAmount= apy/4;
    days= 90;
    daily_value= dailyAmount/days;
    document.getElementById('dailyAmount').value= dailyAmount;
    document.getElementById('days').value= days;
     document.getElementById('dailyvalue').value= daily_value;
  }
  else if (duration == <?php echo $data['staking']->days_180 ?>) {
    dailyAmount= apy/2;
    days= 180;
    daily_value= dailyAmount/days;
    document.getElementById('dailyAmount').value= dailyAmount;
    document.getElementById('days').value= days;
    document.getElementById('dailyvalue').value= daily_value;
  }
  else if (duration == <?php echo $data['staking']->days_365 ?>) {
    dailyAmount= apy;
    days= 365;
    daily_value= dailyAmount/days;
    document.getElementById('dailyAmount').value= dailyAmount;
    document.getElementById('days').value= days;
    document.getElementById('dailyvalue').value= daily_value;
  }
  else if (duration == <?php echo $data['staking']->days_730 ?>) {
    dailyAmount= apy*2;
    days= 730;
    daily_value= dailyAmount/days;
    document.getElementById('dailyAmount').value= dailyAmount;
    document.getElementById('days').value= days;
    document.getElementById('dailyvalue').value= daily_value;
  }
  else if (duration == <?php echo $data['staking']->days_1825 ?>) {
    dailyAmount= apy*5;
    days= 1825;
    daily_value= dailyAmount/days;
    document.getElementById('dailyAmount').value= dailyAmount;
    document.getElementById('days').value= days;
    document.getElementById('dailyvalue').value= daily_value;
  }


}
</script>

<script>
    $(document).ready(function () {
        $("#stakingButton").one("click", function () {
            // Disable the button
            $(this).prop("disabled", true);

            // Submit the form
            $("#stakingForm").submit();
        });
    });
</script>



@endpush


@endsection

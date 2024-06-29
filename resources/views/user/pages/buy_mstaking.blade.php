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
                       <p class="breadcome-section-name">Available Balance:</p>
                       <p class="breadcome-section-price">{{$data['sum_deposit'] ? number_format((float)$data['sum_deposit'], 2, '.', ''). ' MIND' : '00.00 MIND'}}</p>
                   </div>
               </div>
           </div>

                        <!-- Content  section 
============================================  -->
               <div class="earn-page-staus mg-t-30  mg-b-30">
                   <div class="container-fluid">
                       <div class="row mg-t-30 mg-b-30">
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 earn-packege-list ">
                               <div class="card-box">
                                   <div class="card-icon mg-t-15 mg-b-30">
                                       <img src="img/img-icon/stake-earn.png" alt="">
                                       <h4 class="mg-t-15 mg-t-30">Stake to Earn</h4>
                                   </div>
                                   <div class="card-content mg-t-30">
                                       <form id="stakingForm" class="col-lg-12" method="post" action="{{route('buy-staking')}}">
                                          @csrf
                                          <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                           <div class="form-group">
                                               <label for="availableBalance" class="col-form-label" >Available Balance</label>
                                               <input type="text" class="form-control" id="availableBalance" readonly value="{{$data['sum_deposit'] ? number_format((float)$data['sum_deposit'], 2, '.', ''). ' MIND' : '00.00 MIND'}}">
                                           </div>
                                           <div class="form-group">
                                               <label for="amount" class="col-form-label">Amount</label>
                                               <input type="text" name="amount"  class="form-control col-lg-8" id="amount1" value="0" required>
                                           </div>
                                           <div class="form-group">
                                               <label for="duration" class="col-form-label">Duration</label>
                                               <select class="form-select form-control" id="duration" name="duration" aria-label="Default select example">
                                                   <option value="">Select Day</option>
                                                   <!-- <option value="{{$data['mstaking']->days_90}}">90 Days</option> -->
                                                   <!-- <option value="{{$data['mstaking']->days_180}}">180 Days</option> -->
                                                    <option value="{{$data['mstaking']->days_365}}">365 Days</option>
                                                    <option value="{{$data['mstaking']->days_730}}">730 Days</option>
                                                    <option value="{{$data['mstaking']->days_1825}}">1825 Days</option>
                                                 </select>
                                             </div>
                                             <input type="hidden" name="days" id="days" value="">

                                             <div class="form-group">
                                               <label for="apyValue" class="col-form-label">APY Value</label>
                                               <input type="text" id="apy" class="form-control" name="apy_value"  value="">
                                             </div>
                                             <div class="form-group">
                                               <label for="totalStakingValue" class="col-form-label">Total Staking Value (MIND)</label>
                                               <input type="text" class="form-control " id="dailyAmount" name="total_value" value="">
                                             </div>
                                             <div class="form-group">
                                               <label for="yourDailyBonus" class="col-form-label">Your Daily Bonus (MIND)</label>
                                               <input type="text" id="dailyvalue" name="daily" readonly class="form-control" value="">
                                             </div>
                                         </form>
                                         <button type="submit" id="stakingButton" class="bmind-btn mg-t-15">Stake</button>
                                   </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#amount1').on('input', function(e) {
                    calculate();
            });
            $('#duration').on('change', function(e) {
            calculate();
            });
        })
        function calculate(){
        
          var duration = document.getElementById('duration').value;
          console.log(duration);
          var amount = document.getElementById('amount1').value;
          var apy= amount*duration/100;
          //console.log(apy);
          document.getElementById('apy').value= apy;
          if (duration == <?php echo $data['mstaking']->days_90 ?>) {
            dailyAmount= apy/4;
            days= 90;
            daily_value= dailyAmount/days;
            document.getElementById('dailyAmount').value= dailyAmount;
            document.getElementById('days').value= days;
             document.getElementById('dailyvalue').value= daily_value;
          }
          else if (duration == <?php echo $data['mstaking']->days_180 ?>) {
            dailyAmount= apy/2;
            days= 180;
            daily_value= dailyAmount/days;
            document.getElementById('dailyAmount').value= dailyAmount;
            document.getElementById('days').value= days;
            document.getElementById('dailyvalue').value= daily_value;
          }
          else if (duration == <?php echo $data['mstaking']->days_365 ?>) {
            dailyAmount= apy;
            days= 365;
            daily_value= dailyAmount/days;
            document.getElementById('dailyAmount').value= dailyAmount;
            document.getElementById('days').value= days;
            document.getElementById('dailyvalue').value= daily_value;
          }
          else if (duration == <?php echo $data['mstaking']->days_730 ?>) {
            dailyAmount= apy*2;
            days= 730;
            daily_value= dailyAmount/days;
            document.getElementById('dailyAmount').value= dailyAmount;
            document.getElementById('days').value= days;
            document.getElementById('dailyvalue').value= daily_value;
          }
          else if (duration == <?php echo $data['mstaking']->days_1825 ?>) {
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

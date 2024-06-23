@extends('user.layouts.master')


@section('user_content')

<style>
       .text-right{
           text-align: right;
       }
   </style>

                  <div class="container">
              <h6 id="text-purple">Available Amount: {{$data['sum_deposit'] ? number_format((float)$data['sum_deposit'], 2, '.', ''). ' $' : '00.00 $'}}</h6>
              <hr>
              <h4 class="btn btn-success">Simple Earn</h4>
               <h4 class="btn btn-success">Flexible Savings</h4>
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
                          <h4 class="card-title">Simple Earn</h4>
                       </div>

                    </div>
                    <div class="card-body">
                       <form id="stakingForm" class="col-lg-12" method="post" action="{{route('buy-mstaking')}}">
                         @csrf
                         <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Avl. Balance ($)</span>
                               <input type="text" disabled class="form-control col-lg-8" value="{{$data['sum_deposit'] ? number_format((float)$data['sum_deposit'], 2, '.', ''). ( ' $') : '00.00 $'}}" >
                            </div>
                         </div>
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Enter Amount ($)</span>
                               <input type="text" min="{{$data['mstaking']->min_staking}}" max="{{$data['mstaking']->max_staking}}" name="amount"  class="form-control col-lg-8" id="amount" required>
                            </div>

                         </div>
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Duration</span>
                               <select class="form-control col-lg-8" onchange="calculate()" id="duration"  name="duration" required>
                                 <option value="">Select Days</option>
                                <!-- <option value="{{$data['mstaking']->days_90}}">90 Days</option> -->
                                <!-- <option value="{{$data['mstaking']->days_180}}">180 Days</option> -->
                                 <option value="{{$data['mstaking']->days_365}}">365 Days</option>
                                 <option value="{{$data['mstaking']->days_730}}">730 Days</option>
                                 <option value="{{$data['mstaking']->days_1825}}">1825 Days</option>


                               </select>

                            </div>
                         </div>
                         <input type="hidden" name="days" id="days" value="">
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >APY Value ($)</span>
                               <input type="text" id="apy" readonly class="form-control col-lg-8" name="apy_value"  required>
                            </div>

                         </div>
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Total Staking Value ($)</span>
                               <input type="text" id="dailyAmount" name="total_value" readonly class="form-control col-lg-8" value="" required>
                            </div>
                         </div>
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Your Daily Bonus ($)</span>
                               <input type="text" id="dailyvalue" name="daily" readonly class="form-control col-lg-8" value="" required>
                            </div>
                         </div>



                         <div class="d-flex justify-content-center">


                          <div class="text-center">
                             <div class="d-grid gap-card">
                                
                                 @if(Auth::user()->status == 0)
                                 <button class="btn btn-danger" disabled type="submit" disabled>
                                   <span>STAKE</span>
                                   <svg class="rotate-45" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </button>
                                @else
                                <button id="stakingButton" class="btn btn-success" type="submit" disabled>
                                   <span>STAKE</span>
                                   <svg class="rotate-45" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </button>
                               
                                @endif
                                

                             </div>
                          </div>
                          </div>
                       </form>
                        <div id="having-coupon" class="mt-3">
                                 <h6>
                                   <span>Having a coupon? <a href="#" id="coupon-link" style="color:green;">Click here</a></span>
                                   
                                </h6>
                                </div>
                                <!--<div id="coupon-label" style="display: none;"><h6>Enter the coupon code below: </h6></div>-->
                               <div id="coupon-container" class="mt-2" style="display: none;">
                                   <input type="text" id="coupon-input" class="form-control" placeholder="Enter coupon code">
                                   <!--<button id="apply-button" class="btn btn-primary mt-2" disabled>Apply</button>-->
                                   <div id="coupon-message"></div>
                                </div>
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
  
  var amount = document.getElementById('amount').value;
  //var amount = parseFloat(amountInput.val());
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

const couponLink = document.getElementById('coupon-link');
   const couponContainer = document.getElementById('coupon-container');
   const couponInput = document.getElementById('coupon-input');
   //const couponlabel = document.getElementById('coupon-label').style.display == 'none';

   // Add a click event listener to the link
   couponLink.addEventListener('click', function() {
      // alert("success");
   //   const havingcoupon = document.getElementById('having-coupon').hide();
    //  const couponlabel = document.getElementById('coupon-label').show();
      
      // Show/hide the coupon container based on its current display style
      if (couponContainer.style.display === 'none') {
         couponContainer.style.display = 'block';
         couponInput.focus(); // Optionally, focus the input field when shown
      } else {
         couponContainer.style.display = 'none';
      }
   });
   
  $(document).ready(function() {
      const couponInput = $('#coupon-input');
      const applyButton = $('#apply-button');
      const couponMessage = $('#coupon-message');
      const amountInput = $('#amount');
     

      couponInput.on('input', function() {
         const couponCode = couponInput.val();

         // Send an AJAX request to the server for coupon validation
         $.ajax({
            url: '{{ route('validate-coupon') }}',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify({ couponCode }),
            contentType: 'application/json',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
   if (response.valid) {
      couponMessage.text('Coupon is valid.');
      couponMessage.css('color', 'green');
      applyButton.prop('disabled', false);

      // Set the coupon value as the input value
      amountInput.val(response.coupon_value);
      const hiddenInput = $('<input>').attr({
                        type: 'hidden',
                        name: 'coupon_code',
                        value: response.coupon_code
                    });
                    $('form').append(hiddenInput);
   } else {
      couponMessage.text('Coupon is not valid.');
      couponMessage.css('color', 'red');
      applyButton.prop('disabled', true);
   }

   // Update the calculation based on the coupon value
   calculate();
}
         });
      });
      
   });
   
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
    
    $(document).ready(function() {
    $('#duration').on('change', function(e) {
        if ($(this).val() !== '') {
            $('#stakingButton').prop('disabled', false);
        } else {
            $('#stakingButton').prop('disabled', true);
        }
    });
});
</script>

@endpush


@endsection

@extends('user.layouts.master')


@section('user_content')
<div class="section-admin container-fluid mg-b-30">
   <div class="row admin text-center">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="admin-content res-mg-t-15 d-flex row justify-content-between">
               <div class="row page-top-section">
                   <!-- breadcome title Section  -->
                   <div class="col-sm-6 breadcome-heading">
                       <h3>Become A Merchant</h3>
                   </div>
                   <div class="col-sm-6">
                       <div class=" breadcome-price-section">
                           <p class="breadcome-section-name">Available Balance:</p>
                           <p class="breadcome-section-price">{{$data['sum_deposit'] ? number_format((float)$data['sum_deposit'], 2, '.', ''). ' $' : '00.00 $'}}</p>
                       </div>
                   </div>
               </div>
               <div class="col-lg-12 musd-page-btn-sec">
                   <div class="row page-section-btn pay-button">
                       <div class="col-sm-6">
                           <div class="btn-1">
                               <button type="button" data-toggle="modal" data-target="#mindSimpleEarn" data-whatever=""  class="page-button">Become A Merhcant</button>
                               <div class="modal withdraw-modal fade" id="mindSimpleEarn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header text-left">
                                       <h4 class="modal-title">Become A Merhcant</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                       </div>
                                       <div class="modal-body text-left">
                                           <form>
                                               <div class="form-group">
                                               <label for="usdt-amount-deposit" class="col-form-label">Amount</label>
                                               <input type="text" class="form-control" id="usdt-amount-deposit">
                                               </div>
                                               <div class="form-group">
                                               <label for="usdt-hash-deposit" class="col-form-label">Transaction Hash</label>
                                               <input type="text" class="form-control" id="usdt-hash-deposit">
                                               </div>
                                               <div class="modal-footer">
                                               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                               <button type="button" class="btn btn-primary">Confirm</button>
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                                   </div>
                               </div>
                           </div>
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
                                       <h4 class="mg-t-15 mg-t-30">Become A Merhcant</h4>
                                   </div>
                                   <div class="card-content mg-t-30">
                                       <form method="post" action="{{route('store-merchant')}}">
                                          @csrf
                                          <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                           <div class="form-group">
                                               <label for="availableBalance" class="col-form-label" >Available Balance</label>
                                               <input type="text" class="form-control" id="availableBalance" disabled value="{{$data['sum_deposit'] ? number_format((float)$data['sum_deposit'], 2, '.', ''). ' $' : '00.00 $'}}" >
                                           </div>
                                           @php 
                         
                                           $merchant= App\Models\MerchantSetting::first();
                                           @endphp
                                           <div class="form-group">
                                               <label for="availableTokens" class="col-form-label">Deposit Amount ($)</label>
                                               <input type="text"  class="form-control token-amount" id="availableTokens" value="{{$merchant->deposit_amount}}" name="amount">
                                           </div>
                                             <div class="form-group">
                                               <label for="apyValue" class="col-form-label">Bonus (%)</label>
                                               <input type="text" class="form-control" value="{{$merchant->bonus}}" name="bonus">
                                             </div>

                                          @php 
                                          $bonus_amount = $merchant->deposit_amount + ($merchant->deposit_amount*$merchant->bonus/100) ; 
                                          @endphp
                                             <div class="form-group">
                                               <label for="totalStakingValue" class="col-form-label">Total Amount You Get ($)</label>
                                               <input width="100%" type="text" class="form-control " id="totalStakingValue" readyonly value="5500" name="bonus_amount">
                                             </div>
                                             @if(Auth::user()->merchant_status == 1)
                                             <button disabled class="bmind-btn mg-t-15">Already A Marchent</button>
                                             @else
                                             <button type="submit" class="bmind-btn mg-t-15">Become A Marchent</button>
                                             @endif
                                         </form>
                                         
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('submitButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('submitForm').submit();
                }
            });
        });
    });
</script>

@endpush


@endsection

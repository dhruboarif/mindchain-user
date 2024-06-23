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
              <h4 class="btn btn-primary">Become A Merchant</h4>
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
                          <h4 class="card-title">Become A Merhcant</h4>
                       </div>

                    </div>
                    <div class="card-body">
                       <form class="col-lg-12" method="post" action="{{route('store-merchant')}}">
                         @csrf
                         <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Avl. Balance ($)</span>
                               <input type="text" disabled class="form-control col-lg-8" value="{{$data['sum_deposit'] ? number_format((float)$data['sum_deposit'], 2, '.', ''). ( ' $') : '00.00 $'}}" >
                            </div>
                         </div>
                         @php 
                         
                         $merchant= App\Models\MerchantSetting::first();
                         @endphp
                         <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Deposit Amount ($)</span>
                               <input type="text" readonly min="" max="" value="{{$merchant->deposit_amount}}" name="amount"  class="form-control col-lg-8" id="amount" required>
                            </div>

                         </div>
                          <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Bonus (%)</span>
                               <input type="text" readonly min="" max="" value="{{$merchant->bonus}}" name="bonus"  class="form-control col-lg-8" id="amount" required>
                            </div>

                         </div>
                         @php 
                         $bonus_amount = $merchant->deposit_amount + ($merchant->deposit_amount*$merchant->bonus/100) ; 
                         
                         @endphp
                          <div class="form-group mb-3">
                            <div class="input-group pt-1">
                               <span style="width: 55%;" class="input-group-text" >Total Amount You Get ($)</span>
                               <input type="text" readonly min="" max="" value="{{$bonus_amount}}" name="bonus_amount"  class="form-control col-lg-8" id="amount" required>
                            </div>

                         </div>
                       
                         


                         <div class="d-flex justify-content-center">


                          <div class="text-center">
                             <div class="d-grid gap-card">
                                
                                 @if(Auth::user()->merchant_status == 1)
                                 <button class="btn btn-success" disabled type="submit">
                                   <span>ALREADY A MERCHANT</span>
                                   <svg class="rotate-45" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </button>
                                @else
                                <button class="btn btn-success" type="submit">
                                   <span>APPLY</span>
                                   <svg class="rotate-45" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
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

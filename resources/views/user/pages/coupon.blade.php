@extends('user.layouts.master')


@section('user_content')
   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">
                <div class="col">
                    <div class="card">
                    @include('sweetalert::alert')
                    @if(Session::has('coupon_added'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
         <svg class="bi flex-shrink-0 me-2" width="24" height="24">
             <use xlink:href="#check-circle-fill" />
         </svg>
         <div>
             {{Session::get('coupon_added')}}
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
                    <div class="card-body">
                        <h2 class="card-title">Marchent Dashboard</h2>
                        <br>
                         <a class="btn btn-primary float-right" href="#" data-bs-toggle="modal" data-bs-target="#createcoupon">Create Coupon</a>
                       @include('user.modals.createcouponmodal')
                        <hr>
                        
                        <h6>Available Balance: {{$data['sum_deposit_coupon'] ? '$'.number_format((float)$data['sum_deposit_coupon'], 2, '.', '') : '$00.00'}}</h6>
                        <br>
                        <div class="bd-example table-responsive">
                               <table id= "myTable" class="table table-bordered table-border">
                                   <thead>
                                       <tr>
                                           <th scope="col">#</th>
                                          <th scope="col">COUPON CODE</th>
                                           <th scope="col">COUPON VALUE</th>
                                           <th scope="col">COUPON VALIDITY</th>
                                           <th scope="col">COUPON USED BY</th>


                                           <th scope="col">CREATED AT</th>
                                           <th scope="col">ACTION</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                     @foreach($data['coupons'] as $row)
                                       <tr>
                                          <td >{{$loop->index+1}}</td>
                                          <td>{{$row->coupon_code}}</td>

                                          <td>{{$row->coupon_value}}</td>


                                            <td>
                                                @if($row->validity == 0)
                                                <span class="badge badge-success">Valid</span>
                                                
                                                
                                                @else 
                                                 <span class="badge badge-danger">Used</span>
                                                
                                                @endif
                                                </td>
                                            <td>
                                                @if($row->owned_by != null)
                                                {{$row->owned->user_name}}
                                                @else 
                                                -- 
                                                @endif
                                                </td>
                                            <td>{{$row->created_at}}</td>
                                            <td></td>
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

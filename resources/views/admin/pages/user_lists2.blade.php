@extends('admin.layouts.master')


@section('admin_content')
   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">
                <div class="col">
                    <div class="card">
                          @if(Session::has('password_changed'))
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('password_changed')}}
           </div>
       </div>
        @elseif(Session::has('ambassador_added'))
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('ambassador_added')}}
           </div>
       </div>
       @elseif(Session::has('kyc_approved'))
                     <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24">
              <use xlink:href="#check-circle-fill" />
          </svg>
          <div>
              {{Session::get('kyc_approved')}}
          </div>
      </div>
       @endif
                    <div class="card-body">
                        <h2 class="card-title">User Lists</h2>
                        <!-- <a class="btn btn-primary float-right" href="#" data-bs-toggle="modal" data-bs-target="#accountinfoadd">Add New User</a> -->
                        <hr>
                        <div class="bd-example table-responsive">
                               <table id="myTable" class="table table-bordered table-border">
                                   <thead>
                                       <tr>
                                           <th scope="col">#</th>
                                           <th scope="col">IMAGE</th>
                                           <th scope="col">USERNAME</th>
                                           <th scope="col">FULLNAME</th>
                                           <th scope="col">REFERRAL ID</th>
                                           <th scope="col">EMAIL</th>
                                           <th scope="col">ACTION</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                     @foreach($users as $row)
                                       <tr>
                                          <td >{{$loop->index+1}}</td>
                                          <td><img src="{{asset('/images/demo (1).jpg')}}" class="img-fluid avatar avatar-50 avatar-rounded"></td>
                                          <td>{{$row->user_name}}
                                          @if($row->status == '0')
                                          <h6 style="color:red;">(Blocked)</h6>
                                          @endif
                                          </td>
                                          <td>{{$row->name}}</td>
                                           <td>{{$row->sponsors->user_name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td><a href="#"data-bs-toggle="modal" data-bs-target="#userview{{$row->id}}"><i class="fa-solid fa-eye"></i> </a>
                                            <a href="#"data-bs-toggle="modal" data-bs-target="#passwordchange{{$row->id}}"> <i class="fa-solid fa-key"></i> </a>
                                            <a href="#"data-bs-toggle="modal" data-bs-target="#makeambassador{{$row->id}}"><i class="fa-solid fa-ranking-star"></i> </a>
                                            @if($row->status == '1')
                                            <a href="#"data-bs-toggle="modal" data-bs-target="#userrestrict{{$row->id}}"><i class="fa-solid fa-skull-crossbones"></i> </a>
                                            @else
                                            <a href="#"data-bs-toggle="modal" data-bs-target="#userunrestrict{{$row->id}}"><i class="fa-solid fa-skull-crossbones"></i> </a>
                                            @endif


                                            </td>
                                       </tr>
                                       @include('admin.modals.user_viewmodal')
                                        @include('admin.modals.passwordchangemodal')
                                        @include('admin.modals.makeambassadormodal')
                                        @if($row->status== '1')
                                         @include('admin.modals.userrestrict')
                                         @else
                                         @include('admin.modals.userunrestrict')
                                         @endif

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

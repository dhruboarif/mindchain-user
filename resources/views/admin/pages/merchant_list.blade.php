@extends('admin.layouts.master')


@section('admin_content')
   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">
                <div class="col">
                    <div class="card">
                         
        @if(Session::has('Money_added'))https://github.com/ajaxorg/ace/wiki/Default-Keyboard-Shortcuts
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('Money_added')}}
           </div>
       </div>
       @elseif(Session::has('token_added'))
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('token_added')}}
           </div>
       </div>
       @endif
                    <div class="card-body">
                        <h2 class="card-title">Merchant Lists</h2>
                        
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
                                           
                                       </tr>
                                   </thead>
                                   <tbody>
                                     @foreach($users as $row)
                                       <tr>
                                          <td >{{$loop->index+1}}</td>
                                          <td><img src="{{asset('/images/demo (1).jpg')}}" class="img-fluid avatar avatar-50 avatar-rounded"></td>
                                          <td>{{$row->user_name}}</td>
                                          <td>{{$row->name}}</td>
                                           <td>{{$row->sponsors->user_name}}</td>
                                            <td>{{$row->email}}</td>
                                           
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

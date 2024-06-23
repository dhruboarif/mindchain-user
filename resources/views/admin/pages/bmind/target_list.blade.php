@extends('admin.layouts.master')


@section('admin_content')
   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">
                <div class="col">
                    <div class="card">
                          @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @if(Session::has('Money_added'))
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
                        <h2 class="card-title">Bmind Target Lists</h2>
                        <a class="btn btn-primary float-right" href="#" data-bs-toggle="modal" data-bs-target="#add_bmind_target">Add Target</a>
                        @include('admin.modals.add_bmind_target')
                        <div class="bd-example table-responsive">
                               <table id="myTable" class="table table-bordered table-border">
                                   <thead>
                                       <tr>
                                           <th scope="col">#</th>
                                           <th scope="col">IMAGE</th>
                                           <th scope="col">USERNAME</th>
                                           <th scope="col">Start Date</th>
                                           <th scope="col">End Date</th>
                                           <th scope="col">Target Amount</th>
                                           <th scope="col">Achieved Amount</th>
                                           <th scope="col">Status</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                              
                                     @foreach($target as $row)
                                       <tr>
                                          <td >{{$loop->index+1}}</td>
                                          <td><img src="{{asset('/images/demo (1).jpg')}}" class="img-fluid avatar avatar-50 avatar-rounded"></td>
                                          <td>{{$row->user->user_name}}</td>
                                          <td>{{$row->start_date}}</td>
                                          <td>{{$row->end_date}}</td>
                                          <td>{{$row->target_amount}}</td>
                                           <td>{{$row->user->bmind_team_invest}}</td>
                                            <td>{{ $row->status == 1 ? 'Active' : '' }}</td>

                                           <!--<td>-->
                                           <!--    <button class="btn btn-danger remove_consultant" data-id="{{$row->id}}">-->
                                           <!--        <i class="fa fa-times-circle"></i>-->
                                           <!--    </button>-->
                                           <!--</td>-->
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


@push('scripts')
        <script>
        $("body").on("keyup", "#sponsor4", function () {
        //alert('success');
            let searchData = $("#sponsor4").val();
            if (searchData.length > 0) {
                $.ajax({
                    type: 'POST',
                    url: '{{route("get-users")}}',
                    data: {search: searchData},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (result) {
                        $('#suggestUser4').html(result.success)
                        console.log(result.data)
                        // if (result.data) {
                        //     $("#position").val("");
                        //     $("#placement_id").val("");
                        //     $("#position").removeAttr('disabled');
                        // } else {
                        //     $("#position").val("");
                        //     $("#placement_id").val("");
                        //     $('#position').prop('disabled', true);
                        // }
                    }
                });
            }
            if (searchData.length < 1) $('#suggestUser4').html("")
        })

        </script>
@endpush

@endsection




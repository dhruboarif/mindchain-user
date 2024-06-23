@extends('admin.layouts.master')


@section('admin_content')
   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">
                <div class="col">
                    <div class="card">
                         
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
                        <h2 class="card-title">Consult Lists</h2>
                        <a class="btn btn-primary float-right" href="#" data-bs-toggle="modal" data-bs-target="#add_consultant">Add Consultant</a>
                        @include('admin.modals.add_consultant')
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
                                           <th scope="col">Action</th>
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
                                           <td>
                                               <button class="btn btn-danger remove_consultant" data-id="{{$row->id}}">
                                                   <i class="fa fa-times-circle"></i>
                                               </button>
                                           </td>
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
@push('scripts')
<script>
$(document).ready(function() {
  $('#username_search').keyup(function() {
    var input = $(this).val(); // Get the input value
    
    // Perform AJAX request
    $.ajax({
      url: '{{route("admin-consultant-store")}}', // Replace with your actual API endpoint
      method: 'GET',
      data: { search: input },
      success: function(response) {
        var userList = $('#userList'); // Get the user list element
        
        // Clear previous search results
        userList.empty();
        console.log(response);
        // Check if response is an array
        if (Array.isArray(response.data)) {
          // Append each user to the list
          response.data.forEach(function(user) {
            userList.append('<li class="list-group-item list-group-item-action text-light" onclick="store_user('+ user.id +')">' + user.name + '</li>');
          });
        } else {
          console.log('Invalid response format. Expected an array.');
        }
      },
      error: function() {
        console.log('Error occurred during AJAX request');
      }
    });
  });
  
  
  $('.remove_consultant').click(function(e) {
      e.preventDefault();
      sweetAlert('Remove Consultant', 'Do you want to remove consultant', 'warning').then(click => {
        $.ajax({
            url: '{{route("remove-consultant")}}',
            method: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                type: 'json'
            },
            success: function(resp) {
                if(resp.status == 'success') {
                    window.location.reload();
                }
            }
        })
      });
  })
    
});
function store_user(id)
 {
    $.ajax({
        url: '{{route("make-consultant")}}',
        method: 'POST',
        data: {
            _token: '{{csrf_token()}}',
            id: id,
            type: 'json'
        },
        success: function(resp) {
            if(resp.status == 'success') {
                window.location.reload();
            }
        }
    })
 }
</script>
@endpush
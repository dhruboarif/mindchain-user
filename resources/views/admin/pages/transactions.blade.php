@extends('admin.layouts.master')


@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">


   <!--<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">-->
   <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
   <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>-->
   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>-->
   <!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
   <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>-->
   
   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
   <!--<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>-->
   
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  @push('style')
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
      <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/2.0.0-beta1/css/bootstrap-select.min.css" integrity="sha512-Q8vAB6GL+zb917fZJJJxO8TKJH5lZKsqnEDO+0oUjy5wpc/jYo5QpMuMx84n8m/gY/DitaK1j2DQeb/Vosudtg==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
    <style>
        .result-item {
          display: none;
          animation: fade-in 0.5s ease-in-out;
        }
        
        @keyframes fade-in {
          0% {opacity: 0;}
          100% {opacity: 1;}
        }
        .username-option.hovered {
            background: #fff;
            color: #000;
            padding: 2px 10px;
        }
        .username-option.hovered:hover {
            background: #ff971d;
        }
        div#result {
            border: 1px solid #ff971d;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
  @endpush
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  
  <!-- Bootstrap Select Picker CSS CDN -->


  <!-- jQuery CDN -->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>-->
  <!-- Bootstrap JS CDN -->
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
  
  <!-- Bootstrap Select Picker JS CDN -->
  




   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">

                <div class="col">
                    <div class="card">
                        @if(Session::has('token_rate_updated'))
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('token_rate_updated')}}
           </div>
       </div>
       @elseif(Session::has('ambassador_updated'))
       <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24">
        <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
        {{Session::get('ambassador_updated')}}
        </div>
        </div>
        @elseif(Session::has('transfer_updated'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
         <svg class="bi flex-shrink-0 me-2" width="24" height="24">
         <use xlink:href="#check-circle-fill" />
         </svg>
         <div>
         {{Session::get('transfer_updated')}}
         </div>
         </div>
         @elseif(Session::has('withdraw_updated'))
         <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24">
          <use xlink:href="#check-circle-fill" />
          </svg>
          <div>
          {{Session::get('withdraw_updated')}}
          </div>
          </div>


       @endif

                    <div class="card-body">
                        <h2 class="card-title">Transactions Report</h2>




                          <hr>
                        <div class="bd-example">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="form-group">
                    <lable>Select User</lable>
                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                    <div class="d-none" id="result"></div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="form-group">
                  <label for="datepicker">Start Date:</label>
                  <div class="input-group date">
                    <input type="text" class="form-control" id="start_date">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                  </div>
                </div>
            </div>
            <div class="col-12 col-sm-3">
                <div class="form-group">
                  <label for="datepicker">End Date:</label>
                  <div class="input-group date">
                    <input type="text" class="form-control" id="end_date">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                  </div>
                </div>
            </div>
            <div class="col-12 col-sm-2">
                <div class="form-group">
                    <lable>Type:</lable>
                    <select class="form-control" name="type">
                        <option value="CashWallet">Cash Wallet</option>
                        <option value="TokenWallet">Token Wallet</option>
                        <option value="BonusWallet">Bonus Wallet</option>
                        <option value="StakingWallet">Staking wallet</option>
                        <option value="AmbassadorWallet">Ambassador Wallet</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-1 align-self-center">
                <div class="form-group">
                    <button type="submit" id="submitButton" class="btn btn-icon btn-primary mt-0 mt-sm-4"><i class="fa fa-search-plus"></i></button>
                </div>
            </div>
        </div>
          <!--<ul class="nav nav-pills" data-toggle="slider-tab" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="logo-tab" data-bs-toggle="tab" data-bs-target="#pills-logo1" type="button" role="tab" aria-controls="logo" aria-selected="true">CashWallet</button>
              </li>
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="icon-tab" data-bs-toggle="tab" data-bs-target="#pills-icon1" type="button" role="tab" aria-controls="icon" aria-selected="false">TokenWallet</button>
              </li>
              <li class="nav-item" role="presentation">
                  <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#pills-info1" type="button" role="tab" aria-controls="info" aria-selected="false">BonusWallet</button>
              </li>

          </ul>-->
          <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-logo1" role="tabpanel"
                  aria-labelledby="pills-logo-tab1">
                  <p>
                    <h6 class="text-left" id="amount"></h6>
                  <hr>
                  <div class="bd-example table-responsive">
                         <table  class="table table-bordered table-border yajra-datatables1">
                             <thead>
                                 <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">DATE</th>
                                     <th scope="col">USERNAME</th>
                                     
                                        <th scope="col"> CATEGORY</th>
                                           <th scope="col">RCVD FRM/PAY TO</th>
                                              <th scope="col">DESCRIPTION</th>
                                                 <th scope="col">AMOUNT</th>

                                     <th scope="col">TYPE</th>

                                 </tr>
                             </thead>


                           




                             </tbody>
                         </table>
                     </div>

                  </p>

              </div>
              <!--<div class="tab-pane fade" id="pills-icon1" role="tabpanel"
                  aria-labelledby="pills-icon-tab1">
                  <p>


                            <h6 class="text-left">Token Balance:  {{$data['sum_deposit_token'] ? number_format((float)$data['sum_deposit_token'], 2, '.', '') : '00.00'}}</h6>
                              <hr>
                              <div class="bd-example table-responsive">
                                     <table class="table table-bordered table-border yajra-datatables2">
                                         <thead>
                                             <tr>
                                               <th scope="col">#</th>
                                               <th scope="col">DATE</th>
                                               <th scope="col">USERNAME</th>
                                                  <th scope="col"> CATEGORY</th>
                                                     <th scope="col">RCVD FRM/PAY TO</th>
                                                        <th scope="col">DESCRIPTION</th>
                                                           <th scope="col">AMOUNT/th>

                                               <th scope="col">TYPE</th>

                                             </tr>
                                         </thead>

                                        



                                         </tbody>
                                     </table>
                                 </div>
                  </p>

              </div>
              <div class="tab-pane fade" id="pills-info1" role="tabpanel"
                  aria-labelledby="pills-info-tab1">
                  <p>


                      <h6 class="text-left">Bonus Balance:  {{$data['sum_deposit_bonus'] ? number_format((float)$data['sum_deposit_bonus'], 2, '.', '') : '00.00'}}</h6>
                      <hr>
                      <div class="bd-example table-responsive">
                             <table  class="table table-bordered table-border yajra-datatables3" >
                                 <thead> 
                                     <tr>
                                       <th scope="col">#</th>
                                       <th scope="col">DATE</th>
                                        <th scope="col">USERNAME</th>
                                          <th scope="col"> CATEGORY</th>
                                             <th scope="col">RCVD FRM/PAY TO</th>
                                                <th scope="col">DESCRIPTION</th>
                                                   <th scope="col">AMOUNT</th>

                                       <th scope="col">TYPE</th>

                                     </tr>
                                 </thead>


                              





                                 </tbody>
                             </table>
                         </div>
                  </p>


              </div>-->

          </div>
      </div>


                    </div>

                    </div>
                </div>


            </div>
        </div>
@endsection
@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function() {
  /*$('#user-select').selectpicker({
    liveSearch: false,
    showTick: true
  });*/
  
  /*$('#user-select').on('loaded.bs.select', function() {
    // Make AJAX call to fetch user data
    url = href.searchParams.set(':aa', 'dogs');
    $.ajax({
      url: 'fetch-users.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Populate select options with fetched user data
        $.each(data, function(index, user) {
          $('#user-select').append('<option value="' + user.id + '">' + user.name + '</option>');
        });
        
        // Refresh select picker to apply new options
        $('#user-select').selectpicker('refresh');
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  });*/
  $('#start_date').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    orientation: 'bottom'
  });
  $('#end_date').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    orientation: 'bottom'
  });
/*  var table = $('.yajra-datatables1').DataTable({
  processing:true,
  serverSide:true,
  ajax:"{{route('cash-wallet-transaction')}}",
  data:{
    user_id: $('#user-select').val(),
    start_date: $('#start_date').val(),
    end_date: $('#end_date').val(),
    type: $('select[name="type"]').val(),
  },
  columns:[
    {data:'DT_RowIndex',name:'DT_RowIndex'},
    {data:'created_at',name:'created_at'},
    {data:'user_name',name:'user_name'},
    {data:'method',name:'method'},
     {data:'received_from',name:'recieved_from'},
    // {data:'name',name:'name'},
    //{data:'sponsor',name:'sponsors.user_name'},
     {data:'description',name:'description'},
      {data:'amount',name:'amount'},
    {data:'type',name:'type'},
    

  ]
})
// add event listeners to input fields
$('#user-select, #start_date, #end_date, select[name="type"]').change(function() {
  // reload datatable with updated parameters
  table.ajax.reload();
});*/
var table = $('.yajra-datatables1').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('cash-wallet-transaction') }}",
      data: function(d) {
        d.user_id = $('#username').attr('data-user-id');
        d.start_date = $('#start_date').val();
        d.end_date = $('#end_date').val();
        d.type = $('select[name="type"]').val();
      }
    },
    drawCallback: function(settings) {
        var api = this.api();
        var data = api.ajax.json();
        $('#amount').text(data.amount);
      },
    columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex' },
      { data: 'created_at', name: 'created_at' },
      { data: 'user_name', name: 'user_name' },
      { data: 'method', name: 'method' },
      { data: 'received_from', name: 'received_from' },
      { data: 'description', name: 'description' },
      { data: 'amount', name: 'amount' },
      { data: 'type', name: 'type' },
    ]
  });
  /*$('#username').on('input', function() {
    var username = $(this).val();
    if (username.length >= 3) { // only send request if username length is 3 or more
      $.ajax({
        url: '{{route("search_user")}}',
        type: 'POST',
        data: {
            _token: '{{csrf_token()}}',
            username: username
        },
        success: function(data) {
          $('#result').html(''); // clear previous results
          //var usernames = JSON.parse(data);
          $.each(data, function(index, value) {
            var $resultItem = $('<div class="result-item">' + value.user_name + '</div>');
            $resultItem.appendTo('#result').fadeIn();
          });
        }
      });
    } else {
      $('#result').html(''); // clear results if username length is less than 3
    }
  });*/

    $('#username').on('input', function() {
    var username = $(this).val();
    if (username.length >= 2) { // only send request if username length is 2 or more
      $.ajax({
        url: '{{route("search_user")}}',
        type: 'POST',
        data: {
            _token: '{{csrf_token()}}',
            username: username
        },
        success: function(data) {
          $('#result').html(''); // clear previous results
          //var usernames = JSON.parse(data);
          $.each(data, function(index, value) {
              $('#result').removeClass('d-none');
            $('#result').append('<div class="username-option" data-user-id="'+value.id+'">' + value.user_name + '</div>');
          });

          // Add click event listener to each username option
          $('.username-option').click(function() {
            var selectedUsername = $(this).text();
            var user_id = $(this).attr('data-user-id');
            $('#username').val(selectedUsername);
            $('#username').attr('data-user-id', user_id);
            $('#username').removeClass('is-invalid');
            $('#result').html('');
            $('#result').addClass('d-none');
          });

          // Add hover effect to username options
          $('.username-option').hover(function() {
            $(this).addClass('hovered');
          }, function() {
            $(this).removeClass('hovered');
          });
        }
      });
    } else {
      $('#result').html(''); // clear results if username length is less than 2
    }
  });

  // Handle form input changes
  /*$('#user-select, #start_date, #end_date, select[name="type"]').on('change', function() {
    table.draw(); // Redraw the DataTables table when form input changes
  });*/
  $('#submitButton').on('click', function() {
      if($('#username').val() == '') {
          $('#username').addClass('is-invalid');
      } else {
          table.draw();
      }
     // Redraw the DataTables table when form input changes
  });
});
</script>
@endpush

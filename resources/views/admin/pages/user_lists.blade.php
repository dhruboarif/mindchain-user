@extends('admin.layouts.master')


@section('admin_content')
<meta name="csrf-token" content="{{ csrf_token() }}">


   <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
       @elseif(Session::has('consultant_added'))
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('consultant_added')}}
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
                               <table class="table table-bordered yajra-datatables">
                                   <thead>
                                       <tr>
                                           <th scope="col">#</th>
                                           {{--<th scope="col">IMAGE</th> --}}
                                           <th scope="col">USERNAME</th>
                                           <!--<th scope="col">FULLNAME</th>-->
                                           <th scope="col">REFERRAL</th>
                                           <th scope="col">EMAIL</th>
                                           <th scope="col">ACTION</th>
                                       </tr>

                                   </thead>
                                  
                               </table>
                           </div>
                    </div>

                    </div>
                </div>


            </div>
        </div>


  @include('admin.modals.passwordchangemodal')
  @include('admin.modals.makeambassadormodal')
  @include('admin.modals.makeconsultantmodal')

   @include('admin.modals.userrestrict')

   @include('admin.modals.userunrestrict')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" charset="utf-8"></script>
<script type="text/javascript">
  $(function(){
    var table = $('.yajra-datatables').DataTable({
      processing:true,
      serverSide:true,
      ajax:"{{route('all-users')}}",
      columns:[
        {data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'user_name',name:'user_name'},
        // {data:'name',name:'name'},
        {data:'sponsors',name:'sponsors.user_name'},
        {data:'email',name:'email'},
        {
          data: 'action',
          name:'action',
          orderable:true,
          searchable:true
        },

      ]
    })
  });


</script>
<script type='text/javascript'>
   $(document).ready(function(){

      $('.yajra-datatables').on('click','.user_view',function(){
          var user_id = $(this).attr('data-id');
          
          
        
          //console.log(user_id);
          $.ajax({
                url: "/admin/get-user-id/" + user_id,
                type: "GET",
                success: function(response) {
                    var cash = response.cash;
                    var token = response.token;
                    var bonus = response.bonus;
                    var staking = response.staking;
                    
                    document.getElementById('cash').value= cash;
                    document.getElementById('token').value= token;
                    document.getElementById('bonus').value= bonus;
                    document.getElementById('staking').value= staking;
                }
            });
            $('#userview').modal('show');


            
            
          
         




      });
      $('.yajra-datatables').on('click','.password',function(){
          var user_id = $(this).attr('data-id');
          //alert(user_id);

          document.getElementById('user_id').value= user_id;
          $('#passwordchange').modal('show');
      });
      $('.yajra-datatables').on('click','.ambassador',function(){
          var user_id = $(this).attr('data-id');
          //alert(user_id);

          document.getElementById('ambassador').value= user_id;
          $('#makeambassador').modal('show');
      });
      $('.yajra-datatables').on('click','.consultant',function(){
          var user_id = $(this).attr('data-id');
          //alert(user_id);

          document.getElementById('consultant').value= user_id;
          $('#makeconsultant').modal('show');

      });
      $('.yajra-datatables').on('click','.userrestrict',function(){
          var user_id = $(this).attr('data-id');
          //alert(user_id);

          document.getElementById('userrestrict2').value= user_id;
          $('#userrestrict').modal('show');
         
      });
      $('.yajra-datatables').on('click','.userrunestrict',function(){
          var user_id = $(this).attr('data-id');
          //alert(user_id);

          document.getElementById('userunrestrict2').value= user_id;

          $('#userunrestrict').modal('show');
         

      });
      
       $('.yajra-datatables').on('click','.username',function(){
          var user_id = $(this).attr('data-id');
          
          
        
          //console.log(user_id);
          $.ajax({
                url: "/admin/get-profile/" + user_id,
                type: "GET",
                success: function(response) {
                     var user = response.user;
                     //var kycs= response.user.kycs;
                     // console.log(user.kycs);
                      //console.log(kycs);
                      //console.log(kycs);
                     var string1= "Not Submitted";
                     var string2= "Submitted";
                    // var token = response.token;
                    // var bonus = response.bonus;
                     $("#modal-username").html(user.user_name);
                    $("#modal-referral_link").html(user.referral_link);
                    $("#modal-name").html(user.name);
                   
                    $("#modal-birth").html(user.date_of_birth);
                    $("#modal-address").html(user.address);
                    $("#modal-city").html(user.city);
                    $("#modal-country").html(user.country);
                    $("#modal-postal_code").html(user.postal_code);
                    $("#modal-contact_no").html(user.contact);
                    $("#modal-email").html(user.email);
                    $("#modal-nid_passport").html(user.nid_passport);
                    $("#modal-gender").html(user.gender);
                    $("#modal-userid").html(user.id);
                    var userid= user.id;
                    $("#modal-userid").val(userid);
                    if(user.kyc == 0)
                    {
                        $("#modal-kyc").html(string1);
                    }else 
                    {
                        $("#modal-kyc").html(string2);
                    }
                    
                    // if(user.status == 'pending')
                    // {
                    //      $("#modal-approve").show();
                    //     $("#modal-href").show();
                    // }else
                    // {
                    //     $("#modal-approve").hide();
                    //     $("#modal-href").hide();
                    // }
                    
                    
                   
                    
                    var image = user.image;
                   // console.log(kyc.image);
                    var fullImagePath = "https://mindchainwallet.com/storage/documents/" + image;
                    $("#modal-image").attr("src", fullImagePath);
                    var image2 = user.image2;
                    var fullImagePath2 = "https://mindchainwallet.com/storage/documents/" + image2;
                    $("#modal-image2").attr("src", fullImagePath2);
                   var image3 = user.image3;
                    var fullImagePath3 = "https://mindchainwallet.com/storage/documents/" + image3;
                    $("#modal-image3").attr("src", fullImagePath3);
                    
                    
                    var hrefValue = "/home/kyc-verifications/reject/" + user.id;
                    $("#modal-href").attr("href", hrefValue);

       
                    // document.getElementById('cash').value= cash;
                    // document.getElementById('token').value= token;
                    // document.getElementById('bonus').value= bonus;
                }
            });
            $('#userprofile').modal('show');

      });


   });
   </script>

@include('admin.modals.user_viewmodal')
@include('admin.modals.userprofilemodal')

@endsection

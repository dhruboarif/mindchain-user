

<div class="modal fade text-left" id="userprofile"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">User Profile

                <button type="button" class="btn-primary close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              

            



   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">

                <div class="col">
                    <div class="card">
                        @if(Session::has('profile_updated'))
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('profile_updated')}}
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


       @endif

                    <div class="card-body">
                        <h2 class="card-title">User Profile Setting</h2>


                        <hr>
                        <div class="bd-example">
          <ul class="nav nav-pills" data-toggle="slider-tab" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#pills-profile1" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile Information</button>
              </li>

          </ul>

          <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-profile1" role="tabpanel"
                  aria-labelledby="pills-profile-tab1">
                  <p>
                    <div class="table-responsive">
                             <table border="0" width="100%" class="table table-active">
                                
                                 <tr>
                                     <td colspan="3"><h4>Basic Information</h4></td>
                                 </tr>
                                     <td width="30%" class="text-primary">Referral Id</td><td width="5%" class="text-primary"> : </td> <td width="65%" class="text-primary"><span id="modal-username"></span></td>
                                 <tr>
                                     <td width="30%" class="text-primary">Referral Link</td><td width="5%" class="text-primary"> : </td> <td width="65%" class="text-primary" ><span id="modal-referral_link"></span></td>
                                 </tr>
                                     <td width="30%">Name</td><td width="5%"> : </td> <td width="65%"><span id="modal-name"></span></td>
                                 <tr>
                                     <td>Gender</td><td> : </td> <td><span id="modal-gender"></span></td>
                                 </tr>
                                     <td>Date of Birth</td><td> : </td> <td><span id="modal-birth"></span></td>
                                 <tr>
                                     <td>Address</td><td> : </td> <td><span id="modal-address"></span></td>
                                 </tr>
                                 <tr><td>City</td><td> : </td> <td><span id="modal-city"></span></td></tr>
                                     
                                         <tr> <td>Country</td><td> : </td> <td><span id="modal-country"></span></td></tr>
                                    
                                 <tr>
                                     <td>Postal code</td><td> : </td> <td><span id="modal-postal_code"></span></td>
                                 </tr>
                                     <td>Contact No</td><td> : </td> <td><span id="modal-contact_no"></span></td>
                                 <tr>
                                     <td>Email</td><td> : </td> <td><span id="modal-email"></span></td>
                                 </tr>
                                      <tr>
                                     <td>NID/Passport Number</td><td> : </td> <td><span id="modal-nid_passport"></span></td>
                                 </tr>
                                 <tr>
                                     <td>Kyc Status</td><td> : </td> <td><span id="modal-kyc"></span></td>
                                 </tr>
                                     
                                   
                                 
                             </table>
                             {{--
                             <div id="modal-kycform">
                              <form id="" action="{{route('kyc-approve')}}" method="post">

          @csrf
          <input type="hidden" id="modal-userid" name="id" value="">
            <div class="modal-body">
              <section id="multiple-column-form">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">


                              <div class="card-body">
                                <h5 class="text-center">ID Card/Passport Front</h5>
                                <br>
                                <div class="d-flex justify-content-center">




                                    <img id="modal-image" src="" style="border-radius: 10%;" width="300" height="300">


                                  </div>
                                  <hr>
                                  <br>
                                  <h5 class="text-center">ID Card/Passport Back</h5>
                                  <br>
                                <div class="d-flex justify-content-center">

                                  <img id="modal-image2" src="" style="border-radius: 10%;" width="300" height="300">
                                </div>
                                <hr>
                                <br>
                                <h5 class="text-center">Proof of Address</h5>
                                <br>
                                <div class="d-flex justify-content-center">

                                  <img id="modal-image3" src="" style="border-radius: 10%;" width="300" height="300">
                                </div>




                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
         
               
                <button id="modal-approve" type="submit" class="btn btn-success" data-bs-dismiss="modal">Approve</button>


                <a id="modal-href" href="" type="submit" class="btn btn-danger" >Reject</a>
                 
          
              </form>
              </div> --}}

                  </p>

              </div>


          </div>
      </div>


                    </div>

                    </div>
                </div>


            </div>
        </div>






            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>


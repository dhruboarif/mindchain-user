@extends('user.layouts.master')


@section('user_content')



   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">

                <div class="col">
                    <div class="card">
                        @if(Session::has('document_added'))
                      <div class="alert alert-success d-flex align-items-center" role="alert">
           <svg class="bi flex-shrink-0 me-2" width="24" height="24">
               <use xlink:href="#check-circle-fill" />
           </svg>
           <div>
               {{Session::get('document_added')}}
           </div>
       </div>



       @endif

                    <div class="card-body">
                        <h2 class="card-title">Kyc Verification</h2>


                        <hr>
                        <div class="bd-example">


          <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-profile1" role="tabpanel"
                  aria-labelledby="pills-profile-tab1">
                  <p>
                    <div class="table-responsive">
                             <table border="0" width="100%" class="table table-active">

                                 <section id="multiple-column-form">
                                     <div class="row">
                                         <div class="col-12">
                                             <label class="mx-3 text-danger">* Max upload limit for kyc verification 1 MB.</label>
                                         </div>
                                         <div class="col-12">
                                             <div class="card">

                                                 <div class="card-body">
                                                   <?php
                                                   $kyc= App\Models\Kyc::where('user_id',Auth::id())->orderBy('id','desc')->first();

                                                    ?>
                                                    @if($kyc == null || $kyc->status== 'rejected')
                                                    @if($kyc != null && $kyc->status == 'rejected')
                                                    <h6 style="color:red;">Your kyc verification has been Rejected. Please Upload Proper Documents.</h6>
                                                    <br>

                                                    @endif



                                                 <form  method="post" action="{{route('kyc-store')}}" enctype="multipart/form-data" id="kycForm">
                                                   @csrf
                                                   <input type="hidden" name="id" value="{{Auth::user()->id}}">




                                                   <div class="row">
                                                     <div class="col-md-12">
                                                       <div class="mb-3">
                                                           <label for="exampleInputEmail1" class="form-label">NID/Passport Front</label>
                                                           <input type="file" id="image" name="file"  class="form-control @error('file') is-invalid @enderror" aria-describedby="emailHelp" required>

                                                       </div>
                                                         @error('file')
                                           <div class="d-block invalid-feedback" role="alert">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                                     </div>



                                                   </div>
                                                   <div class="row">
                                                     <div class="col-md-12">
                                                       <div class="mb-3">
                                                           <label for="exampleInputEmail1" class="form-label">NID/Passport Back</label>
                                                           <input type="file" id="image2" name="file2" class="form-control @error('file2') is-invalid @enderror" aria-describedby="emailHelp" required>

                                                       </div>
                                                         @error('file2')
                                           <div class="d-block invalid-feedback" role="alert">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                                     </div>



                                                   </div>
                                                   <div class="row">
                                                     <div class="col-md-12">
                                                       <div class="mb-3">
                                                           <label for="exampleInputEmail1" class="form-label">Proof of Address (Bank Statement/Electricity Bill)</label>
                                                           <input type="file" id="image3" name="file3"  class="form-control @error('file3') is-invalid @enderror" aria-describedby="emailHelp" required>

                                                       </div>
                                                         @error('file3')
                                           <div class="d-block invalid-feedback" role="alert">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                                     </div>



                                                   </div>
                                                   <div class="d-flex justify-content-center">
                                                     <button  class="btn btn-primary" id="kycSubmitHide" type="submit" >Submit</button>

                                                   </div>
                                                 </form>
                                                    @else
                                                    @if($kyc->status == 'pending')
                                                    <h6 style="color:red;">Your kyc verification is under review. Wait for Confirmation</h6>
                                                    <br>
                                                    <h5 class="text-center">ID Card/Passport Front</h5>
                                                    <br>
                                                    <div class="d-flex justify-content-center">




                                                        <img id="image_upload_preview" src="{{asset('storage/documents/'.$kyc->image)}}" style="border-radius: 10%;" width="300" height="300">


                                                      </div>
                                                      <hr>
                                                      <br>
                                                      <h5 class="text-center">ID Card/Passport Back</h5>
                                                      <br>
                                                    <div class="d-flex justify-content-center">

                                                      <img id="image_upload_preview" src="{{asset('storage/documents/'.$kyc->image2)}}" style="border-radius: 10%;" width="300" height="300">
                                                    </div>
                                                    <hr>
                                                    <br>
                                                    <h5 class="text-center">Proof of Address</h5>
                                                    <br>
                                                    <div class="d-flex justify-content-center">

                                                      <img id="image_upload_preview" src="{{asset('storage/documents/'.$kyc->image3)}}" style="border-radius: 10%;" width="300" height="300">
                                                    </div>
                                                    @else
                                                    <h6 style="color:green;">Your kyc verification is Approved</h6>
                                                    <br>
                                                    <h5 class="text-center">ID Card/Passport Front</h5>
                                                    <br>
                                                    <div class="d-flex justify-content-center">




                                                        <img id="image_upload_preview" src="{{asset('storage/documents/'.$kyc->image)}}" style="border-radius: 10%;" width="300" height="300">


                                                      </div>
                                                      <hr>
                                                      <br>
                                                      <h5 class="text-center">ID Card/Passport Back</h5>
                                                      <br>
                                                    <div class="d-flex justify-content-center">

                                                      <img id="image_upload_preview" src="{{asset('storage/documents/'.$kyc->image2)}}" style="border-radius: 10%;" width="300" height="300">
                                                    </div>
                                                    <hr>
                                                    <br>
                                                    <h5 class="text-center">Proof of Address</h5>
                                                    <br>
                                                    <div class="d-flex justify-content-center">

                                                      <img id="image_upload_preview" src="{{asset('storage/documents/'.$kyc->image3)}}" style="border-radius: 10%;" width="300" height="300">
                                                    </div>


                                                    @endif

                                                    @endif
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </section>


                             </table>

                  </p>

              </div>


          </div>
            </div>


                    </div>

                    </div>
                </div>


            </div>
        </div>


<script>
//Disabled kyc submit button after one submission
$(document).ready(function() {
        $("#kycForm").on("submit", function(event) {
            //console.log("tes1111t");
            //event.preventDefault();
            var submitButton = $("#kycSubmitHide");
            submitButton.prop("disabled", true);
    
        });
    });
    //End coin transfer confirm script   
</script>


@endsection

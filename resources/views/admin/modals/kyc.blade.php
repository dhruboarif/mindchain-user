<a href="#" data-bs-toggle="modal" data-bs-target="#userkyc{{$row->id}}"><i class="fa-solid fa-eye"></i> </a>
<div class="modal fade text-left" id="userkyc{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">User Kyc Verification

                <button type="button" class="btn-primary align-right" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('kyc-approve')}}" method="post">

          @csrf
          <input type="hidden" name="id" value="{{$row->id}}">
            <div class="modal-body">
              <section id="multiple-column-form">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">


                              <div class="card-body">
                                <h5 class="text-center">ID Card/Passport Front</h5>
                                <br>
                                <div class="d-flex justify-content-center">




                                    <img id="image_upload_preview" src="{{asset('storage/documents/'.$row->image)}}" style="border-radius: 10%;" width="300" height="300">


                                  </div>
                                  <hr>
                                  <br>
                                  <h5 class="text-center">ID Card/Passport Back</h5>
                                  <br>
                                <div class="d-flex justify-content-center">

                                  <img id="image_upload_preview" src="{{asset('storage/documents/'.$row->image2)}}" style="border-radius: 10%;" width="300" height="300">
                                </div>
                                <hr>
                                <br>
                                <h5 class="text-center">Proof of Address</h5>
                                <br>
                                <div class="d-flex justify-content-center">

                                  <img id="image_upload_preview" src="{{asset('storage/documents/'.$row->image3)}}" style="border-radius: 10%;" width="300" height="300">
                                </div>




                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">
               @if($row->status == 'pending')
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Approve</button>


                <a href="/home/kyc-verifications/reject/{{$row->id}}" type="submit" class="btn btn-danger" >Reject</a>
                  @endif
            </div>
              </form>
        </div>
    </div>
</div>

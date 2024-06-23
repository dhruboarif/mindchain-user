<div class="modal fade text-left" id="addwallet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Wallet</h4>
                <button type="button" class="btn-primary close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <section id="multiple-column-form">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">

                              <div class="card-body">

                              <form method="post" action="{{route('user-wallet-add')}}">
                                @csrf

                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Wallet Name</label>
                            <input type="text" class="form-control" name="wallet_name" placeholder="Enter Wallet No" id="exampleInputEmail1" aria-describedby="emailHelp" required>

                        </div>
                        
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Wallet or Account No.</label>
                            <input type="text" class="form-control" name="wallet_no" placeholder="Enter Wallet No" id="exampleInputEmail1" aria-describedby="emailHelp" required>

                        </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>

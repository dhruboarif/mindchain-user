<div class="modal fade text-left" id="joinelite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Join Elite club Member</h4>
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

                              <form method="post" action="{{route('join-elite')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

 
                        
                        <div class="mb-3">
                          <label for="mem_fee" class="form-label">Membership Fee</label>
                          <input type="text" name="mem_fee" disabled class="form-control" value="{{$data['mem_fee']}}"required/>
                        </div>

                        <div class="mb-3">
                            <label for="avl_balance" class="form-label">USD Available Balance</label>
                            <input type="text" name="avl_balance" disabled id="wallet_id" value="{{$data['sum_usdwallet']}}" class="form-control"required/>
                        </div>

    
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>

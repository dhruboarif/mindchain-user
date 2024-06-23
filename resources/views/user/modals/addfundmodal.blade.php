<div class="modal fade text-left" id="addfund" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Fund</h4>
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

                              <form method="post" action="{{route('money-store')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">


                        <div class="mb-3">


                           <label for="email-id-column">Select Currency<span
                                   class="text-danger">*</span></label>
                        <select name="pay_currency" class="form-select" aria-label="Default select example" required>
                            <option label="Select Currency"></option>


                        <option  value="usdtbsc">USDTBSC</option>
                        <option  value="bnbbsc">BNBBSC</option>

                      </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Amount ($)</label>
                            <input type="round" class="form-control" name="amount" placeholder="Enter Amount" id="exampleInputEmail1" aria-describedby="emailHelp" required pattern="[0-9]*" min="1" max="5000">

                        </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Deposit</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>

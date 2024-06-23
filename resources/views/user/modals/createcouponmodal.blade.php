<div class="modal fade text-left" id="createcoupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Create Coupon</h4>
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

                              <form method="post" action="{{route('store-coupon')}}">
                                @csrf
                                <input type="hidden" name="created_by" value="{{Auth::user()->id}}">


                        <div class="mb-3">


                           <label for="email-id-column">Select Value ($)<span
                                   class="text-danger">*</span></label>
                        <select name="coupon_value" class="form-select m-2" aria-label="Default select example" required>
                            <option label="Select Value"></option>


                        <option  value="25">25</option>
                        <option  value="50">50</option>
                        <option  value="100">100</option>
                        <option  value="200">200</option>
                        <option  value="500">500</option>
                        <option  value="1000">1000</option>
                        <option  value="2000">2000</option>
                        <option  value="5000">5000</option>
                        <option  value="10000">10000</option>

                      </select>
                        </div>
                        <!--<div class="mb-3">-->
                        <!--    <label for="exampleInputEmail1" class="form-label">Amount ($)</label>-->
                        <!--    <input type="round" class="form-control" name="amount" placeholder="Enter Amount" id="exampleInputEmail1" aria-describedby="emailHelp" required>-->

                        <!--</div>-->
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Create Coupon</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>

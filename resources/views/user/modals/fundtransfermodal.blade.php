<div class="modal fade text-left" id="fundtransfer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Transfer MUSD</h4>


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
                                <?php
                                $settings= App\Models\TransferInfo::first();


                                 ?>

                        <form id="fundTransferForm" method="post" action="{{route('fund-transfer')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Fund Transfer To</label>

                            <input type="text" id="sponsor" name="receiver_id"   class="form-control"required/>
                            <div id="suggestUser"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Amount ($)</label>
                            <input type="number" min="1" max="5000" name="amount" class="form-control" required pattern="[0-9]*" title="Please enter only numeric values"/>
                        </div>
                        <div class="mb-3">
                            <h6>Available MUSD: {{$data['sum_deposit'] ? '$'.number_format((float)$data['sum_deposit'], 2, '.', '') : '$00.00'}}</h6>
                              </div>
                        <div class="mb-3">

                          <h6>Transfer limit $( >= 1 & <= 5000)</h6>
                        </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Transfer</button>
                <!--<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Updating!</button>-->
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
              </form>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="sendusdt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Transfer USDT</h4>


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
                                $data['sum_usdt_wallet'] = App\Models\UsdWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
                                 ?>

                              <form id="fundTransferForm" method="post" action="{{route('send-usdt')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">USDT Transfer To</label>

                            <input type="text" id="sponsor" name="receiver_id"   class="form-control"required/>
                            <div id="suggestUser"></div>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Amount (USDT)</label>

                          <input type="round" min="1" max="1" name="amount" class="form-control" required pattern="[0-9]*" title="Please enter only numeric values" required/>
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        </div>
                        <div class="mb-3">
                            <h6>Available Balance: {{$data['sum_usdt_wallet'] ? 'USDT '.number_format((float)$data['sum_usdt_wallet'], 2, '.', '') : '00.00 USDT'}}</h6>
                              </div>
                        <div class="mb-3">

                          <h6>Transfer limit USDT ( >= 10 & <= 5000)</h6>
                        </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="fundtransferhide" >Transfer</button>
                <!--<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Updating!</button>-->
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
              </form>
        </div>
    </div>
</div>

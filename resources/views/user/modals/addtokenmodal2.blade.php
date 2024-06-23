<div class="modal fade text-left" id="addtoken2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Deposit MIND</h4>
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

                              <form method="post" action="{{route('token-store-manual')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                        <div class="mb-3">

                          <?php
                          $account_info= App\Models\AccountInfo::where('id',1)->get();

                           ?>
                           <label for="email-id-column">Select Wallet<span
                                   class="text-danger">*</span></label>
                        <select id="DestinationOptions_mind" name="payment_wallet_id" class="form-select" aria-label="Default select example" required>
                            <option label="Choose Wallet"></option>
                          @foreach($account_info as $payment)

                        <option id="{{$payment->wallet_no}}" value="{{$payment->id}}">{{$payment->payment_way->payment_way}} </option>
                        @endforeach
                      </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Wallet Address</label>
                            <div class="input-group">
                                <input type="text" name="wallet_id_token" value="0x4F12d8F8fDcF95605Eff895E4D224db6A2d496c1" readonly id="wallet_id_mind" class="form-control copywalletid" required/>
                                <button id="copyButton" class="btn btn-outline-secondary" type="button" onclick="copyWalletAddress_mind()">
                                    Copy
                                </button>
                            </div>
                        </div>

                         <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Amount (MIND)</label>
                            <input type="round" class="form-control" name="amount" placeholder="Enter Amount" id="exampleInputEmail1" aria-describedby="emailHelp" required pattern="[0-9]*" min="1" max="5000">

                        </div>
                         <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Transaction Hash</label>

                          <input type="text" name="txn_id" class="form-control" required/>


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

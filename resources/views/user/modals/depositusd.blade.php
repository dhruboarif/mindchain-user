<div class="modal fade text-left" id="depositusd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Deposit USDT</h4>
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

                              <form method="post" action="{{route('money-store-elite')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                        <div class="mb-3">

                          <?php
                            $account_info = App\Models\AccountInfo::whereIn('payment_type_id', [5, 6])->get();

                           ?>
                           <label for="email-id-column">Select Wallet<span
                                   class="text-danger">*</span></label>
                        <select id="DestinationOptions_usd" name="payment_wallet_id" class="form-select" aria-label="Default select example" required>
                            <option label="Choose Wallet"></option>
                          @foreach($account_info as $payment)

                        <option id="{{$payment->wallet_no}}" value="{{$payment->id}}">{{$payment->payment_way->payment_way}} </option>
                        @endforeach
                      </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Wallet Address</label>
                            <div class="input-group">
                                <input type="text" name="wallet_id" readonly id="wallet_id_usd" class="form-control copywalletid2" required/>
                                <button id="copyButton"  class="btn btn-outline-secondary" type="button" onclick="copyWalletAddress_usd()">
                            Copy
                        </button>

                            </div>
                        </div>

                         <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Amount ($)</label>
                            <input type="number" class="form-control" name="amount" placeholder="Enter Amount" id="exampleInputEmail1" aria-describedby="emailHelp" required min="10" max="5001" step="0.01">
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

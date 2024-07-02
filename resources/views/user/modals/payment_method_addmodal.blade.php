                                    <div class="modal withdraw-modal fade" id="addMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title">Add Payment Method</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('user-payment-method')}}">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                            <?php
                                                            $payementways= App\Models\PaymentWay::all();
                                                             ?>
                                                          <div class="form-group">
                                                            <label for="selectMethod" class="col-form-label">Select Wallet</label>
                                                            <select name="payment_way_id" class="form-select form-control" id="selectMethod" aria-label="Default select example" required >
                                                            @foreach($payementways as $paymentway)
                                                                <option value="{{$paymentway->id}}">{{$paymentway->payment_way}}</option>
                                                            @endforeach
                                                            </select>
                                                          </div>
                                                            <div class="form-group">
                                                              <label for="walletNo" class="col-form-label">Wallet or Account No</label>
                                                              <input type="text" name="wallet_no" placeholder="Enter Wallet No" class="form-control" id="walletNo">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                      <button type="submit" class="btn btn-primary">Save</button>
                                                    </form>

                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
<div class="modal fade text-left" id="bmindbuymodal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Buy B-Mind</h4>
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

                              


                        <div class="mb-3">
                            Are you sure you want to Buy this B-Mind?

                          
                        </div>
                        
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="jquery-val-form" action="{{ route('buy-bmind') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="bmind_id" value="{{ $row->id }}">
                    <input type="hidden" name="selected_amount" id="selected_amount" value="">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>

            <!--<div class="modal-footer">-->
            <!--    <form id="jquery-val-form" action="{{route('buy-bmind')}}" method="post">-->
            <!--                            @csrf-->
            <!--                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">-->
            <!--                            <input type="hidden" name="package_id" value="{{$row->id}}">-->

            <!--    <button type="submit" class="btn btn-primary">Confirm</button>-->
            <!--    </form>-->
            <!--    <form id="jquery-val-form" action="#" method="post">-->
            <!--                            @csrf-->
            <!--                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">-->
            <!--                            <input type="hidden" name="package_id" value="{{$row->id}}">-->

            <!--    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Buy With Bonus Coin</button>-->
            <!--    </form>-->
            <!--</div>-->
              </form>
        </div>
    </div>
</div>

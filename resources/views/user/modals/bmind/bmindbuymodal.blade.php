<div class="buttn">
    <div class="modal fade mg-t-30" id="bmindbuymodal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog mg-t-30" role="document">
          <div class="modal-content mg-t-30">
            <div class="modal-header">
              <h5 class="modal-title text-left" id="exampleModalLabel">Buy B-Mind</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-left">
              <p>Are you sure you want to Buy this B-Mind?</p>
            </div>
            <div class="modal-footer text-right">
                <form id="jquery-val-form text-right" action="{{ route('buy-bmindnew') }}" method="post" style="display: flex; float:right;">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="bmind_id" value="{{ $row->id }}">
                    <input type="hidden" name="selected_amount" id="selected_amount" value="">
                    <button type="submit" class="btn btn-primary" style="margin-left:10px">Confirm</button>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>

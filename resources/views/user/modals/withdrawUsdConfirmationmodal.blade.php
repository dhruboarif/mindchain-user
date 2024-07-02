<div class="modal withdraw-modal fade" id="withdrawUsdConfirmation{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm withdraw</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('withdraw-usd-confirmation')}}">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="id" value="{{$row->id}}">


        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Enter Confirmation Code</label>

            <input type="text" name="confirmation_code"   class="form-control"required/>
            <div id="suggestUser"></div>
        </div>
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
 
       
    </form>
    
      </div>
      
    </div>
</div>
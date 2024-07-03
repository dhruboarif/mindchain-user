<div class="modal withdraw-modal fade" id="withdrawMUsdCancel{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Withdraw request canceling ! Are you sure?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('musd-withdraw-cancel')}}">
                @csrf
                <div class="card-body">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="id" value="{{$row->id}}">
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
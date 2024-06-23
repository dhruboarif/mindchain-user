<div class="col">
  <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="makeconsultant" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Make Cunsultant</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="card-body">
            

            <form id="jquery-val-form" action="{{route('make-consultant')}}" method="post">
              @csrf
              <input type="hidden" name="id" id="consultant" value="">

                <div class="form-group">
                    Are You Sure you Want to Proceed?

                </div>


        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="Submit" class="btn btn-primary">Confirm</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>
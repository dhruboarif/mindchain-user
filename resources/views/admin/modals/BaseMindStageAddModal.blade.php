<div class="modal fade text-left" id="addBaseMindStage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add New BaseMind Stage</h4>
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

                              <form method="post" action="{{ route('storeBmindStage') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Select Image</label>
                                    <input type="file" class="form-control" name="file" id="image" aria-describedby="emailHelp"  required>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Stage Name</label>
                                    <input type="text" class="form-control" name="title"  id="exampleInputEmail1" aria-describedby="emailHelp" required>

                                </div>
                                @php
                                  $token = App\Models\TokenRate::first();
                                  //dd($token->token_convert_rate);
                                @endphp
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Total Token Issues</label>
                                    <input type="number" class="form-control" name="total_token_issues"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Token Base Price</label>
                                    <input type="text" class="form-control" name="token_base_price"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Token Duration (Days)</label>
                                    <input type="text" class="form-control" name="duration"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level-1 Bonus (%)</label>
                                    <input type="text" class="form-control" name="lvl1_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level-2 Bonus (%)</label>
                                    <input type="text" class="form-control" name="lvl2_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level-3 Bonus (%)</label>
                                    <input type="text" class="form-control" name="lvl3_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level-4 Bonus (%)</label>
                                    <input type="text" class="form-control" name="lvl4_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level-5 Bonus (%)</label>
                                    <input type="text" class="form-control" name="lvl5_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                               <div class="mb-3">
                                   
                                   <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" id="start_date" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="form-control" name="end_date" id="end_date" required>
                                    </div>

                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" onchange="calculate()" name="status" id="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Deactive">Deactive</option>
                                    <option value="Finished">Finished</option>
                                </select>
                            </div>


                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
            </div>
              </form>
        </div>
    </div>
</div>

@push('scripts')

<script>
function calculate(){
  //alert('success');


  var amount = document.getElementById('amount').value;
  var value = amount * <?php echo $token->token_convert_rate ?>;
  console.log(value);
  document.getElementById('price').value= value;
}

</script>
@endpush

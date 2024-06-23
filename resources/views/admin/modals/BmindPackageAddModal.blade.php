<div class="modal fade text-left" id="addBaseMindStage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add New Bmind Package</h4>
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

                              <form method="post" action="{{ route('baseMindPacakgeAdd') }}" enctype="multipart/form-data">
                                @csrf
                                @php
                                  $bmindStage = App\Models\BaseMind::all();
                                  //dd($bmindStage);
                                @endphp
                                
                                <div class="mb-3">
                                    <label for="base_mind_id" class="form-label">Stage Name</label>
                                <select class="form-select" onchange="calculate()" name="base_mind_id" id="base_mind_id" required>
                                    @foreach($bmindStage as $stage)
                                        <option value="{{ $stage->id }}">{{ $stage->title }}</option>
                                    @endforeach
                                </select>
                                    
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Amount</label>
                                    <input type="text" class="form-control" name="amount" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                          
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Daily Bonus (%)</label>
                                    <input type="number" class="form-control" name="daily_bonus" id="exampleInputEmail1" aria-describedby="emailHelp" required step="any">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Sponsor Bonus (%)</label>
                                    <input type="number" class="form-control" name="sponsor_bonus" id="exampleInputEmail1" aria-describedby="emailHelp" required step="any">
                                </div>
                                
                               <div class="mb-3">
                                   
                                   

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


@endpush

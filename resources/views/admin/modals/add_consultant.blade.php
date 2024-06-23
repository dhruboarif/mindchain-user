<div class="modal fade text-left" id="add_consultant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Consultant</h4>


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


                              <form method="post" action="{{route('admin-add-ambassador-money')}}">
                                @csrf
                                <input type="hidden" name="received_from" value="{{Auth::user()->id}}">
                                


                        
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">User Name</label>

                          <input type="text" name="name" id="username_search" class="form-control" required/>

                            <div class="list-group" id="userList"></div>
                        </div>


                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add User</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
              </form>
        </div>
    </div>
</div>

@extends('admin.layouts.master')



@section('admin_content')

   <div class="bd-example">

            <div class="row  row-cols-1 row-cols-md-1 g-4">

                <div class="col">

                    <div class="card">

                      @if(Session::has('package_added'))

                                  <div class="alert alert-success d-flex align-items-center" role="alert">

                       <svg class="bi flex-shrink-0 me-2" width="24" height="24">

                           <use xlink:href="#check-circle-fill" />

                       </svg>

                       <div>

                       {{Session::get('package_added')}}

                   </div>

               </div>

               @elseif(Session::has('package_updated'))

               <div class="alert alert-success d-flex align-items-center" role="alert">

            <svg class="bi flex-shrink-0 me-2" width="24" height="24">

            <use xlink:href="#check-circle-fill" />

            </svg>

            <div>

            {{Session::get('package_updated')}}

            </div>

            </div>



     @endif

                    <div class="card-body">

                        <h2 class="card-title">Stage Edit</h2>



                        <hr>

                        <div class="bd-example table-responsive">
                          <div class="card">
                              <div class="card-body">
                              <form method="post" action="{{route('updateBmindStage')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$package->id}}">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Select Image</label>
                                    <img src="{{asset('storage/perrymind/'.$package->image)}}" class="img-fluid avatar avatar-50 avatar-rounded">
                                    <input type="file" class="form-control" name="uimage" id="image" aria-describedby="emailHelp" >
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Stage Name</label>
                                    <input type="text" class="form-control" value="{{$package->title}}" name="title"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Total Token Issues</label>
                                    <input type="text" class="form-control" value="{{$package->total_token_issues}}" name="total_token_issues"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Token Base Price</label>
                                    <input type="text" class="form-control" value="{{$package->token_base_price}}" name="token_base_price"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Token Duration (Days)</label>
                                    <input type="number" class="form-control" value="{{$package->duration}}" name="duration"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level-1 Bonus (%)</label>
                                    <input type="text" class="form-control" value="{{$package->lvl1_bonus}}" name="lvl1_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level-2 Bonus (%)</label>
                                    <input type="text" class="form-control" value="{{$package->lvl2_bonus}}" name="lvl2_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level-3 Bonus (%)</label>
                                    <input type="text" class="form-control" value="{{$package->lvl3_bonus}}" name="lvl3_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                                          <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level-4 Bonus (%)</label>
                                    <input type="text" class="form-control" value="{{$package->lvl4_bonus}}" name="lvl4_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                                          <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Level-5 Bonus (%)</label>
                                <input type="text" class="form-control" value="{{$package->lvl5_bonus}}" name="lvl5_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                               <div class="mb-3">
                                   
                                   <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" value="{{$package->end_date}}" name="start_date" id="start_date" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="form-control" value="{{$package->end_date}}" name="end_date" id="end_date" required>
                                    </div>

                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" onchange="calculate()" name="status" id="status" required>
                                    <option value="Active" {{ $package->status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Deactive" {{ $package->status == 'Deactive' ? 'selected' : '' }}>Deactive</option>
                                    <option value="Finished" {{ $package->status == 'Finished' ? 'selected' : '' }}>Finished</option>
                                </select>

                                </div>

                          </div>



                            <button type="submit" class="btn btn-primary">Update</button>



                              </form>



                           </div>

                    </div>



                    </div>

                </div>





            </div>

        </div>

        <?php

        $token= App\Models\TokenRate::first();

          //dd($token);

         ?>



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





@endsection


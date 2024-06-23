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

                        <h2 class="card-title">Stage Package Edit</h2>



                        <hr>

                        <div class="bd-example table-responsive">
                          <div class="card">
                              <div class="card-body">
                              <form method="post" action="{{route('updateBmindPackage')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$package->id}}">

                                @php
                                  $bmindStage = App\Models\BaseMind::all();
                                  //dd($bmindStage);
                                @endphp
                                <div class="mb-3">
                                <label for="base_mind_id" class="form-label">Stage Package Name</label>
                                <select class="form-select" onchange="calculate()" name="base_mind_id" id="base_mind_id" required>
                                    @foreach($bmindStage as $stage)
                                        <option value="{{$stage->id}}" {{ $package->basemind->title == $stage->title ? 'selected' : '' }}>{{$stage->title}}</option>
                                    @endforeach
                                </select>
                                
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Amount</label>
                                    <input type="text" class="form-control" value="{{$package->amount}}" name="amount"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Daily Bonus (Fixed)</label>
                                    <input type="text" class="form-control" value="{{$package->daily_bonus}}" name="daily_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Sponsor Bonus (%) </label>
                                    <input type="text" class="form-control" value="{{$package->sponsor_bonus}}" name="sponsor_bonus"  id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                
                               <div class="mb-3">
                                   
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


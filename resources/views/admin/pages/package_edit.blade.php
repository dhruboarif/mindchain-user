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
                        <h2 class="card-title">Package Edit</h2>

                        <hr>
                        <div class="bd-example table-responsive">

                          <div class="card">

                              <div class="card-body">

                              <form method="post" action="{{route('update-package')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$package->id}}">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Select Image</label>
                                    <img src="{{asset('storage/packages/'.$package->image)}}" class="img-fluid avatar avatar-50 avatar-rounded">
                                    <input type="file" class="form-control" name="uimage" id="image" aria-describedby="emailHelp" >

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Package Name</label>
                                    <input type="text" class="form-control" value="{{$package->package_name}}" name="package_name"  id="exampleInputEmail1" aria-describedby="emailHelp" required>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Package Quantity</label>
                                    <input type="number" class="form-control" value="{{$package->package_qty}}" name="package_qty"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="
                                      * digit only" required>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Amount (MIND)</label>
                                    <input  type="round" class="form-control" value="{{$package->amount}}" onchange="calculate()" name="amount"  id="amount" aria-describedby="emailHelp" placeholder="
                              * digit only" required>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Package Price ($)</label>
                                    <input  type="text" readonly class="form-control" value="{{$package->package_price}}" name="package_price" id="price" aria-describedby="emailHelp" required >

                                </div>




                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Affiliate Coin (%)</label>
                                    <input type="round" class="form-control" value="{{$package->affilate_token}}" name="affilate_token"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="
                              * digit only" required >

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Daily Seller Coin (%)</label>
                                    <input type="round" class="form-control" value="{{$package->daily_seller_token}}" name="daily_seller_token"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="
                              * digit only" required  >

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Daily Buyer Coin (%)</label>
                                    <input type="round" class="form-control" value="{{$package->daily_buyer_token}}" name="daily_buyer_token"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="
                              * digit only" required  >

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Duration</label>
                                    <input type="number" class="form-control" value="{{$package->duration}}" name="duration"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="
                              * digit only" required  >

                                </div>


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

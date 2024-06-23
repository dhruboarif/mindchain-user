@extends('user.layouts.master')


@section('user_content')



   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">

                <div class="col">
                    
       

                    <div class="card-body" id="text-purple">
                        <h2 class="card-title" id="text-purple">Withdraw History</h2>
                         <h6 id="text-purple">Total Credit: {{$total_credit}}MIND</h6>
         




                          <hr>
                        <div class="bd-example">
                           
         
                  <div class="bd-example table-responsive">
                         <table id="myTable" class="table table-bordered table-border">
                             <thead>
                                 <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">DATE</th>
                                       <th scope="col">AMOUNT</th>
                                        
                                    <th scope="col">DESCRIPTION</th>
                                               
                                     <th scope="col">TYPE</th>
                                     <th scope="col">STATUS</th>

                                 </tr>
                             </thead>


                            @foreach($bonus as $row)
                                 <tr>
                                    <td id="text-purple">{{$loop->index+1}}</td>
                                     
                                     <td id="text-purple">{{$row->created_at}}</td>
                                     <td id="text-purple">
                                       
                                        {{$row->amount}}MIND

                                     </td id="text-purple">
                                     <td id="text-purple">{{$row->description}}</td>
                                     <td id="text-purple">{{$row->type}}</td>
                                      <td id="text-purple">{{$row->status}}</td>
                                     


                                 </tr>
                                 @endforeach
                                




                             </tbody>
                         </table>
                     </div>

                  </p>

              
              

          </div>
      </div>


                    </div>

                    </div>
                </div>


           



@endsection

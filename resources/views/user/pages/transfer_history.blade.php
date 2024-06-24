@extends('user.layouts.master')


@section('user_content')
    <div class="section-admin container-fluid">
        <div class="row admin">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="admin-content res-mg-t-15 d-flex row justify-content-between">


                    <div class="row page-top-section">
                        <!-- breadcome title Section  -->
                        <div class="col-sm-6 breadcome-heading">
                            <h3>Transfer History</h3>
                        </div>
                        
                    </div>

                    

                    <div class="transection-staus mg-t-30  mg-b-30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="transaction-status-wrap">

                                        <div class="transaction-table">
                                            <table id="myTable" class="">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">DATE</th>
                                                        <th scope="col">AMOUNT</th>

                                                        <th scope="col">DESCRIPTION</th>
                                                        <th scope="col">TYPE</th>
                                                        <th scope="col">Status</th>

                                                    </tr>
                                                </thead>


                                                @foreach ($bonus as $row)
                                                    <tr>
                                                        <td id="text-purple">{{ $loop->index + 1 }}</td>

                                                        <td id="text-purple">{{ $row->created_at }}</td>
                                                        <td id="text-purple">

                                                            {{ $row->amount }}USD

                                                        </td>
                                                        <td id="text-purple">{{ $row->description }}</td>
                                                        <td id="text-purple">{{ $row->type }}</td>
                                                        <td id="text-purple">{{ $row->status }}</td>



                                                    </tr>
                                                @endforeach





                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- transection Token Wallet section
        ============================================  -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>



    @push('scripts')
        <script type="text/javascript">
            document.getElementById('DestinationOptions_usd2').addEventListener('change', function(e) {
                var wallet2 = e.target.options[e.target.selectedIndex].getAttribute('id');
                //console.log(wallet2);
                var wallet = document.getElementById("wallet_id_usd2").value = wallet2;
                //console.log(wallet);
                //wallet.innerHTML= wallet2;
            });

            //  document.getElementById('').value(id.value);
        </script>

        <script>
            document.getElementById('DestinationOptions').addEventListener('change', function(e) {
                var wallet2 = e.target.options[e.target.selectedIndex].getAttribute('id');
                console.log(wallet2);
                var wallet = document.getElementById("wallet_id").value = wallet2;
                //console.log(wallet);
                //wallet.innerHTML= wallet2;
            });
        </script>

   
    @endpush
@endsection

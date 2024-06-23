@extends('admin.layouts.master')


@section('admin_content')
<div class="bd-example">
    <div class="row  row-cols-1 row-cols-md-1 g-4">
        <div class="col">
            <div class="card">
                @if(Session::has('password_changed'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        {{Session::get('password_changed')}}
                    </div>
                </div>
                @elseif(Session::has('ambassador_added'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        {{Session::get('ambassador_added')}}
                    </div>
                </div>
                @elseif(Session::has('kyc_approved'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        {{Session::get('kyc_approved')}}
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <h2 class="card-title">User Kyc Requests</h2>

                    <hr>
                    <div class="bd-example table-responsive">
                        <table id="kye_table" class="table table-bordered table-border">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>

                                    <th scope="col">USERNAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">KYC STATUS</th>

                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#kye_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('all_kyc_lists') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                //{ data: 'created_at', name: 'created_at' },
                { data: 'user_name', name: 'user_name' },
                { data: 'user_email', name: 'user_email' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' },
                /*{ data: 'method', name: 'method' },
                { data: 'received_from', name: 'recieved_from' },
                { data: 'description', name: 'description' },
                { data: 'amount', name: 'amount' },
                { data: 'type', name: 'type' },*/
            ]
        });
    });
</script>
@endpush

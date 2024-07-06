@extends('user.layouts.master')


@section('user_content')
    <div class="section-admin container-fluid">
        <div class="row admin">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="admin-content res-mg-t-15 d-flex row justify-content-between">
                    @if (Session::has('transfer_fund'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            <div>
                                {{ Session::get('transfer_fund') }}
                            </div>
                        </div>
                    @elseif(Session::has('transfer_error'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            <div>
                                {{ Session::get('transfer_error') }}
                            </div>
                        </div>
                    @endif

                    <div class="row page-top-section">
                        <!-- breadcome title Section  -->
                        <div class="col-sm-6 breadcome-heading">
                            <h3>USDT Transfer History</h3>
                        </div>
                        <div class="col-sm-6">
                            <div class=" breadcome-price-section">
                                <p class="breadcome-section-name">Available USDT:</p>
                                <p class="breadcome-section-price">
                                    {{ $data['sum_deposit'] ? '' . number_format((float) $data['sum_deposit'], 2, '.', '') : '$00.00' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $settings = App\Models\TransferInfo::first();
                    ?>
                    <div class="row page-section-btn">
                        <div class="col-sm-12">
                            <button type="button" data-toggle="modal" data-target="#sendusdt" data-whatever=""
                                class="page-button">Send USDT</button>
                            <div class="modal withdraw-modal fade" id="sendusdt" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Transfer USDT </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="fundTransferForm" method="post" action="{{ route('send-usdt') }}">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <div class="form-group">
                                <?php
                                
                                    $settings= App\Models\TransferInfo::first();
                                    $data['sum_usdt_wallet'] = App\Models\UsdWallet::where('user_id', Auth::id())
                                ->whereIn('status', ['awaiting', 'approve', 'pending'])
                                ->sum('amount');
                                 ?>

                                                </div>

                                                <div class="form-group">
                                                    <label for="usdt-amount-deposit" class="col-form-label">USDT Transfer
                                                        to</label>
                                                    <input type="text" class="form-control" name="receiver_id"
                                                        id="sponsor">
                                                </div>
                                                <div id="suggestUser"></div>

                                                <div class="form-group">
                                                    <label for="usdt-hash-deposit" class="col-form-label">Amount (USDT)</label>
                                                    <input type="number" class="form-control" id="usdt-hash-deposit"
                                                        name="amount">
                                                </div>
                                                <h6>Available Balance: {{$data['sum_usdt_wallet'] ? 'USDT '.number_format((float)$data['sum_usdt_wallet'], 2, '.', '') : '00.00 USDT'}}</h6>
                                                </div>
                                                <h6>Transfer limit $( >= 1 & <= 5000)</h6>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" id="fundtransferhide">Transfer</button>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="transection-staus mg-t-30  mg-b-30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="transaction-status-wrap">

                                        <div class="transaction-table">
                                            <table id="myTable" class="table table-bordered table-border">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">REQUEST DATE</th>
                                                        <th scope="col"> FUND TRANSFER TO/FROM</th>
                                                        <th scope="col">DESCRIPTION</th>

                                                        <th scope="col">AMOUNT</th>
                                                        <th scope="col">STATUS</th>



                                                    </tr>
                                                </thead>

                                                @foreach ($transfer as $row)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $row->created_at }}</td>
                                                        @if ($row->receiver_id != null)
                                                            <td>
                                                                {{ $row->receiver->user_name }}
                                                            </td>
                                                        @elseif($row->received_from != null)
                                                            <td> {{ $row->sender->user_name }}</td>
                                                        @else
                                                            <td>--</td>
                                                        @endif

                                                        <td>{{ $row->description }}</td>

                                                        <td>{{ $row->amount }}</td>
                                                        <td>
                                                            @if ($row->status == 'awaiting')
                                                                <a data-toggle="modal"
                                                                    data-target="#usdtransferconfirmation"
                                                                    data-id="{{ $row->id }}"
                                                                    class="btn btn-danger">Confirm Transfer</a>
                                                            @else
                                                                {{ $row->status }}
                                                            @endif
                                                        </td>

                                                    </tr>
                                                    @include('user.modals.transferconfirmationmodal')
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
        <script>
            $("body").on("keyup", "#sponsor", function() {
                let searchData = $("#sponsor").val();
                if (searchData.length > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('get-users') }}',
                        data: {
                            search: searchData
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result) {
                            $('#suggestUser').html(result.success);
                            console.log(result.data);
                            if (result.data) {
                                $("#fundTransferForm").removeAttr('data-user-not-found');
                            } else {
                                $("#fundTransferForm").attr('data-user-not-found', 'true');
                            }
                        }
                    });
                }
                if (searchData.length < 1) {
                    $('#suggestUser').html("");
                    $("#fundTransferForm").removeAttr('data-user-not-found');
                }
            });

            $("#fundTransferForm").submit(function(event) {
                if ($("#fundTransferForm").attr('data-user-not-found') === 'true') {
                    event.preventDefault(); // Prevent form submission
                    alert('User not found. Please enter a valid receiver ID.');
                }
            });





            // Get the input element
            document.addEventListener("DOMContentLoaded", function() {
                let amountInput = document.getElementById("amount");
                let form = document.querySelector("form");

                form.addEventListener("submit", function(event) {
                    let amountValue = amountInput.value;

                    if (!/^\d+$/.test(amountValue)) {
                        event.preventDefault();
                        alert("Please enter a valid numeric amount.");
                    }
                });
            });


            //Fund transfer Modal
            $(document).ready(function() {
                $('#fundtransferconfirmation').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var transferId = button.data('id');
                    var modal = $(this);
                    modal.find('#transferId').val(
                        transferId); // Set the transferId value in the hidden input field
                });

                $("#preventtt").on("submit", function(event) {
                    console.log("tes1111t");

                    event.preventDefault();

                    var submitButton = $("#confirmFundTransfer");
                    submitButton.prop("disabled", true);

                    var formData = $(this).serialize();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('send-fund-confirmation') }}",
                        data: formData,
                        dataType: "json",
                        success: function(response) {
                            // Hide the modal
                            $("#fundtransferconfirmation").modal("hide");

                            // Handle the success response here
                            //console.log("Form submitted successfully", response);

                            $("#messageContainer").html(
                                '<div class="alert alert-success">Confirmation successful!</div>'
                            );
                            setTimeout(function() {
                                window.location.reload();
                                $("#messageContainer").empty();
                            }, 10000); // 10000 milliseconds = 10 seconds
                            // location.reload();

                            // Show a success message

                            // Disable the submit button
                            submitButton.prop("disabled", true);
                        },
                        error: function(error) {
                            // Handle the error response here
                            console.log(error);
                            $("#messageContainer").html(
                                '<div class="alert alert-danger"> You have entered wrong code</div>'
                            );

                            setTimeout(function() {
                                $("#messageContainer").empty();
                            }, 10000);
                            // You can display an error message to the user
                            $("#fundtransferconfirmation").modal("hide");
                            // Re-enable the submit button
                            submitButton.prop("disabled", false);
                        }
                    });
                });
            });

            //End fund transfer Modal
        </script>
    @endpush
@endsection

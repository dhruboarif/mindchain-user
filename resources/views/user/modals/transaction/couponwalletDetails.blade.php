<!-- Modal for displaying details -->
                    <div class="modal fade" id="couponwalletdetailsModal{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{$loop->index}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailsModalLabel{{$loop->index}}">Transaction Details</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Content to display details -->
                                    <p>Date: {{$coupon->created_at}}</p>
                                    <p>Category: {{$coupon->method}}</p>
                                    <p>Received from/Paid to:
                                        @if($coupon->received_from != null)
                                        {{$coupon->sender->user_name}}
                                        @elseif($coupon->receiver_id != null)
                                        {{$coupon->receiver->user_name}}
                                        @else
                                        System Transactions
                                        @endif
                                    </p>
                                    <p>Description: {{$coupon->description}}</p>
                                    <p>Amount: {{$coupon->amount}}$</p>
                                    <p>Type: {{$coupon->type}}</p>
                                    <p>Status: {{$coupon->status}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
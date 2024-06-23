<!-- Modal for displaying details -->
                    <div class="modal fade" id="usddetailsModal{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{$loop->index}}" aria-hidden="true">
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
                                    <p>Date: {{$usd->created_at}}</p>
                                    <p>Category: {{$usd->method}}</p>
                                    <p>Received from/Paid to:
                                        @if($usd->received_from != null)
                                        {{$usd->sender->user_name}}
                                        @elseif($usd->receiver_id != null)
                                        {{$usd->receiver->user_name}}
                                        @else
                                        System Transactions
                                        @endif
                                    </p>
                                    <p>Description: {{$usd->description}}</p>
                                    <p>Amount: {{$usd->amount}} USD</p>
                                    <p>Type: {{$usd->type}}</p>
                                    <p>Status: {{$usd->status}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
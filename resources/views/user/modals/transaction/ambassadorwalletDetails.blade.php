<!-- Modal for displaying details -->
                    <div class="modal fade" id="ambassadordetailsModal{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{$loop->index}}" aria-hidden="true">
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
                                    <p>Date: {{$ambassador->created_at}}</p>
                                    <p>Category: {{$ambassador->method}}</p>
                                    <p>Received from/Paid to:
                                        @if($ambassador->received_from != null)
                                        {{$ambassador->sender->user_name}}
                                        @elseif($ambassador->receiver_id != null)
                                        {{$ambassador->receiver->user_name}}
                                        @else
                                        System Transactions
                                        @endif
                                    </p>
                                    <p>Description: {{$ambassador->description}}</p>
                                    <p>Amount: {{$ambassador->amount}} MIND</p>
                                    <p>Type: {{$ambassador->type}}</p>
                                    <p>Status: {{$ambassador->status}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

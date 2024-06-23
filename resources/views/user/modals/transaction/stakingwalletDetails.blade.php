 <!-- Modal for displaying details -->
                    <div class="modal fade" id="bonusdetailsModal{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{$loop->index}}" aria-hidden="true">
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
                                    <p>Date: {{$staking->created_at}}</p>
                                    <p>Category: {{$staking->method}}</p>
                                    <p>Received from/Paid to:
                                        @if($staking->received_from != null)
                                        {{$staking->sender->user_name}}
                                        @elseif($staking->receiver_id != null)
                                        {{$staking->receiver->user_name}}
                                        @else
                                        System Transactions
                                        @endif
                                    </p>
                                    <p>Description: {{$staking->description}}</p>
                                    <p>Amount: {{$staking->amount}} MIND</p>
                                    <p>Type: {{$staking->type}}</p>
                                    <p>Status: {{$staking->status}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
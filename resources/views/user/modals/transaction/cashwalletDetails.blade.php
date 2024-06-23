                                 
<!-- The Modal -->
 <!-- Modal for displaying details -->
    <div class="modal fade" id="detailsModal{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{$loop->index}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel{{$loop->index}}">Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Content to display details -->
                    <p>Date: {{$cash->created_at}}</p>
                    <p>Category: {{$cash->method}}</p>
                    <p>Received from/Paid to: 
                        @if($cash->received_from != null)
                            {{$cash->sender->user_name}}
                        @elseif($cash->receiver_id != null)
                            {{$cash->receiver->user_name}}
                        @else
                            System Transactions
                        @endif
                    </p>
                    <p>Description: {{$cash->description}}</p>
                    <p>Amount: {{$cash->amount}}$</p>
                    <p>Type: {{$cash->type}}</p>
                </div>
            </div>
        </div>
    </div>
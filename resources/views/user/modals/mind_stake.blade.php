<div class="wallet-btn">
  <button type="button" data-toggle="modal" data-target="#mindStake" data-whatever="" class="btn btn-sm stake text-capitalize">
      <!-- SVG and Button Content -->
  </button>

  <div class="modal withdraw-modal fade" id="mindStake" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">MIND Stake</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body m-stake">
                  <form method="post" action="{{route('buy-token')}}">
                      <div class="form-group">
                          <label for="walletType" class="col-form-label">Wallet Type</label>
                          <select class="form-control" id="wallet_type" name="wallet_type">
                              <option value="musd">mUSD</option>
                              <option value="usd">USDT</option>
                          </select>
                      </div>

                      <div class="form-group d-flex">
                          <label for="mindAvlBal" class="col-form-label">Available Balance ($)</label>
                          <input type="text" disabled class="form-control" id="balance_display">
                        </div>
                      <div class="form-group">
                          <label for="mindStakePrice" class="col-form-label">MIND Price ($)</label>
                          <input type="text" class="form-control" disabled id="mindStakePrice" value="{{$data['settings']->token_convert_rate}}">
                      </div>
                      <div class="form-group">
                          <label for="mind-amount-stake" class="col-form-label">Quantity (MIND)</label>
                          <input type="number" onchange="calculate()" class="form-control col-lg-8" id="amount" name="quantity" required pattern="[0-9]*" min="1" max="5000">
                      </div>
                      <div class="form-group">
                          <label for="mind-tv-stake" class="col-form-label">Total Values ($)</label>
                          <input type="text" id="total_value" readonly class="form-control col-lg-8" name="total_value" required>
                      </div>
                      <div class="form-group">
                          <label for="mind-tv-stake" class="col-form-label">Buying Fee (%)</label>
                          <input type="text" readonly class="form-control col-lg-8" value="{{$data['settings']->buying_commission}}">
                      </div>
                      <div class="form-group">
                          <label for="mind-tv-stake" class="col-form-label">Payable ($)</label>
                          <input type="text" readonly id="payable" name="payable" class="form-control col-lg-8" required>
                      </div>

                      
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Stake</button>
              </div>
          </div>
      </div>
  </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {


var walletTypeElement = document.getElementById('wallet_type');
var balanceDisplayElement = document.getElementById('balance_display');
var usdBalance = document.getElementById("usd_balance").value;
var musdBalance = document.getElementById("musd_balance").value;


// Event listener for when the select dropdown changes
walletTypeElement.addEventListener("change", function() {
            var selectedWallet = walletTypeElement.value;

            // Update the input field value based on the selected wallet
            if (selectedWallet === "musd") {
              test = "{{$data['sum_deposit'] ? '$'.number_format((float)$data['sum_deposit'], 2, '.', '') : '$00.00'}}";
              console.log(test); 

              balanceDisplayElement.value = "{{$data['sum_deposit'] ? '$'.number_format((float)$data['sum_deposit'], 2, '.', '') : '$00.00'}}";
            } else if (selectedWallet === "usd") {
              balanceDisplayElement.value = "{{$data['sum_usdwallet'] ? '$'.number_format((float)$data['sum_usdwallet'], 2, '.', '') : '$00.00'}}";
            }
        });


// Trigger change event on page load to set initial balance
walletTypeElement.dispatchEvent(new Event('change'));
});


function calculate(){


var amount = document.getElementById('amount').value;
var value = amount * <?php echo $data['settings']->token_convert_rate ?>;


document.getElementById('total_value').value= value;
var payable= value * ( <?php echo $data['settings']->buying_commission ?>/100)+value;
document.getElementById('payable').value= payable;

}
</script>
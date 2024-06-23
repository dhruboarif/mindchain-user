<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BonusWallet;
use Auth;

use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;

// Set up your Coinbase API credentials
// $apiKey = config('coinbase.api_key');
// $apiSecret = config('coinbase.api_secret');

// // Initialize the Coinbase client
// $configuration = Configuration::apiKey($apiKey, $apiSecret);
// $client = Client::create($configuration);

// // Get the user's wallet balance
// $userWallet = $client->getAccount('your_wallet_id'); // Replace with the actual wallet ID
// $balance = $userWallet->getBalance();

// // Access balance details
// $balanceAmount = $balance->getAmount();
// $balanceCurrency = $balance->getCurrency();

// // Display the balance to the user
// echo "Your wallet balance: $balanceAmount $balanceCurrency";

class PaymentController extends Controller
{
    public function index()
    {
        // $response['transactions'] = Transaction::all();
        // return view('Pages.Metamsk.metamask')->with($response);
    }
    /**
     * create New Transaction
     *
     * @param  mixed $request
     * @return void
     */
    public function create(Request $request)
    {
        $txHash = $request->input('txHash');
        $amount = $request->input('amount');
        
        //dd($txHash, $amount, $request->all());


        
        // return  Transaction::create([
        //     "txHash" => $request->txHash,
        //     "amount" => $request->amount,
        // ]);

        $deposit = new BonusWallet();

    $deposit->user_id = Auth::id();
    $deposit->amount = $amount;
    //$deposit->method=$method;
    $deposit->wallet_id= '';

    $deposit->method = 'Deposit';
    $deposit->type = 'Credit';
    $deposit->status = 'approved';
    $deposit->description= 'Deposit Automatic';
    $deposit->txn_id = $txHash;
    $deposit->save();

      return back()->with('Money_added', 'Successfully Added Funds.!!');
    }
    
}

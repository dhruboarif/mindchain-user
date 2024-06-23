<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityToken; 
use Illuminate\Support\Facades\Storage;
use App\Exceptions\GeneralException;


class CommunityTokenController extends Controller
{
    public function index()

      {
    
        $packages= CommunityToken::all();
        return view('admin.pages.community_tokenlist',compact('packages'));


      }
      
      public function store(Request $request)
      {
          //dd($request->all());
          
        $image = $request->file('file');
        $filename = null;
        if ($image) {
          $filename = time() . $image->getClientOriginalName();
          Storage::disk('public')->putFileAs(
            'communitytoken/',
            $image,
            $filename
          );
        }
    
    // Validate the request data
    $request->validate([
        'token_name' => 'required',
        'contract_address' => 'required',
        'blockchain' => 'required', // Correct the key from 'blockchain' to 'blockchian'
        'total_supply' => 'required|numeric',
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);


    // Create a new community token
    $communityToken = new CommunityToken();
    $communityToken->image = $filename;
    $communityToken->token_name = $request->token_name;
    $communityToken->contract_address = $request->contract_address;
    $communityToken->blockchain = $request->blockchain; // Correct the key here
    $communityToken->total_supply = $request->total_supply;

    // Save the community token
    $communityToken->save();
    
        return back()->with('package_added', 'CommunityToken Successfully Added!!');
      }
}

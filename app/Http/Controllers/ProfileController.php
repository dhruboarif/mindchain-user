<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\GeneralException;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function profile($id)
  {
    return view('user.pages.user_profile');
  }
  public function UpdateProfile(Request $request): RedirectResponse
  {

   

    $request->validate([
        'name' => 'required|string|max:255',
        'gender' => 'required|in:male,female,Male,Female',
        'date_of_birth' => 'required|date',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'country' => 'required|string', // You may want to adjust the max length based on your needs
        'postal_code' => 'required|string|max:20',
        'contact' => 'required|numeric',
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size limit
        'nid_passport' => 'required|string|max:255',
    ]);
    //dd($request->all());
    
    $address = $request->address;
    $name=$request->name;
    $contact=$request->contact;

    $date_of_birth=$request->date_of_birth;
    $gender=$request->gender;
    $city= $request->city;
    $country=$request->country;
    $postal_code= $request->postal_code;


    $image=$request->file('file');
    $filename=null;
    if ($image) {
        $filename = time() . $image->getClientOriginalName();

        Storage::disk('public')->putFileAs(
            '/User',
            $image,
            $filename
        );
    }

    $user = User::find(Auth::user()->id);
    $user->address = $address;
    $user->name =$name;
    $user->contact =$contact;
    $user->date_of_birth =$date_of_birth;
    $user->gender =$gender;
    $user->city= $city;
    $user->country= $country;
    $user->postal_code= $postal_code;
    $user->image=$filename;
    $user->nid_passport= $request->nid_passport;

    $user->save();

      return back()->with('profile_updated','Profile has been updated successfully!');
  }
  public function changePassStore(Request $request){
   
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:5',
        'password_confirmation' => 'required|min:5',
    ]);

    $db_pass = Auth::user()->password;
    $current_password = $request->old_password;
    $newpass = $request->new_password;
    $confirmpass = $request->password_confirmation;

   if (Hash::check($current_password,$db_pass)) {
    if ($newpass === $confirmpass) {
        User::findOrFail(Auth::id())->update([
          'password' => Hash::make($newpass)
        ]);

        Auth::logout();

      return Redirect()->route('login')->with('password_updated','Password has been updated successfully!');

    }else {

      $notification=array(
          'message'=>'New Password And Confirm Password Not Same',
          'alert-type'=>'error'
      );
      return Redirect()->back()->with($notification);
    }
 }else {
  $notification=array(
      'message'=>'Old Password Not Match',
      'alert-type'=>'error'
  );
  return Redirect()->back()->with($notification);
 }
}
}

<?php

namespace App\Http\Controllers;
use App\Models\BaseMind;
use App\Models\User;

use App\Models\CommunityTokenPackageSettings; 
use Illuminate\Support\Facades\Storage;
use App\Models\BmindTarget; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseMindController extends Controller
{
    public function index()
      {
    
        $packages = BaseMind::all();
    
        return view('admin.pages.bmind.base_mind_stage_list', compact('packages'));
      }
      
      public function store(Request $request)
      {
    //dd($request->all());
        $image = $request->file('file');
        $filename = null;
        if ($image) {
          $filename = time() . $image->getClientOriginalName();
          Storage::disk('public')->putFileAs(
            'basemind/',
            $image,
            $filename
          );
        }
    
        $basemind = new BaseMind();
        $basemind->image = $filename;
        $basemind->title = $request->title;
        $basemind->total_token_issues = $request->total_token_issues;
        $basemind->token_base_price = $request->token_base_price;
        $basemind->duration = $request->duration;
        $basemind->lvl1_bonus = $request->lvl1_bonus;
        $basemind->lvl2_bonus = $request->lvl2_bonus;
        $basemind->lvl3_bonus = $request->lvl3_bonus;
        $basemind->lvl4_bonus = $request->lvl4_bonus;
        $basemind->lvl5_bonus = $request->lvl5_bonus;
        $basemind->start_date = $request->start_date;
        $basemind->end_date = $request->end_date;
        $basemind->status = $request->status;

        $basemind->save();
    
        return back()->with('package_added', 'Stage Added Successfully Added!!');
      }
      
      public function edit($id)
      {
        $package = BaseMind::find($id);
        return view('admin.pages.bmind.bmind_edit', compact('package'));
      }
      
      
      public function update(Request $request)
    {
    if ($request->file('uimage') != null) {
      $image = $request->file('file');
      $filename = null;
      $uploadedFile = $request->file('uimage');
      $oldfilename = $package['image'] ?? 'demo.jpg';
      $oldfileexists = Storage::disk('public')->exists('basemind/' . $oldfilename);

      if ($uploadedFile !== null) {
        if ($oldfileexists && $oldfilename != $uploadedFile) {
          //Delete old file
          Storage::disk('public')->delete('basemind/' . $oldfilename);
        }
        $filename_modified = str_replace(' ', '_', $uploadedFile->getClientOriginalName());
        $filename = time() . '_' . $filename_modified;
        Storage::disk('public')->putFileAs(
          'basemind/',
          $uploadedFile,
          $filename
        );
        $data['uimage'] = $filename;
      } elseif (empty($oldfileexists)) {
        // throw new \Exception('Client image not found!');
        $uploadedFile = null;

        $notification = array(
          'message' => 'Client Image Not Found !!!',
          'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
        //file check in storage
      }
    }


    $basemind = BaseMind::find($request->id);
    if ($request->file('uimage') != null) {
      $basemind->image = $filename;
    }
        $basemind->title = $request->title;
        $basemind->total_token_issues = $request->total_token_issues;
        $basemind->token_base_price = $request->token_base_price;
        $basemind->duration = $request->duration;
        $basemind->lvl1_bonus = $request->lvl1_bonus;
        $basemind->lvl2_bonus = $request->lvl2_bonus;
        $basemind->lvl3_bonus = $request->lvl3_bonus;
        $basemind->lvl4_bonus = $request->lvl4_bonus;
        $basemind->lvl5_bonus = $request->lvl5_bonus;
        $basemind->start_date = $request->start_date;
        $basemind->end_date = $request->end_date;
        $basemind->status = $request->status;
        $basemind->save();
    return back()->with('package_updated', 'Stage Updated Successfully Updated!!');
  }

     public function baseMindPacakgeSettings()
      {
    
        $packages = CommunityTokenPackageSettings::where('status', 'Active')->with('basemind')->get();
    
        return view('admin.pages.bmind.base_mind_package_list', compact('packages'));
      }
      
      public function storeBmindPackage(Request $request)
      {
//dd($request->all()); 
        $addBmindPackage = new CommunityTokenPackageSettings();
        $addBmindPackage->base_mind_id = $request->base_mind_id;
        $addBmindPackage->amount = $request->amount;
        $addBmindPackage->daily_bonus = $request->daily_bonus;
        $addBmindPackage->sponsor_bonus = $request->sponsor_bonus;
        $addBmindPackage->status = $request->status;
        $addBmindPackage->save();
    
        return back()->with('package_added', 'Package (Amount) Successfully Added!!');
      }
      
      
      public function baseMindPackageedit($id)
      {
        $package = CommunityTokenPackageSettings::with('basemind')->find($id);
        return view('admin.pages.bmind.bmind_package_edit', compact('package'));
      }
      
      
      
       public function updateBmindPackage(Request $request)
    {
//dd($request->all());
        $updateBmindPackage = CommunityTokenPackageSettings::find($request->id);

            $updateBmindPackage->base_mind_id = $request->base_mind_id;
            $updateBmindPackage->amount = $request->amount;
            $updateBmindPackage->daily_bonus = $request->daily_bonus;
            $updateBmindPackage->sponsor_bonus = $request->sponsor_bonus;
            $updateBmindPackage->status = $request->status;
            $updateBmindPackage->save();
            
        return back()->with('package_updated', 'Stage package Successfully Updated!!');
      }
      
      
      public function target_lists()
        {
          $target= BmindTarget::get();
          
          //dd($users);
          
          return view('admin.pages.bmind.target_list',compact('target'));
        }
   
        public function target_store(Request $request)
        {
            //dd($request->all());
            // Validation code from the previous step
        $validator = Validator::make($request->all(), [
        'user_name' => 'required|exists:users,user_name',
        'target_amount' => 'required|numeric',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'status' => 'required|in:1,0',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::where('user_name', $request->user_name)->first(); 
        //dd($user); 
            // If validation passes, continue with storing the data
            $bmindTarget = new BmindTarget();
            $bmindTarget->user_id = $user->id;
            $bmindTarget->target_amount = $request->input('target_amount');
            $bmindTarget->start_date = $request->input('start_date');
            $bmindTarget->end_date = $request->input('end_date');
            $bmindTarget->status = $request->input('status');
            $bmindTarget->save();
        
            return redirect()->back()->with('success', 'Target added successfully');
        }
   
      
}

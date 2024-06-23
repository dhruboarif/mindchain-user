<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User; 
use App\Mail\CustomizeEmail; 
use App\Jobs\SendEmailQueueJob; 

class AdminEmailController extends Controller
{
    public function compose()
    {
        // You can load any necessary data here if needed
        return view('admin.compose_email');
    }
    
    public function send(Request $request)
    {

        $req = $request->all();
        //dd($req); 
        // Retrieve data from the request
    $subject = $request->input('subject');
    $content = $request->input('wysiwyg-editor');
    $status = $request->input('status');
    $email = $request->input('email');

    //dd($user);


// Send the email to all active users
    if ($status === 'active') {
        $activeUsers = User::where('user_purchase_status', '1')->get();
        foreach ($activeUsers as $user) {
             SendEmailQueueJob::dispatch($user->email, $subject, $content, $user);
        }
    }elseif($status === 'inactive'){
        $inactiveUsers = User::where('user_purchase_status', '0')->get();
        foreach ($inactiveUsers as $user) {
             SendEmailQueueJob::dispatch($user->email, $subject, $content, $user);
        }
    }elseif($status === 'consultant'){
        $consultants = User::where('consultant', '1')->get();
        foreach ($consultants as $user) {
             SendEmailQueueJob::dispatch($user->email, $subject, $content, $user);
        }
    }elseif($status === 'ambassador'){
        $ambassadors = User::where('ambassador', '1')->get();
        foreach ($ambassadors as $user) {
             SendEmailQueueJob::dispatch($user->email, $subject, $content, $user);
        }
    }else{
        $user = User::where('email', $email)->first();
        //dd($user);
             SendEmailQueueJob::dispatch($user->email, $subject, $content, $user);
    }
    
   

    //dd($content);
    // Fetch users based on the selected status
    //$users = User::get();
        //dd($users);

    // Send emails to each user
    // Dispatch email jobs for each user
    // foreach ($users as $user) {
    //     SendEmailQueueJob::dispatch('dhrubo.computers2023@gmail.com', $subject, $content);
    // }
  
    // foreach ($users as $user) {
    //     Mail::to('dhrubo.computers2023@gmail.com')
    //         ->send(new CustomizeEmail($subject, $content));
    //     }

    // // Fetch users based on the selected status
    // $users = User::where('status', $status)->get();

    // Send emails to each user
    // foreach ($users as $user) {
    //     Mail::to($user->email)
    //         ->send(new CustomizeEmail($subject, $content, $user));
    // }



        
    // Send the email to all active users
    // if ($status === 'active') {
    //     $activeUsers = User::where('status', 'active')->get();
    //     foreach ($activeUsers as $user) {
    //         Mail::raw($content, function ($message) use ($subject, $user) {
    //             $message->subject($subject);
    //             $message->to($user->email);
    //         });
    //     }
    // }

        // Redirect back with a success message
        return redirect()->route('admin.compose.email')->with('success', 'Email sent successfully.');
    }
    
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AddMoney;
use App\Models\TokenWallet;
use App\Models\BonusWallet;
use Auth;
use DataTables;
use App\Models\Kyc;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\StakingWallet;
use App\Models\AmbassadorWallet;
use App\Models\CuponSetting;
use Carbon\Carbon;
use App\Models\UsdWallet;
use App\Models\Withdraw;
use App\Models\WithdrawBonus;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function landing()
    {
        return view('dist.index');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function adminHome()
    {
        $data['deposit_usd_count'] = UsdWallet::where('method','Deposit')->where('status', 'pending')->count();
        $data['withdraw'] = Withdraw::where('status', 'pending')->count();
        $data['pending_usd_withdraw']= UsdWallet::where('method', 'Withdraw')->where('status', 'pending')->count();
        $data['pending_token_withdraw']= WithdrawBonus::where('status','pending')->count();
        $data['kyc_pending'] = Kyc::where('status', 'pending')->count();
        $data['add_money']= AddMoney::where('method','Deposit')->where('status', 'pending')->count();
        $data['add_token']= BonusWallet::where('method','Deposit')->where('status', 'pending')->count();
        
        return view('admin.pages.index', compact('data'));
    }
    public function user_lists()
    {
      //$usersArray= User::select(['id','name','email','sponsor','status','user_name'])->with('sponsors')->get();
    //   $usersArray = [];
    //
    //   $users= User::select('id','user_name','email','sponsor','status')
    // ->orderBy('id','DESC')
    // ->chunk(100, function($users) use ($usersArray) {
    //     foreach ($users as $user) {
    //         $usersArray[] = $user;
    //     }
    // });
        $usersArray= User::where('consultant',1)->get();

      //return view('admin.pages.user_lists',compact('usersArray'));
      return view('admin.pages.user_lists', compact('usersArray'));
    }

   public function get_all_users(Request $request)
    {
      if($request->ajax()){
        $data = User::with('sponsors')->latest()->get();
       //dd($data);

        return DataTables::of($data)
        ->addIndexColumn()
        // ->editColumn('sponsor',function($row){
        //   $sponsor= User::where('id',$row->sponsor)->first();
        //   return $sponsor->user_name;
        // })
        // ->editColumn('sponsors', function($row)
        //                   {
        //                      return $row->sponsors;
        //                   })
        ->editColumn('sponsors', function($row) {
            return $row->sponsors->user_name ?? ''; // Fetch the user_name of the sponsor
        })
        ->editColumn('user_name',function($row){
          $name= '';
          $name= '<a class="username" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'">'.$row->user_name .' </a>';
          return $name;
        })
        ->addColumn('action',function($row){
          $actionBtn = '';
          $actionBtn .= '  <a class="user_view" href="#" data-bs-toggle="modal" data-id="'.$row->id.'"><i class="fa-solid fa-eye"></i> </a>
          <a class="password" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'"><i class="fa-solid fa-key"></i> </a>

          <a class="ambassador" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'"><i class="fa-solid fa-ranking-star"></i> </a>
          ';
          if($row->consultant == '0') {
              $actionBtn .= '<a class="consultant" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'"><i class="fa fa-american-sign-language-interpreting"></i> </a>';
          }
          if($row->status == 1)
          {
            $actionBtn .= '<a class="userrestrict" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'"><i class="fa-solid fa-skull-crossbones"></i> </a>';
          }else {
            $actionBtn .= '<a class="userunrestrict" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'"><i class="fa-solid fa-skull-crossbones"></i> </a>';
          }
          return $actionBtn;
        })
        ->rawColumns(['action','user_name'])
        ->make(true);

      }
    }
    
    
    public function CashwalletTransaction(Request $request)
{   
    if($request->ajax()) {
        $query = null;

        switch($request->type) {
            case 'CashWallet':
                $query = AddMoney::where('status', 'approve');
                break;
            case 'TokenWallet':
                $query = TokenWallet::query();
                break;
            case 'BonusWallet':
                $query = BonusWallet::where('status', 'approved');
                break;
            case 'StakingWallet':
                $query = StakingWallet::query();
                break;
            case 'AmbassadorWallet':
                $query = AmbassadorWallet::where('status', 'approved');
                break;
            default:
                $query = AddMoney::query();
        }
        if($request->start_date && $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::parse($request->end_date)->toDateString();
            $query->whereDate('created_at', '>=', $start_date)
                  ->whereDate('created_at', '<=', $end_date);
        } elseif($request->start_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $query->whereDate('created_at', '>=', $start_date);
        } elseif($request->end_date) {
            $end_date = Carbon::parse($request->end_date)->toDateString();
            $query->whereDate('created_at', '<=', $end_date);
        }

        if($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        $data = $query->get();

        $amount = $data->sum('amount');

        $symbole = ($request->type == 'CashWallet') ? '$' : 'MIND';

        $amount_text = $request->type . ' Balance: ' . $symbole . ' ' . number_format($amount, 2, '.', '');

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('user_name', function($row) {
                return optional(User::find($row->user_id))->user_name;
            })
            ->editColumn('created_at', function($row) {
                return Carbon::parse($row->created_at)->format('d-m-Y');
            })
            ->editColumn('amount', function($row) {
                return $row->amount;
            })
            ->editColumn('received_from', function($row) {
                $user_id = $row->received_from ?? $row->receiver_id;
                return optional(User::find($user_id))->user_name ?? '--';
            })
            ->rawColumns(['user_name'])
            ->with(['amount' => $amount_text])
            ->make(true);
    }
}

    
     public function TokenwalletTransaction(Request $request)
    {
        if($request->ajax()){
        $data = TokenWallet::with('user','receiver','sender')->latest()->get();
       //dd($data);

        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('user_name',function($row){
          $user= User::where('id',$row->user_id)->first();
          return $user->user_name;
        })
         ->editColumn('created_at',function($row){
            $created_at = $row->created_at->format('d-m-Y');
          return $created_at;
        })
         ->editColumn('amount',function($row){
            $amount = $row->amount . ' MIND';
            return $amount;
        })
        ->editColumn('received_from',function($row){
            if($row->received_from != null)
            {
             $user= User::where('id',$row->received_from)->first();
             return $user->user_name;
            }elseif($row->receiver_id != null)
            {
            $user= User::where('id',$row->receiver_id)->first();
             return $user->user_name;
            }else
            {
                return '--';
            }
         
        })
        // ->editColumn('user_name',function($row){
        //   $name= '';
        //   $name= '<a>'.$row->user_name .' </a>';
        //   return $name;
        // })
        
       
        ->rawColumns(['user_name'])
        ->make(true);

      }
    }
     public function BonuswalletTransaction(Request $request)
    {
        if($request->ajax()){
        $data = BonusWallet::with('user','receiver','sender')->latest()->get();
       //dd($data);

        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('user_name',function($row){
          $user= User::where('id',$row->user_id)->first();
          return $user->user_name;
        })
         ->editColumn('created_at',function($row){
            $created_at = $row->created_at->format('d-m-Y');
          return $created_at;
        })
         ->editColumn('amount',function($row){
            $amount = $row->amount . ' MIND';
            return $amount;
        })
        ->editColumn('received_from',function($row){
            if($row->received_from != null)
            {
             $user= User::where('id',$row->received_from)->first();
             return $user->user_name;
            }elseif($row->receiver_id != null)
            {
            $user= User::where('id',$row->receiver_id)->first();
             return $user->user_name;
            }else
            {
                return '--';
            }
         
        })
        // ->editColumn('user_name',function($row){
        //   $name= '';
        //   $name= '<a>'.$row->user_name .' </a>';
        //   return $name;
        // })
        
       
        ->rawColumns(['user_name'])
        ->make(true);

      }
    }
    public function ambassador_lists()
    {
      $users= User::where('ambassador','1')->get();
      
      return view('admin.pages.ambassador_lists',compact('users'));
    }
    public function merchant_lists()
    {
      $users= User::where('merchant_status','1')->get();
      
      return view('admin.pages.merchant_lists',compact('users'));
    }
    public function consultant_lists()
    {
      $users= User::where('consultant',2)->get();
      
      //dd($users);
      
      return view('admin.pages.consult_lists',compact('users'));
    }
    
    public function elite_member_lists()
    {
      $users= User::where('elite_club',1)->get();
      
      //dd($users);
      
      return view('admin.pages.elite_member_list',compact('users'));
    }
    
    public function add_consultant(Request $request)
    {
        $data = User::select('id', 'name')->where([
            ['name', 'LIKE', '%'.$request->search.'%'],
            'consultant' => '0'
        ])->paginate(10);
        return response()->json($data);
    }
    
    public function getUser(Request $request)
    {

        $userName = User::where('user_name','like',$request->search)->select('id','user_name')->first();
        if ($userName){
            return response()->json(['success'=>'<span style="color: green;">User found!!</span>','data'=>$userName],200);
        }else{
            return response()->json(['success'=>'<span style="color: red;">User not found!!</span>'],200);
        }

    }
    public function changePassword(Request $request)
  {
    //dd($request->id)
    $newpass = $request->password;

    $upuser= User::find($request->id);
    $upuser->password = Hash::make($newpass);
    $upuser->save();



      return back()->with('password_changed','Password Changed successfully');

  }
  public function MakeAmbassador(Request $request)
  {
      //dd($request);
      $user_id= User::find($request->id);
      $user_id->ambassador='1';
      $user_id->save();
      return back()->with('ambassador_added', 'User added to ambassador Lists!!');
  }
  public function MakeConsultant(Request $request)
  {
      //dd($request);
      $user_id= User::findOrFail($request->id);
      $user_id->consultant='2';
      $user_id->save();
      if($request->type) {
          return response()->json([
            'status' => 'success'
          ]);
      }
      return back()->with('consultant_added', 'User added to consultant Lists!!');
  }
  
  
  public function RemoveConsultant(Request $request)
  {
      //dd($request);
      $user_id= User::findOrFail($request->id);
      $user_id->consultant='0';
      $user_id->save();
      if($request->type) {
          return response()->json([
            'status' => 'success'
          ]);
      }
      //return back()->with('consultant_added', 'User added to consultant Lists!!');
  }
  public function AdminTransaction()
  {
     $data['sum_deposit']=AddMoney::sum('amount');
    $data['sum_deposit_token']=TokenWallet::sum('amount');
    $data['sum_deposit_bonus']=BonusWallet::sum('amount');
    $users = User::where('is_admin', 0)->get()->take(5);
    return view('admin.pages.transactions',compact('data', 'users'));

  }
  public function UserRestrict(Request $request)
  {
      //dd($request);
      $user_id= User::find($request->id);
      $user_id->status='0';
      $user_id->save();
      return back()->with('ambassador_added', 'User has been Blocked!!');
  }
  public function UserUnRestrict(Request $request)
  {
     // dd($request);
      $user_id= User::find($request->id);
      $user_id->status='1';
      $user_id->save();
      return back()->with('ambassador_added', 'User has been UnBlocked!!');
  }
    public function user_id($id)
  {
    
    //$user_id = User::where('id',$id)->first();
    
    $cash = AddMoney::where('user_id',$id)->where('status','approve')->sum('amount');
    $token = TokenWallet::where('user_id',$id)->sum('amount');
     $bonus = BonusWallet::where('user_id',$id)->where('status','approved')->sum('amount');
      $staking = StakingWallet::where('user_id',$id)->sum('amount');
     //dd($cash,$token,$bonus);
     return response()->json(['cash' => $cash, 'token'=> $token, 'bonus'=> $bonus, 'staking'=> $staking]);
  }
  public function profile_id($id)
  {
    
    $user = User::where('id',$id)->first();
    
//   $user= DB::table('users')
//             ->join('kycs', 'users.id', '=', 'kycs.user_id')
//             ->select('users.*', 'kycs.image', 'kycs.image2','kycs.image3','kycs.status')
//             ->where('users.id', $id)
//             ->first();
  //dd($user);
  //$kyc= Kyc:: where('user_id',$id)->first();
     //dd($cash,$token,$bonus);
     return response()->json(['user' => $user]);
  }
  
  public function search_user(Request $request)
  {
      $users = User::select(['id', 'user_name'])->where('user_name', 'like', '%' . $request->username . '%')->get()->take(10);
      return response()->json($users);
  }
}

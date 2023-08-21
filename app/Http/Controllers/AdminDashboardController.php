<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Networks;
use Carbon\Carbon;
use Mail;

class AdminDashboardController extends Controller
{
    public function loadAdminLogin(){
        return view('adminLogin');
    }

    public function loadAdminDashboard(){
        $loggedInUserId = Auth::id();
        $rewardsCount = Networks::select('parent_user_id', DB::raw('count(parent_user_id) as count'))
            ->groupBy('parent_user_id')
            ->having('count', '>', 0)
            ->get();
           
        $userData = User::where('id', '<>', $loggedInUserId)->get();
        //echo "<pre>"; print_r($userData); echo "</pre>";
        return view('adminDashboard',compact(['userData','rewardsCount']));
    }

    public function trackInformation(){
        
        $dateLables = [];
        $dateData = [];

        for($i=30; $i >= 0; $i--){
           $dateLables[] = Carbon::now()->subdays($i)->format('d-m-Y');
           $dateData[] = Networks::whereDate('created_at', Carbon::now()->subDays($i)->format('Y-m-d'))
                      ->where('parent_user_id', Auth::user()->id)->count();
        }
        //echo '<pre>'; print_r($dateData);die();

        $dateLables = json_encode($dateLables);
        $dateData = json_encode($dateData);

        return view('trackinformation',compact(['dateLables','dateData']));
    }

    public function deleteUser(Request $request){
        $id = $request->id;

        try{
            
            User::where('id', $id)->delete();
            return response()->json(['success'=>true]);

        }catch(\Exception $e){
            
            return response()->json(['success'=>false, 'msg'=>$e->getMessage()]);
        }
    }
}

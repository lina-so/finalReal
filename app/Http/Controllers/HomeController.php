<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $sales=DB::select('select sum(price) as sales from realestates');
        //  $TodayMony=DB::select('select sum(price) from realestates where created_at=? and status=?',[Carbon::now(),"success"]);
         $AllReal = DB::table('realestates')->count();
         $reserve = DB::table('reserves')->count();

         $AllUsers = DB::table('users')->count();
         $Alldesire = DB::table('desires')->count();
         $rent = DB::table('realestates')->where('state','rent')->where('status','success')->whereNull('deleted_at')->count();
         $sale = DB::table('realestates')->where('state','sale')->where('status','success')->whereNull('deleted_at')->count();

        //  $real=DB::select('select user_id,id as real_id ,price,status,property_type  from realestates where deleted_at is  null and status = success and status = pending)');

        $real = DB::table('realestates')
        ->select('user_id', 'id as real_id','price','status','property_type','state')   
        ->whereNull('deleted_at')
        ->where('status', 'like', 'success')
        ->get();

        //  dd($real);
        
        $role=Auth::User()->role;

        if($role=='admin'){

            return view('home',compact('sales','AllReal','AllUsers','Alldesire','rent','sale','real','reserve'));
        }

        if($role=='user'){

        return "sorry you is not admin!";
        }


        }
}

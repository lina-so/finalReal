<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Reserve;
use Carbon\Carbon;
use App\Models\Realestate;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    

        $reals=Reserve::select('user_id','real_id')->whereDate('created_at', '<', Carbon::now()->subDays(1))->
        get();

        // dd($reals);

        foreach($reals as $real)
        {
            $pend='failed';
    
            $update=Realestate::where('id', '=', $real->real_id)->where('user_id', '=', $real->user_id)
            ->update(['status' => $pend]);
   
        }

        $reserve=Reserve::whereDate('created_at', '<', Carbon::now()->subDays(1))->
        delete();


    

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}

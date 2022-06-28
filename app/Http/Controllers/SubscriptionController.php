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
        $reserve=Reserve::whereDate('created_at', '<', Carbon::now()->subDays(1))->
        delete();

    

        $reals=Reserve::select('user_id','real_id')->whereDate('created_at', '<', Carbon::now()->subDays(1))->
        get();

        dd($reals);

        foreach($reals as $real)
        {
            $pend='failed';
            DB::update('update realestates set status = ? where real_id = ? and user_id',[$pend,$real->real_id,$real->user_id]);

            // dd($real->real_id);

        }

        // dd('done');
 

        // dd(Carbon::now()->subDays(1));
    

      
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

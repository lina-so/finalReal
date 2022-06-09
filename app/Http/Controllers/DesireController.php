<?php

namespace App\Http\Controllers;

use App\Models\Realestate;
use App\Models\User;
use App\Models\Desire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.AddDesire');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $desire = new  Desire;
        $desire->address  = $request->address;
        $desire->floor  = $request->floor;
        $desire->area  = $request->area;
        $desire->min_price  = $request->min_price;
        $desire->max_price  = $request->max_price;
        $desire->number_of_rooms  = $request->number_of_rooms;
        $desire->number_of_path_rooms  = $request->number_of_path_rooms;
        $desire->state  = $request->state;
        $desire->type  = $request->type;
        $desire->property_type  = $request->property_type;
        $desire->furnished=$request->furnished;
        $desire['services'] = json_encode($request->services);
        $desire->user_id = Auth::id();
        $desire->cities_id= $request->country;

        // // return $request;
        // $desire = new  Desire;
        // $desire->location  = $request->location;
        // $desire->city  = $request->city;
        // $desire->floor  = $request->floor;
        // $desire->area  = $request->area;
        // $desire->price  = $request->price;
        // $desire->number_of_rooms  = $request->number_of_rooms;
        // $desire->number_of_path_rooms  = $request->number_of_path_rooms;
        // $desire->state  = $request->state;
        // $desire->type  = $request->type;
        // $desire->property_type  = $request->property_type;
        // $desire->user_id = Auth::id();
        // $desire->save();

        // $desire->Desires()->attach($request);
        $desire->save();
        return redirect()->route('show')->with('success','Desire Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Desire  $desire
     * @return \Illuminate\Http\Response
     */
    public function show(Desire $desire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Desire  $desire
     * @return \Illuminate\Http\Response
     */
    public function edit(Desire $desire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Desire  $desire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desire $desire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Desire  $desire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desire $desire)
    {
        //
    }
}

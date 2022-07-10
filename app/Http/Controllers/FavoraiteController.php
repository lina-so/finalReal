<?php

namespace App\Http\Controllers;

use App\Models\Favoraite;
use App\Models\Realestate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class FavoraiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
  
    {
        // $favoraite=Favoraite::where('user_id',Auth::id())->get();
        $favoraite= DB::table('realestates as real')
        ->join('favoraites as fav', 'real.id', '=', 'fav.real_id')
        ->where('fav.user_id',Auth::id())
        ->select('real.*', 'fav.*')
        ->get();

        // dd($favoraite);
        return view('favoraite',compact('favoraite'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $user_id=Auth::id();
        $real_id=$id;
        $like= new Favoraite();
        $like->user_id=$user_id;
        $like->real_id=$real_id;
        $like->is_favoraite=1;
        $like->save();
        Alert::success('You Love This Realestate');


        return redirect()->route('show')->with('mess','You Liked This Property');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favoraite  $favoraite
     * @return \Illuminate\Http\Response
     */
    public function show(Favoraite $favoraite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favoraite  $favoraite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favoraite $favoraite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favoraite  $favoraite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favoraite $favoraite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favoraite  $favoraite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $favoraite=Favoraite::find($id);
        $user_id=Auth::id();
        $favoraite=DB::delete('delete from favoraites where real_id = ? and user_id = ?',[$id , $user_id]);
        // dd($user_id);
        // $favoraite->delete();
        return redirect()->route('show')->with('success','property deleted successfully');
    }
}

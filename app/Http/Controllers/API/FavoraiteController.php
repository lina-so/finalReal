<?php

namespace App\Http\Controllers\API;

use App\Models\Favoraite;
use App\Models\Realestate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;

class FavoraiteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()

    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $user_id=Auth::id();
        $real_id=$id;
        $like= new Favoraite();
        $like->user_id=$user_id;
        $like->real_id=$real_id;
        $like->is_favoraite=1;
        $like->save();

        return $this->sendResponse($like, 'Add To My Favoraite Successfully' );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Favoraite  $favoraite
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $favoraite= DB::table('realestates as real')
        ->join('favoraites as fav', 'real.id', '=', 'fav.real_id')
        ->where('fav.user_id',Auth::id())
        ->select('real.*', 'fav.*')
        ->get();
        
        return $this->sendResponse($favoraite, 'All My Favoraite ' );
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

        $user_id=Auth::id();
        $favoraite=DB::delete('delete from favoraites where real_id = ? and user_id = ?',[$id , $user_id]);
        return $this->sendResponse($favoraite, 'Remove From My Favoraite Successfully' );
    }
}

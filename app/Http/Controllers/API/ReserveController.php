<?php

namespace App\Http\Controllers\API;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Realestate;
use phpDocumentor\Reflection\Types\Boolean;

use function PHPUnit\Framework\isTrue;

class ReserveController extends BaseController
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


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
    public function store($id)
    {

        $user_id=Auth::id();
        $real_id=$id;
        $reserve= new Reserve;
        $reserve->is_reserve=1;
        $reserve->user_id=$user_id;
        $reserve->real_id=$real_id;
        $reserve->save();

        $days=4;
        $dateReserve=$reserve->created_at->addDays($days);

        $pend="pending";
        DB::update('update realestates set status = ? where id = ?',[$pend,$id]);
        DB::update('update realestates set end_r_date = ? where id = ?',[$dateReserve,$id]);

        return $this->sendResponse($reserve, " Your Reserve Added Successfully." );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Reserve $reserve)
    {
        $null=NULL;
        $reserve = DB::select('select * from reserves where deleted_at is NULL');

        return $this->sendResponse($reserve, "All Your Reserve." );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserve $reserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserve $reserve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id=Auth::id();
        $reserve=DB::delete('delete from reserves where real_id = ? and user_id = ?',[$id , $user_id]);

        $failed="failed";
        DB::update('update realestates set status = ? where id = ?',[$failed,$id]);
        DB::update('update realestates set end_r_date = ? where id = ?',[now(),$id]);

        return $this->sendResponse($reserve, 'Remove From My reserves Successfully' );
    }
}

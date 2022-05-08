<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realestate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\City;
use DB;

class SearchController extends Controller
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
    
    public function search()
    {
        return view('search');
    }
    public function result(Request $request)
    {
        // $country=request()->query('country');
        dd($request->country);
    }

}

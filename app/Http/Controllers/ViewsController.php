<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Realestate;
use Storage;
use File;
use Carbon\Carbon;
use App\Models\City;


class ViewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $realFav = DB::table('realestates')
        ->join('favoraites', 'favoraites.real_id', '=', 'realestates.id')
        ->select(DB::raw('count(favoraites.real_id) as realfav'))
        ->groupBy('favoraites.real_id')
        ->get(); 
        // dd($realFav);

        $reals = Realestate::latest()->paginate(8); 
        // dd($realFav);
        return view('show' , compact('realFav','reals'));
    }

    public function yourReal($id)
    {
        $user=Auth::user();
        $realestates = Realestate::whereHas('user', function($q) use($id) {
            $q->where('id', $id);
        })->get();
        return view('yourReal' , compact('realestates','user'));
    }

    public function details($id)
    {
        // $details=Realestate::find($id);
        $details= DB::table('realestates as real')
        ->join('cities as city', 'real.cities_id', '=', 'city.id')
        ->where('real.id',$id)
        ->select('real.*', 'city.*')
        ->get();
        $type= gettype($details);

        // dd($id);
        $user=auth::user()->id;
        // dd(auth::user()->id);
        return view('details' , compact('details','id','user'));
    }

    
    public function getPubliclyStorgeFile($filename)

    {
        $path = storage_path('app/images/loloo_4_07-04-22_15_50_04/'. $filename);
    
        if (!File::exists($path)) {
            abort(404);
        }
    
        $file = File::get($path);
        $type = File::mimeType($path);
    
        $response = Response::make($file, 200);
    
        $response->header("Content-Type", $type);
    
        return $response;
    
    }	

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realestate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\City;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;



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
        $country = $request->country;
        $address = $request->address;
        $floor = $request->floor;
        $area = $request->area;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $number_of_rooms = $request->number_of_rooms;
        $number_of_path_rooms = $request->number_of_path_rooms;
        $state = $request->state;
        $type = $request->type;
        $property_type = $request->property_type;

    
        if (empty($country) && empty($address) && empty($floor) && empty($area)&& empty($min_price)&& empty($max_price) && empty($number_of_rooms)&& empty($number_of_path_rooms)&& empty($state)&& empty($type)&& empty($property_type)) {
            Session::flash('danger', "You didn't select any search any search.");
            return redirect()->back();
        }
    
        $res = DB::table('realestates as real')
        ->join('cities', 'real.cities_id', '=', 'cities.id')
        ->where('floor',$floor)
        ->where('area',$area)
        ->whereBetween('price', [$min_price, $max_price])
        ->where('number_of_path_rooms',$number_of_path_rooms)
        ->where('number_of_rooms',$number_of_rooms)
        ->where('state',$state)
        ->where('type',$type)
        ->where('property_type',$property_type)
        ->select('real.*', 'cities.country')
        ->get()->toArray();


        $res1 = DB::table('realestates as real')
        ->join('cities', 'real.cities_id', '=', 'cities.id')
        ->where('floor',$floor)
        ->whereBetween('price', [$min_price, $max_price])
        ->where('number_of_rooms',$number_of_rooms)
        ->where('state',$state)
        ->where('property_type',$property_type)
        ->select('real.*', 'cities.country')
        ->get()->toArray();

        $res2 = DB::table('realestates as real')
        ->join('cities', 'real.cities_id', '=', 'cities.id')
        ->where('floor',$floor)
        ->where('state',$state)
        ->where('property_type',$property_type)
        ->select('real.*', 'cities.country')
        ->get()->toArray();


        $x=0;


        if(!empty($res))
         {
             $x=1;
             return view('resultSearch',compact('res'));
            echo 'res';
            // dd($res);
         }
        else if(!empty($res1))
        {
            // dd($res1);
            return view('resultSearch',compact('res1'));

          echo 'res1';
        //   dd($res1);
        }
        else if(!empty($res2))
        {
            // dd($res1);
            return view('resultSearch',compact('res2'));

          echo 'res2';
        //   dd($res1);
        }
        else 
        {
            echo 'not Found';
        }
  
                    
    }

}




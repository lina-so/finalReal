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

        $real = Realestate::query();
    
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
        $furnished=$request->furnished;

        $real = Realestate::when($request->address, function ($query, $address) {
            return $query->where('address', 'like', "%{$address}%");
        })->when($request->floor, function ($query, $floor) {
            return $query->where('floor',$floor);
        })->when($request->area, function ($query, $area) {
            return $query->where('area',$area);
        })->when($request->min_price, function ($query, $min_price) {
            return $query->where('price','>=',$min_price);
        })->when($request->max_price, function ($query, $max_price) {
            return $query->where('price','<=',$max_price);
        })->when($request->number_of_rooms, function ($query, $number_of_rooms) {
            return $query->where('number_of_rooms',$number_of_rooms);
        })->when($request->number_of_path_rooms, function ($query, $number_of_path_rooms) {
            return $query->where('number_of_path_rooms',$number_of_path_rooms);
        })->when($request->state, function ($query, $state) {
            return $query->where('state',$state);
        })->when($request->type, function ($query, $type) {
            return $query->where('type',$type);
        })->when($request->property_type, function ($query, $property_type) {
            return $query->where('property_type',$property_type);
        })->when($request->country, function ($query, $country) {
            return $query->where('cities_id',$country);
        })->when($request->furnished, function ($query, $furnished) {
            return $query->where('furnished',$furnished);
        })
        ->paginate(15);

    
        // dd($real);
        return view('resultSearch',compact('real'));
         
    }

}




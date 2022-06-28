<?php

namespace App\Http\Controllers\API;

use App\Models\Realestate;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\City as CityResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class SearchController extends BaseController
{
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
        ->get();

    

        return $this->sendResponse($real, 'search retireved Successfully!' );

         
    }


}

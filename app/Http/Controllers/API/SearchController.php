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

    public function search(Request $request)
    {
        $country = $request->country;
        $address = $request->address;
        $floor = $request->floor;
        $area = $request->area;
        $price = $request->price;
        $number_of_rooms = $request->number_of_rooms;
        $number_of_path_rooms = $request->number_of_path_rooms;
        $state = $request->state;
        $type = $request->type;
        $property_type = $request->property_type;
        $furnished = $request->furnished;
        $services = $request->services;
        $is_sales = $request->is_sales;
        $is_rent = $request->is_rent;
        $is_favoraite = $request->is_favoraite;



        if (empty($country) && empty($address) && empty($floor) && empty($area)&& empty($price)&& empty($number_of_rooms)&& empty($number_of_path_rooms)&& empty($state)&& empty($type)&& empty($property_type)) {
            return $this->sendResponse($request, "You didn't select any search any search." );
        }

        $search = DB::table('realestates as real')
        ->where('address','=',$address)
        ->orwhere('floor','=',$floor)
        ->orwhere('area','=',$area)
        ->orwhere('price','=', $price)
        ->orwhere('number_of_path_rooms','=',$number_of_path_rooms)
        ->orwhere('number_of_rooms','=',$number_of_rooms)
        ->orwhere('state','=',$state)
        ->orwhere('type','=',$type)
        ->orwhere('property_type','=',$property_type)
        ->orwhere('furnished','=',$furnished)
        ->orwhere('services','=',$services)
        ->orwhere('is_sales','=',$is_sales)
        ->orwhere('is_rent','=',$is_rent)
        ->orwhere('is_favoraite','=',$is_favoraite)
        ->orwhere('cities_id','=',$country)


        ->get()->toArray();


        return $this->sendResponse($search, 'search retireved Successfully!' );
    }
}

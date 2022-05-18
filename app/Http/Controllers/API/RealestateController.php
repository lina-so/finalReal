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



class RealestateController extends BaseController
{

    public function cities()
    {
        $cities = City::all();

        return $this->sendResponse(CityResource::collection($cities), 'cities retrieved Successfully!' );
    }
//--------------------------------------------------------------------------------------------
    public function details($id)
    {
        $details= DB::table('realestates as real')
        ->join('cities as city', 'real.cities_id', '=', 'city.id')
        ->where('real.id',$id)
        ->select('real.*', 'city.*')
        ->get();
        return $this->sendResponse($details, 'details retireved Successfully!' );

    }

    public function show()
    {
        $reals = Realestate::latest()->paginate(8);
        if (is_null($reals)) {
            return $this->sendError('reals not found!' );
        }
        return $this->sendResponse ($reals, 'reals retireved Successfully!' );

    }


    public function yourReal($id)
    {
        $real = Realestate::where('user_id' , $id)->get();

        return $this->sendResponse($real, 'real retrieved Successfully!' );
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'address'=>'required',
            'floor'=>'required',
            'area'=>'required',
            'price'=>'required',
            'number_of_rooms'=>'required',
            'number_of_path_rooms'=>'required',
            'cover'=>'required',
            'image'=>'required',
            'image_path'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        $user = Auth::user();
        $input['user_id'] = $user->id;
        $real = Realestate::create($input);
        return $this->sendResponse($real, 'Realestate added Successfully!' );

    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'address'=>'required',
            'floor'=>'required',
            'area'=>'required',
            'price'=>'required',
            'number_of_rooms'=>'required',
            'number_of_path_rooms'=>'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }

        $real = Realestate::find($id);
        if ( $real->user_id != Auth::id()) {
            return $this->sendError('you cannot have update' , $validator->errors());
        }
        $real->address = $input['address'];
        $real->floor = $input['floor'];
        $real->area = $input['area'];
        $real->price = $input['price'];
        $real->number_of_rooms = $input['number_of_rooms'];
        $real->number_of_path_rooms = $input['number_of_path_rooms'];
        $real->state = $input['state'];
        $real->type = $input['type'];
        $real->property_type = $input['property_type'];
        $real->user_id = Auth::id();
        $real->cities_id = $input['cities_id'];
        $real->save();

        return $this->sendResponse($real, 'real updated Successfully!' );

    }


    public function destroy($id)
    {
        $errorMessage = [] ;

        $real = Realestate::find($id);
        if ( $real->user_id != Auth::id()) {
            return $this->sendError('you dont have delete' , $errorMessage);
        }
        $real->delete();
        return $this->sendResponse($real, 'real deleted Successfully!' );

    }
}

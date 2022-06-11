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
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

use File;
use App\Models\Reserve;





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
            // 'image_path'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        $real = new  Realestate;
        $real->address  = $request->address;
        $real->floor  = $request->floor;
        $real->area  = $request->area;
        $real->price  = $request->price;
        $real->number_of_rooms  = $request->number_of_rooms;
        $real->number_of_path_rooms  = $request->number_of_path_rooms;
        $real->state  = $request->state;
        $real->type  = $request->type;
        $real->property_type  = $request->property_type;
        $real->user_id = Auth::id();
        $real->cities_id= $request->cities_id;

        $real->furnished  = $request->furnished;
        $real->services  = $request->services;
        $real->countF  = $request->countF;
        $real->description  = $request->description;
        $real->end_r_date  = $request->end_r_date;




       //process upload images
         $time = Carbon::now();

        $format_time=$time->format('d-m-y').'_'.$time->format('H').'_'.$time->format('i').'_'.$time->format('m');
        // $des='/images/'.Auth::user()->name.'_'.Auth::id().'_'.$format_time;
        $des=Auth::user()->name.'_'.Auth::id().'_'.$format_time;


         //process cover image

        if($request->hasFile("cover"))
        {
            $file=$request->file("cover");
            // $image = Realestate::where('user_id', '=', Auth::user()->id)->get();
            $image_name='cover' .'.'.$file->getClientOriginalExtension();
            $real->cover = $image_name;

            // $file->storeAs($des, $image_name);
            $file->move('images/'.$des,$image_name);

        }


        if($request->hasFile("image"))
        {
            $file=$request->file("image");
              $filename = $file->getClientOriginalName();

                $image_name = time().'.'.$file->getClientOriginalExtension();
                $request['user_id']=$real->id;
                $request['image']=$image_name;
                $real->image = $image_name;

                 // $files->storeAs('/images/', $filename);

                // $file->storeAs($des,$filename);

                $file->move('images/'.$des,$filename);

                



        }

        $real->image_path=$des;

        $real->save();
        return $this->sendResponse($real, 'Realestate added Successfully!' );

    }

    public function update(Request $request, $id)

    {
        $realestate=Realestate::find($id);
        // $realestate=Realestate::findOrFail($id);

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
            // 'image_path'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        $realestate->address  = $request->address;
        $realestate->floor  = $request->floor;
        $realestate->area  = $request->area;
        $realestate->price  = $request->price;
        $realestate->number_of_rooms  = $request->number_of_rooms;
        $realestate->number_of_path_rooms  = $request->number_of_path_rooms;
        $realestate->state  = $request->state;
        $realestate->type  = $request->type;
        $realestate->property_type  = $request->property_type;
        $realestate->user_id = Auth::id();
        $realestate->cities_id= $request->cities_id;

        //  update upload images
          $time = Carbon::now();

        $format_time=$time->format('d-m-y').'_'.$time->format('H').'_'.$time->format('i').'_'.$time->format('m');
        // $des='/images/'.Auth::user()->name.'_'.Auth::id().'_'.$format_time;


         $des=$realestate->image_path;

          //   update cover image

         if($request->hasFile("cover"))
         {
             $file=$request->file("cover");
             // $image = Realestate::where('user_id', '=', Auth::user()->id)->get();
             $image_name='cover' .'.'.$file->getClientOriginalExtension();
             $old_image=$realestate->cover;

             Storage::disk('public_uploads')->delete($des.'/'.$old_image);
              // if(Storage::disk('public_uploads')->exists($des.'/'.$old_image)){
              //      Storage::disk('public_uploads')->delete($des.'/'.$old_image);
              //     }else{
              //       dd($des.'/'.$old_image);
              //     }
             $realestate->cover = $image_name;
             $file->storeAs($des, $image_name);
         }

         //update images
         if($request->hasFile("image"))
         {
             $file=$request->file("image");
             foreach($file as $files)
             {
                 $filename = $files->getClientOriginalName();

                 $image_name = time().'.'.$files->getClientOriginalExtension();
                 $request['user_id']=$realestate->id;
                 $request['image']=$image_name;
                 $old_image=$realestate->image;
                //  Storage::disk('public_uploads')->delete($des.'/'.$old_image);
                Storage::delete($old_image);

                 $realestate->image = $image_name;

                 $files->storeAs($des,$image_name);


             }
         }


        $realestate->update();

        // DB::table('realestate')->where('id',$id)->update($data);
        return $this->sendResponse($realestate, 'real updated Successfully!' );


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



/*
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

}*/

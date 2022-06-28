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
        $real->furnished=$request->furnished;
        $real['services'] = json_encode($request->services);
        // $real->services=$request->services;
        $real->user_id = Auth::id();
        $real->cities_id= $request->cities_id;


        // $real = new  Realestate;
        // $real->address  = $request->address;
        // $real->floor  = $request->floor;
        // $real->area  = $request->area;
        // $real->price  = $request->price;
        // $real->number_of_rooms  = $request->number_of_rooms;
        // $real->number_of_path_rooms  = $request->number_of_path_rooms;
        // $real->state  = $request->state;
        // $real->type  = $request->type;
        // $real->property_type  = $request->property_type;
        // $real->user_id = Auth::id();
        // $real->cities_id= $request->cities_id;

        // $real->furnished  = $request->furnished;
        // $real->services  = $request->services;
        // $real->countF  = $request->countF;
        // $real->description  = $request->description;
        // $real->end_r_date  = $request->end_r_date;


         //process upload images
         $time = Carbon::now();

        $format_time=$time->format('d-m-y').'_'.$time->format('H').'_'.$time->format('i').'_'.$time->format('m');
        $des=Auth::user()->name.'_'.Auth::id().'_'.$format_time;
        // $des='/images/'.Auth::user()->name.'_'.Auth::id().'_'.$format_time;
        $url='/images/'.Auth::user()->name.'_'.Auth::id().'_'.$format_time.'/';

        $urls =array();


         //process cover image

        if($request->hasFile("cover"))
        {
            $file=$request->file("cover");
           
            $image_name='cover'.'.'.'jpg';

            $real->cover = $image_name;

            $file->move('images/'.$des,$image_name);
            // $file->storeAs($des, $image_name);
            array_push($urls,$url.$image_name);



        }

        $i=1;
        $c=0;

        if($request->hasFile("image"))
        {
            $file=$request->file("image");
            foreach($file as $files)
            {
                $filename =  $i++ .'.'. 'jpg';

                $image_name = $i+1 .'.'. 'jpg';
                $request['user_id']=$real->id;
                $request['image']=$image_name;
                $real->image = $image_name;
                $c++;

                 $files->move('images/'.$des,$filename);
                // $files->storeAs($des,$filename);
                array_push($urls,$url.$filename);


            }
        }

/************************************************* */
        //Done multi images

        // $files=$request->file("image");
        // $imageName='';

   
           
    
        //     foreach($files as $file)
        //     {
        //         $filename = $file->getClientOriginalName();
        //         $image_name = time().'.'.$file->getClientOriginalExtension();
        //         $request['user_id']=$real->id;
        //         $request['image']=$image_name;
        //         $real->image = $image_name;
    
        //         // $file->move(public_path('/images'),$image_name);
        //             $file->move('images/'.$des,$filename);
    
        //     }
    /************************************ */



        $real->image_path=$des;
        $real->countF=$c;
        $real->description=$request->description;
        $real['urls'] = json_encode($urls);
               
        $real->save();

        return $this->sendResponse($real, 'Realestate added Successfully!' );

    }

    public function update(Request $request, $id)

    {

        $real=Realestate::find($id);
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

        // $real = new  Realestate;
        $real->address  = $request->address;
        $real->floor  = $request->floor;
        $real->area  = $request->area;
        $real->price  = $request->price;
        $real->number_of_rooms  = $request->number_of_rooms;
        $real->number_of_path_rooms  = $request->number_of_path_rooms;
        $real->state  = $request->state;
        $real->type  = $request->type;
        $real->property_type  = $request->property_type;
        $real->furnished=$request->furnished;
        $real['services'] = json_encode($request->services);
        $real->user_id = Auth::id();
        $real->cities_id= $request->cities_id;


         //process upload images
         $time = Carbon::now();

        $format_time=$time->format('d-m-y').'_'.$time->format('H').'_'.$time->format('i').'_'.$time->format('m');
        $des=Auth::user()->name.'_'.Auth::id().'_'.$format_time;
        // $des='/images/'.Auth::user()->name.'_'.Auth::id().'_'.$format_time;
        $url='/images/'.Auth::user()->name.'_'.Auth::id().'_'.$format_time.'/';

        $urls =array();


         //process cover image

        if($request->hasFile("cover"))
        {
            $file=$request->file("cover");
           
            $image_name='cover'.'.'.'jpg';

            $real->cover = $image_name;

            $file->move('images/'.$des,$image_name);
            // $file->storeAs($des, $image_name);
            array_push($urls,$url.$image_name);



        }

        $i=1;
        $c=0;

        if($request->hasFile("image"))
        {
            $file=$request->file("image");
            foreach($file as $files)
            {
                $filename =  $i++ .'.'. 'jpg';

                $image_name = $i+1 .'.'. 'jpg';
                $request['user_id']=$real->id;
                $request['image']=$image_name;
                $real->image = $image_name;
                $c++;

                 $files->move('images/'.$des,$filename);
                // $files->storeAs($des,$filename);
                array_push($urls,$url.$filename);


            }
        }


        $real->image_path=$des;
        $real->countF=$c;
        $real->description=$request->description;
        $real['urls'] = json_encode($urls);
               
        $real->update();

        return $this->sendResponse($real, 'Realestate updated Successfully!' );
  

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




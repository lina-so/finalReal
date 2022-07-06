<?php

namespace App\Http\Controllers;

use App\Models\Realestate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Storage;
use File;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Reserve;



// namespace App\Http\Controllers\Carbon;
// use Illuminate\Support\Facades\Storage;

class RealestateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reals = Realestate::latest()->paginate(8);
        return view('show' , compact(['reals']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = DB::select('select * from cities');
        return view('admin.Add',compact('cities'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
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
        $real->cities_id= $request->country;



       //process upload images
         $time = Carbon::now();

        $format_time=$time->format('d-m-y').'_'.$time->format('H').'_'.$time->format('i').'_'.$time->format('m');
        $des=Auth::user()->name.'_'.Auth::id().'_'.$format_time;
        $url='/images/'.Auth::user()->name.'_'.Auth::id().'_'.$format_time.'/';

        $urls =array();

        
         //process cover image

        if($request->hasFile("cover"))
        {
            $file=$request->file("cover");
           
            $image_name='cover'.'.'.'jpg';

            $real->cover = $image_name;

            $file->move('images/'.$des,$image_name);
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
                array_push($urls,$url.$filename);
 
            }
        }

        // dd(json_encode($urls));
        $real->image_path=$des;
        $real->countF=$c;
        $real->description=$request->description;
        // $real->urls=$request->urls;
        $real['urls'] = json_encode($urls);

               
        $real->save();

        // $reserve= new Reserve;
        // if($reserve->is_reserve=1)
        // {
        //    $real->end_r_date=$reserve->created_at->addDays('4')->format('d-m-Y');
        // }
        // $real->end_r_date;

        return redirect()->route('show');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Realestate  $realestate
     * @return \Illuminate\Http\Response
     */
    public function show(Realestate $realestate)
    {

        return view('show',compact('realestate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Realestate  $realestate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $realestate=Realestate::find($id);
        $r_id=$id;
        // $id = Realestate::select('id')->first();
        $realestate=DB::select('select * from realestates where id = ?',[$r_id]);
        // $realestate = Realestate::where('id',$id)->get();
        //   echo '<pre>';
        // print_r($realestate);
        // die();
        // dd($realestate);
        return view('edit' , compact('realestate'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Realestate  $realestate
     * @return \Illuminate\Http\Response
     */



    public function update(Request $request,  $id)
    {
        $realestate=Realestate::find($id);
        // $realestate=Realestate::findOrFail($id);

        $request->validate([
            'address'  => 'required',
            'floor' => 'required',
            'area' => 'required',
            'price' => 'required',
            'number_of_rooms' => 'required',
            'number_of_path_rooms' => 'required',
            'type' => 'required',
            'property_type' => 'required',
        ]);

        $realestate->address  = $request->address;
        $realestate->floor  = $request->floor;
        $realestate->area  = $request->area;
        $realestate->price  = $request->price;
        $realestate->number_of_rooms  = $request->number_of_rooms;
        $realestate->number_of_path_rooms  = $request->number_of_path_rooms;
        $realestate->state  = $request->state;
        $realestate->type  = $request->type;
        $realestate->property_type  = $request->property_type;
        $realestate->furnished=$request->furnished;
        $realestate['services'] = json_encode($request->services);
        $realestate->user_id = Auth::id();
        $realestate->cities_id= $request->country;


          //process upload images
          $time = Carbon::now();

          $format_time=$time->format('d-m-y').'_'.$time->format('H').'_'.$time->format('i').'_'.$time->format('m');
          $des=Auth::user()->name.'_'.Auth::id().'_'.$format_time;
          $url='/images/'.Auth::user()->name.'_'.Auth::id().'_'.$format_time.'/';
  
          $urls =array();
  
          
           //process cover image
  
          if($request->hasFile("cover"))
          {
              $file=$request->file("cover");
             
              $image_name='cover'.'.'.'jpg';
  
              $realestate->cover = $image_name;
  
              $file->move('images/'.$des,$image_name);
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
                  $request['user_id']=$realestate->id;
                  $request['image']=$image_name;
                  $realestate->image = $image_name;
                  $c++;
  
                  $files->move('images/'.$des,$filename);
                  array_push($urls,$url.$filename);
   
              }
          }
  
          // dd(json_encode($urls));
          $realestate->image_path=$des;
          $realestate->countF=$c;
          $realestate->description=$request->description;
          // $realestate->urls=$request->urls;
          $realestate['urls'] = json_encode($urls);


        $realestate->update();

        // DB::table('realestate')->where('id',$id)->update($data);
        return redirect()->route('show')->with('success','property updated successfully');


    }

    public function success($id)
    {
       
        $success='success';

        $update=Realestate::where('id', '=', $id)
        ->update(['status' => $success]);

        return redirect()->back()->with('mess','state updated successfully');


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Realestate  $realestate
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $realestate=Realestate::find($id);
        $realestate->delete();
        return redirect()->route('show')->with('success','property deleted successfully');
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Realestate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    //    return parent::toArray($request);
      return [
        'address'=>$this->address,
        'floor'=>$this->floor,
        'area'=>$this->area,
        'price'=>$this->price,
        'number_of_rooms'=>$this->number_of_rooms,
        'number_of_path_rooms'=>$this->number_of_path_rooms,
        'cover'=>$this->cover,
        'image'=>$this->image,
        'image_path'=>$this->image_path,
        'cities_id'=> $this-> city_id,
        'user_id'	    => $this->user_id,
        'created_at'	=> $this->created_at->format('d/m/Y'),
        'updated_at'	=> $this->updated_at->format('d/m/Y'),

      ];
    }
}

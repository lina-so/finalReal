@extends('layouts.app')

@section('content')
<h1>@lang('lang.your Real')</h1>



@foreach($realestates as $realestate)

            <div class="container1 item">
                <div class="listing-item">
                    <div class="left-image">
                    <img src="{{asset('images/'.$realestate->image_path.'/cover.jpg')}}" alt="">

                    </div>
                    <div class="right-content align-self-center">
                    <a href="#"><h4>{{ __('lang.' .  $realestate->property_type) }}</h4></a>
                    <h6>by: {{$realestate->user_id}}</h6>
                    <ul class="rate">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li>(24) Reviews</li>
                    </ul>
                    <span class="price"><div class="icon icon_1"><img src="photo/listing-icon-01.png" alt=""></div> @lang('lang.price') : ${{$realestate->price}} </span>

                    <span class="details">@lang('lang.details') <em>{{$realestate->area}} sq ft</em></span>
                    <ul class="info">
                        <li><img src="photo/listing-icon-02.png" alt=""> {{$realestate->number_of_rooms}} @lang('lang.Rooms')</li>
                        <li><img src="photo/listing-icon-03.png" alt=""> {{$realestate->number_of_path_rooms}} @lang('lang.pathrooms')</li>
                    </ul>
                    <div class="main-white-button">
                        <div class="content">
                            <a href="{{route('details',$realestate->id)}}" class="reserve"><i class="fa fa-eye"></i>@lang('lang.view') @lang('lang.details')</a>
                        </div>
                        <div class="content">
                            <a href="{{route('update-realestate',$realestate->id)}}"><i class=""></i>@lang('lang.Edit')</a>
                        </div>
                        <div class="content">
                            <form action="{{route('delete',$realestate->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            <a ><button type="submit" class="servicedeletebtn" onclick="return confirm('Are you sure you want to Delete this Realestate ?')" id="Demo">@lang('lang.delete')</button></a>
                            </form>
                        </div>

                    </div>
                    </div>
                </div>
              
            </div>
          
    @endforeach
    
@endsection

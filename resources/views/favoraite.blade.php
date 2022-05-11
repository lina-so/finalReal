
@extends('layouts.app')


@section('content')

<h1>
@lang('lang.favorite')
  </h1>

  <div>
    @if ($favoraite->count()>0)
      @foreach($favoraite as $fav)
        @if (empty($fav->deleted_at))
            <div class="container1 item">
                        <div class="listing-item">
                            <div class="left-image">
                            <a href="#"><img src="" alt=""></a>
                            </div>
                            <div class="right-content align-self-center">
                            <a href="#"><h4>{{ __('lang.' . $fav->property_type) }}</h4></a>
                            <h6>by: {{$fav->user_id}}</h6>
                            <ul class="rate">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li>(24) Reviews</li>
                            </ul>
                            <span class="price"><div class="icon"><img src="images/listing-icon-01.png" alt=""></div> @lang('lang.price') : ${{$fav->price}}</span>
                            <span class="details">@lang('lang.details') : <em>{{$fav->area}} sq ft</em></span>
                            <ul class="info">
                                <li><img src="images/listing-icon-02.png" alt=""> {{$fav->number_of_rooms}} @lang('lang.Rooms')</li>
                                <li><img src="images/listing-icon-03.png" alt=""> {{$fav->number_of_path_rooms}} @lang('lang.pathrooms')</li>
                            </ul>
                            <div class="main-white-button">
                                <div class="content">
                                    <a href="#"><i class="fa fa-eye"></i>@lang('lang.view') @lang('lang.details')</a>
                                </div>
                                <div class="content">
                                    <form action="{{route('delete-favoraite',$fav->real_id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <a ><button type="submit" class="servicedeletebtn" onclick="return confirm('Are you sure you want to Delete this Realestate ?')" id="Demo">@lang('lang.delete')</button></a>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif
        @endforeach
        
        @else
           <h4>@lang('lang.There is no realestate in your favoraite.')</h4>
    @endif

   
  
 </div>
@endsection



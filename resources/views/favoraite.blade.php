
@extends('layouts.app')


@section('content')

<div class="main-text fav">
    <h1>@lang('lang.favorite')</h1>
</div>

  <div>
    @if ($favoraite->count()>0)
      @foreach($favoraite as $fav)
        @if (empty($fav->deleted_at))
            <div class="container1 item">
                        <div class="listing-item">
                            <div class="left-image">
                            <a href="#"><img src="{{asset('images/'.$fav->image_path.'/cover.jpg')}}" alt=""></a>
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
                                <li class="state">{{$fav->state}}</li>

                            </ul>
                            <span class="price"><div class="icon"><img src="photo/listing-icon-01.png" alt=""></div> @lang('lang.price') : ${{$fav->price}}</span>
                            <span class="details">@lang('lang.details') : <em>{{$fav->area}} sq ft</em></span>
                            <ul class="info">
                                <li><img src="photo/listing-icon-02.png" alt=""> {{$fav->number_of_rooms}} @lang('lang.Rooms')</li>
                                <li><img src="photo/listing-icon-03.png" alt=""> {{$fav->number_of_path_rooms}} @lang('lang.pathrooms')</li>
                            </ul>
                            <div class="main-white-button">
                                <div class="content">
                                    <a href="{{route('details',$fav->id)}}" class="reserve"><i class="fa fa-eye"></i>@lang('lang.view') @lang('lang.details')</a>
                                </div>
                                <div class="content">
                                    <form action="{{route('delete-favoraite',$fav->real_id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                               <!-- <button class="btn btn-danger"><i class="las la-trash"></i></button> -->

                                    <a ><button type="submit" class="servicedeletebtn delete" onclick="return confirm('Are you sure you want to Delete this Realestate ?')" id="Demo" ><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" color="#10375C" style="margin-left: -10px;">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg></button></a>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif
        @endforeach

    @endif

   
  
 </div>
@endsection



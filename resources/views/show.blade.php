
@extends('layouts.app')

<!-- @if (session()->has('mess'))
<h3>{{session()->get('mess')}}</h3>    
@endif -->

@can('isAdmin')
        <style>
            .deleteIcon{
                display: block;
            }
        </style>
    @else
    <style>
            .deleteIcon{
                display: none;
            }
        </style>
 @endcan



        
@section('content')

@include('sweetalert::alert')

    @foreach($reals as $real)



            <div class="container1 item">
                <div class="listing-item">
                @if ($real->status=="success")
                   <div class="done">
                       <img class="done2" src="{{ asset('photo/done2.png') }}" alt="" style="">
                    </div>
                @else
                    
                @endif
                   
                    <div class="left-image">
                    <img src="{{asset('images/'.$real->image_path.'/cover.jpg')}}" alt="">
                    </div>
                    <div class="right-content align-self-center">
                    <a href="#"><h4>{{ __('lang.' . $real->property_type) }}</h4></a>
                    <h6>by: {{$real->user_id}}</h6>
                    <ul class="rate">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li class="state">{{$real->state}}</li>

                      <!--   <li> <a href="{{url('liked/'.$real->id.'/')}}" class="addToFavoraite"><i data-product-id="{{$real->id}}"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16" color="yellow">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>      
                            </svg>
                        </a></li> -->
                    </ul>
                    <span class="price"><div class="icon icon_1"><img src="photo/listing-icon-01.png" alt=""></div> @lang('lang.price') : ${{$real->price}} </span>
                    <span class="details">@lang('lang.Area') :  <em>{{$real->area}}</em> m2</span>
                    <ul class="info">
                        <li><img src="photo/listing-icon-02.png" alt=""> {{$real->number_of_rooms}} @lang('lang.bedroom')</li>
                        <li><img src="photo/listing-icon-03.png" alt=""> {{$real->number_of_path_rooms}} @lang('lang.pathrooms')</li>
                    </ul>

                    <div class="main-white-button">


                    <form action="{{url('reserve/'.$real->id.'/')}}">
                        <button  class="reserve" <?php
                        if($real->status == "pending")
                        {
                        echo("disabled");

                        }
                        else{
                        echo("");
                        }
                        ?>>@lang('lang.Reserve')</button>
                    </form>

                    <a href="{{route('details',$real->id)}}" class="details" id="details" ><i class="fa fa-eye" style="margin-right:10px"></i>@lang('lang.view') @lang('lang.details')</a>
                    <a  href="{{route('update-realestate',$real->id)}}"  class="deleteIcon icon2" style="margin-left:10px"><i class=""></i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16" color="#502a4a">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <form action="{{route('delete',$real->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        <a class="deleteIcon icon2"><button type="submit" class="servicedeletebtn" onclick="return confirm('Are you sure you want to Delete this Realestate ?')" id="Demo" style="border:none; background:none;"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" color="#10375C" style="margin-left: 10px;">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg></button>
                        </a>
                    </form>

                    <a href="{{url('liked/'.$real->id.'/')}}" class="addToFavoraite" style="margin-left:10px"><i data-product-id="{{$real->id}}"></i><svg xmlns="http://www.w3.org/2000/svg" width="19" height="22" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16" color="#ee4c31">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>      
                            </svg>
                        </a>
                    </div>

                    <div class="">
                        <!-- <img src="{{asset('/storage/app/images/loloo_4_07-04-22_15_50_04/cover.jpg')}}" alt=""> -->
                   
                        <!-- <a href="{{url('reserve/'.$real->id.'/')}}" class="reserve"><i class="fa fa-heart" data-product-id="{{$real->id}}"></i>@lang('lang.Reserve')</a> -->
                    </div>

                    </div>
                </div>
            </div>


    
    @endforeach
    
    


@endsection



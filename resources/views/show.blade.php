
@extends('layouts.app')

@if (session()->has('mess'))
<h3>{{session()->get('mess')}}</h3>    
@endif

@section('content')



    @foreach($reals as $real)
            <div class="container1 item">
                <div class="listing-item">
                    <div class="left-image">
                    <img src="{{asset('storage/٢٠٢١٠٤٠١_١٦٥٤٣١.jpg')}}" alt="">
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
                        <li>(24) Reviews</li>
                    </ul>
                    <span class="price"><div class="icon"><img src="images/listing-icon-01.png" alt=""></div> @lang('lang.price') : ${{$real->price}} </span>
                    <span class="details">@lang('lang.Area') :  <em>{{$real->area}}</em> m2</span>
                    <ul class="info">
                        <li><img src="images/listing-icon-02.png" alt=""> {{$real->number_of_rooms}} @lang('lang.bedroom')</li>
                        <li><img src="images/listing-icon-03.png" alt=""> {{$real->number_of_path_rooms}} @lang('lang.pathrooms')</li>
                    </ul>
                    <div class="main-white-button">
                    <a href="{{route('details',$real->id)}}"><i class="fa fa-eye"></i>@lang('lang.view') @lang('lang.details')</a>
                    </div>

                    <div class="">
                        <!-- <img src="{{asset('/storage/app/images/loloo_4_07-04-22_15_50_04/cover.jpg')}}" alt=""> -->
                        <a href="{{url('liked/'.$real->id.'/')}}" class="addToFavoraite"><i class="fa fa-heart" data-product-id="{{$real->id}}"></i>@lang('lang.add to favoraite')</a>
                        <a href="{{url('reserve/'.$real->id.'/')}}" class="reserve"><i class="fa fa-heart" data-product-id="{{$real->id}}"></i>@lang('lang.Reserve')</a>
                    </div>

                    </div>
                </div>
            </div>
    @endforeach

@endsection



@section('scripts')
    <script>
        $(document).on('click','.addToFavoraite',function(e){
            e.preventDefault();

            @guest()
                $('.not-looggedin-model').css('diplay','blok');
            @endguest
            $.ajax({
                type:'post',
                url:"{{url('liked/'.$real->id.'/')}}",
                data:{
                    'realId':$(this).attr('data-product-id'),
                },
                success:function($data)
                {

                }
            });
        });
    </script>
@endsection
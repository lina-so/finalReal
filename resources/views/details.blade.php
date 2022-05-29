@extends('layouts.app')

@php
    $i=0;
    
@endphp
@section('content')

            <div class="container2">
                <div class="content">
                    <div class="content-header">
                        <div class="content-header-left">
                            <h2>{{ __('lang.' .  $details[0]->property_type) }}</h2>
                            <i></i><p> {{$details[0]->address}}</p>
                            <ul>
                                <li> {{$details[0]->number_of_rooms}} @lang('lang.Rooms')</li>
                                <li> {{$details[0]->number_of_path_rooms}} @lang('lang.pathrooms')</li>
                                <li>{{$details[0]->area}}m2 @lang('lang.Area')</li>
                            </ul>
                        </div>
                        <div class="content-header-right">
                            <span>{{$details[0]->price}}$</span>
                            <span>{{ __('lang.' .  $details[0]->state) }}</span>
                        </div>
                    </div>
                </div>

                <div class="content-body">
                    <div class="images">
                    @for ($i = 0; $i <=$details[0]->countF; $i++)
                    <img src="{{asset('images/'.$details[0]->image_path.'/'.$i.'.jpg')}}" alt="">

                        <p>The current value is {{ $i }}.</p>
                    @endfor
                      
                        <a href="{{url('liked/'.$details[0]->id.'/')}}" class="addToFavoraite"><i class="fa fa-heart" data-product-id="{{$details[0]->id}}"></i>@lang('lang.add to favoraite')</a>
                       
                    </div>
                    <div class="agent-info">
                        <h3>@lang('lang.Contact Listing Agent')</h3>
                        <i></i><p>{{Auth::user()->email}}</p>
                         <a href=""><button>@lang('lang.Send E-mail')</button></a>
                    </div>
                </div>

                <div class="details">
                    <h3>@lang('lang.details')</h3>
                    <table>
                        <tbody>
                            <tr>
                            <td>@lang('lang.purpose')</td>
                            <td>{{ __('lang.' .  $details[0]->state) }}</td>
                            </tr>
                            <tr>
                            <td>@lang('lang.city')</td>
                            <td>{{ __('lang.'. $details[0]->country)}}</td>
                            </tr>
                            <tr>
                            <td>@lang('lang.floor')</td>
                            <td>{{$details[0]->floor}}</td>
                            </tr>
                            <tr>
                            <td>@lang('lang.Area')</td>
                            <td>{{$details[0]->area}}m2</td>
                            </tr>
                            <tr>
                            <td> @lang('lang.Ownership')</td>
                            <td>Agent</td>
                            </tr>
                            <tr>
                            <td> @lang('lang.Type')</td>
                            <td>{{ __('lang.' .  $details[0]->property_type) }}</td>
                            </tr>
                            <tr>
                            <td> @lang('lang.number_of_rooms')</td>
                            <td> {{$details[0]->number_of_rooms}}</td>
                            </tr>
                            <tr>
                            <td> @lang('lang.number_of_path_rooms') </td>
                            <td> {{$details[0]->number_of_path_rooms}}</td>
                            </tr>
                            <tr>
                            <td> @lang('lang.Property Type')</td>
                            <td>{{ __('lang.' .  $details[0]->type) }}</td>
                            </tr>
                            <tr>
                            <td> @lang('lang.price')</td>
                            <td>{{$details[0]->price}}$</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>

 @include('not-logged')
       

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
                url:"{{url('liked/'.$details[0]->id.'/')}}",
                data:{
                    'realId':$(this).attr('data-product-id'),
                },
                success:function(response)
                {
                    swal(response.status);
                }
            });
        });
    </script>

<script>
        $(document).on('click','.reserve',function(e){
            e.preventDefault();

            @guest()
                $('.not-looggedin-model').css('diplay','blok');
            @endguest
            $.ajax({
                type:'post',
                url:"{{url('reserve/'.$details[0]->id.'/')}}",
                data:{
                    'realId':$(this).attr('data-product-id'),
                },
                success:function(response)
                {
                    swal(response.status);
                }
            });
        });
    </script>
@endsection

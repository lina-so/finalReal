
@extends('layouts.app')

 
@if (Session::get('locale')== "ar")
        <style>
          .container_2{
            direction:rtl;
          }
		  .box .sq:nth-child(5){
			margin-left: -1280px;
		  }
        
		  .box .sq:nth-child(1){
			margin-right: 1318px;
		  }
		  .box .sq:nth-child(2){
			margin-left: -495px;
		  }

		
        </style>  
    @else
        <style>
             .container_2{
            direction:ltr;
            text-align:left;
          }

        </style>
    @endif


@section('content')

<div class="container">

    <div class="section_1">
		<div class="color"></div>
		<div class="color"></div>
		<div class="color"></div>
		<div class="box">
			<div class="square sq" style="--i: 0;"></div>
			<div class="square sq" style="--i: 1;"></div>
			<div class="square sq" style="--i: 2;"></div>
			<div class="square sq" style="--i: 3;"></div>
			<div class="square sq" style="--i: 4;"></div>

			<div class="container_2">
				<div class="form">
					<h2 class="desire">@lang('lang.search')</h2>
					<form  action="/search" method="GET" enctype="multipart/form-data">
						<div class="inputBox">
							<select  name="country">
						    	<option value="">@lang('lang.Select city')</option>
								<option value="2">@lang('lang.Harasta')</option>
								<option value="1">@lang('lang.Doma')</option>
								<!-- <option value="Sednaya">Sednaya</option> -->
							</select>
                        </div>

						<div class="inputBox">
							<input type="text" placeholder=@lang('lang.address') name="address">
						</div>
						<div class="inputBox">
							<input type="Number"placeholder=@lang('lang.floor') name="floor">
						</div>
						<div class="inputBox">
							<input type="number" placeholder=@lang('lang.Area') name="area">
						</div>
						<div class="inputBox">
							<input type="number" step=0.01  placeholder=@lang('lang.min_price') name="min_price">
						</div>
						<div class="inputBox">
							<input type="number" step=0.01  placeholder=@lang('lang.max_price') name="max_price">
						</div>
						<div class="inputBox">
							<input type="number" placeholder=@lang('lang.number_of_rooms') name="number_of_rooms">
						</div>
						<div class="inputBox">
							<input type="number"  placeholder=@lang('lang.number_of_path_rooms') name="number_of_path_rooms">
						</div>

						<div class="inputBox">
                            <select  name="state">
						     	<option value="" selected disabled>@lang('lang.state')</option>
                                <option value="Sale">@lang('lang.sale')</option>
                                <option value="Rent">@lang('lang.rent')</option>
                            </select>
                        </div>
                        <div class="inputBox">
                            <select name="type">
						     	<option value="" selected disabled>@lang('lang.Type')</option>
                                <option value="court">@lang('lang.court')</option>
                                <option value="tabo">@lang('lang.tabo')</option>
                            </select>
                        </div>
                        <div class="inputBox">
                            <select name="property_type">
						     	<option value="" selected disabled>@lang('lang.Property Type')</option>
                                <option value="Villa">@lang('lang.villa')</option>
                                <option value="Flat">@lang('lang.flat')</option>
                                <option value="Shop">@lang('lang.shop')</option>
                                <option value="Land">@lang('lang.land')</option>
                            </select>
                        </div>
						<div class="inputBox">
                            <select name="furnished">
						     	<option value="" selected disabled>@lang('lang.furnished or not')</option>
                                <option value="furnished">@lang('lang.furnished')</option>
                                <option value="not_furnished">@lang('lang.not_furnished')</option>
                            </select>
                        </div>
                       
						<div class="save save_1">
                            <button type="submit">@lang('lang.search')</button>
                        </div>
						
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection

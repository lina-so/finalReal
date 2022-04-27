
@extends('layouts.app')


@section('content')

<div class="container2">
        <div class="header-content">
            <!-- <p>Active Listings +1,500 Over</p> -->
            <h1>@lang('lang.Finds Nearby Places & Things')</h1>
            <button><a href="">@lang('lang.Search Now')</a></button>
        </div>
    </div>

    <div class="section1">
		<div class="color"></div>
		<div class="color"></div>
		<div class="color"></div>
		<div class="box1">
			<!-- <div class="square" style="--i: 0;"></div>
			<div class="square" style="--i: 1;"></div>
			<div class="square" style="--i: 2;"></div>
			<div class="square" style="--i: 3;"></div>
			<div class="square" style="--i: 4;"></div> -->

			<div class="container2">
				<div class="form1">
					<h2>@lang('lang.add realestate')</h2>
					<form  action="/Add" method="POST" enctype="multipart/form-data">
                    @csrf
				    	<div class="Box">
							<select  name="country">
								<option value="">@lang('lang.Select city')</option>
								
								@foreach ($cities as $city)
									<option value="{{ $city->id }}">{{ __('lang.' .  $city->country) }}</option>
								@endforeach
		
							</select>
                        </div>
						<div class="Box">
							<input type="text" placeholder=@lang('lang.address') name="address">
						</div>
						<div class="Box">
							<input type="Number"placeholder=@lang('lang.floor') name="floor">
						</div>
						<div class="Box">
							<input type="number" placeholder=@lang('lang.Area') name="area">
						</div>
						<div class="Box">
							<input type="number" step=0.01  placeholder=@lang('lang.price') name="price">
						</div>
						<div class="Box">
							<input type="number" placeholder=@lang('lang.number_of_rooms') name="number_of_rooms">
						</div>
						<div class="Box">
							<input type="number"  placeholder=@lang('lang.number_of_path_rooms') name="number_of_path_rooms">
						</div>

						<div class="Box">
                            <select  name="state">
                                <option value="Sale">@lang('lang.sale')</option>
                                <option value="Rent">@lang('lang.rent')</option>
                            </select>
                        </div>
                        <div class="Box">
                            <select name="type">
                                <option value="court">@lang('lang.court')</option>
                                <option value="tabo">@lang('lang.tabo')</option>
                            </select>
                        </div>
                        <div class="Box">
                            <select name="property_type">
                                <option value="Villa">@lang('lang.villa')</option>
                                <option value="Flat">@lang('lang.flat')</option>
                                <option value="Shop">@lang('lang.shop')</option>
                                <option value="Land">@lang('lang.land')</option>
                            </select>
                        </div>
                       
						<div class="Box">
							<label for="">Cover</label>
                            <input type="file" id="image" name="cover"  >  
                        </div>
                        <div class="Box">
							<label for="">Images</label>
                            <input type="file" id="image" name="image[]" multiple >  
                        </div>
						<div class="save">
                            <button type="submit">@lang('lang.save')</button>
                        </div>
						
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection

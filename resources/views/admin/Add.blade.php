
@extends('layouts.app')


@section('content')

<div class="container">
      

    <div class="section_1">
		<div class="color"></div>
		<div class="color"></div>
		<div class="color"></div>
		<div class="box">
			<div class="square" style="--i: 0;"></div>
			<div class="square" style="--i: 1;"></div>
			<div class="square" style="--i: 2;"></div>
			<div class="square" style="--i: 3;"></div>
			<div class="square" style="--i: 4;"></div>

			<div class="container_1">
				<div class="form">
					<h2 class="h2">@lang('lang.add realestate')</h2>
					<form  action="/Add" method="POST" enctype="multipart/form-data">
                    @csrf
				    	<div class="inputBox">
							<select  name="country">
								<option value="">@lang('lang.Select city')</option>
								
								@foreach ($cities as $city)
									<option value="{{ $city->id }}">{{ __('lang.' .  $city->country) }}</option>
								@endforeach
		
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
							<input type="number" step=0.01  placeholder=@lang('lang.price') name="price">
						</div>
						<div class="inputBox">
							<input type="number" placeholder=@lang('lang.number_of_rooms') name="number_of_rooms">
						</div>
						<div class="inputBox">
							<input type="number"  placeholder=@lang('lang.number_of_path_rooms') name="number_of_path_rooms">
						</div>

						<div class="inputBox">
                            <select  name="state">
                                <option value="Sale">@lang('lang.sale')</option>
                                <option value="Rent">@lang('lang.rent')</option>
                            </select>
                        </div>
                        <div class="inputBox">
                            <select name="type">
                                <option value="court">@lang('lang.court')</option>
                                <option value="tabo">@lang('lang.tabo')</option>
                            </select>
                        </div>
                        <div class="inputBox">
                            <select name="property_type">
                                <option value="Villa">@lang('lang.villa')</option>
                                <option value="Flat">@lang('lang.flat')</option>
                                <option value="Shop">@lang('lang.shop')</option>
                                <option value="Land">@lang('lang.land')</option>
                            </select>
                        </div>
                       
						<div class="inputBox img">
							<label for="">Cover</label>
                            <input type="file" id="image" name="cover"  >  
                        </div>
                        <div class="inputBox img">
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

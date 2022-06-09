
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
					<h2>@lang('lang.add desire')</h2>
					<form  action="/desire" method="POST" enctype="multipart/form-data">
                    @csrf
				    
						<div class="Box">
							<select  name="country">
						    	<option value="">@lang('lang.Select city')</option>
								<option value="2">@lang('lang.Harasta')</option>
								<option value="1">@lang('lang.Doma')</option>
								<!-- <option value="Sednaya">Sednaya</option> -->
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
							<input type="number" step=0.01  placeholder=@lang('lang.min_price') name="min_price">
						</div>
						<div class="Box">
							<input type="number" step=0.01  placeholder=@lang('lang.max_price') name="max_price">
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

						<div class="inputBox">
                            <select name="furnished">
						     	<!-- <option value="" selected disabled>@lang('lang.furnished')</option> -->
                                <option value="furnished">@lang('lang.furnished')</option>
                                <option value="not_furnished">@lang('lang.not furnished')</option>
                            </select>
                        </div>

						<div class="inputBox multiselect">
						<select data-placeholder="@lang('lang.select services')" multiple class="chosen-select" name="services[]">
							<option value=""></option>
							<option value="security">@lang('lang.security')</option>
							<option value="internet">@lang('lang.internet')</option>
							<option value="car_Parking">@lang('lang.car_Parking')</option> 
							<option value="supermarket">@lang('lang.supermarket')</option>
							<option value="mosque">@lang('lang.mosque')</option>
							<option value="green park">@lang('lang.green park')</option>
							<option value="restaurant">@lang('lang.restaurant')</option>
							<option value="gym">@lang('lang.gym')</option>
							<option value="school">@lang('lang.school')</option>
						</select>
						</div>
                       
                     
						<div class="save">
                            <button type="submit">@lang('lang.save')</button>
                        </div>
						
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                placeholder: "Select",
                allowClear: true
            });

        });

		$(".chosen-select").chosen({
		no_results_text: "Oops, nothing found!"
		})
    </script>

@endsection

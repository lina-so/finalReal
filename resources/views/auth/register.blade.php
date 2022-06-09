<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/rej.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<section>
		<div class="color"></div>
		<div class="color"></div>
		<div class="color"></div>
		<div class="box">
			<div class="square" style="--i: 0;"></div>
			<div class="square" style="--i: 1;"></div>
			<div class="square" style="--i: 2;"></div>
			<div class="square" style="--i: 3;"></div>
			<div class="square" style="--i: 4;"></div>
			<div class="container">
				<div class="form">
                   <h2> <div class="card-header">{{ __('Register') }}</div></h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        
                        <div class="inputBox">
                            <label for="name">{{ __('Name') }}</label>

                            <div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="inputBox">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="inputBox">
                            <label for="password">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="inputBox">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="inputBox">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">@lang('lang.phone')</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" required >
                            </div>
                        </div>

                        <div class="inputBox">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">@lang('lang.gender')</label>

                            <select name="gender">
                                <!-- <option value="" selected disabled>@lang('lang.gender')</option> -->
                                <option value="female">@lang('lang.female')</option>
                                <option value="male">@lang('lang.male')</option>
                            </select>
                        </div>

                        <div class="inputBox">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
						<!-- <p class="forget">
							Already have an account ? <a href="#">Sign in</a>
						</p> -->
						
					</form>
				</div>
			</div>
		</div>
	</section>

</body>
</html>


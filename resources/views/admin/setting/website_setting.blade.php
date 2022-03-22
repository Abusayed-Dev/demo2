@extends('layouts.admin')


@section('title', 'Website Setting')


@section('admin_content')

<div class="app-main" id="main" style="margin-top: 100px;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="card p-3">
					<div class="card-title text-center">Website Setting</div>
					<div class="card-body">
					    <form action="{{ route('update.website', $setting->id) }}" method="POST" enctype="multipart/form-data">
					    	@csrf
					        <div class="row">
					        	<div class="form-group col-lg-6">
						            <label for="currency">Currency</label>
						            <select name="currency" id="currency" class="form-control">
						            	<option @if($setting->currency == '$') selected="" @endif value="$">$</option>
						            	<option @if($setting->currency == '€') selected="" @endif value="€">€</option>
						            	<option @if($setting->currency == '₹') selected="" @endif value="₹">₹</option>
						            	<option @if($setting->currency == '৳') selected="" @endif value="৳">৳</option>
						            </select>
						        </div>

						        <div class="form-group col-lg-6">
						            <label for="address">Address</label>
						            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required="" value="{{ $setting->address }}">

						            @error('address')
								    	<strong class="text-danger">{{ $message }}</strong>
									@enderror
						        </div>
					        </div>

					        <div class="row">
					        	<div class="form-group col-lg-6">
						            <label for="phone_one">Phone One</label>
						            <input type="text" class="form-control @error('phone_one') is-invalid @enderror" id="phone_one" name="phone_one" required="" value="{{ $setting->phone_one }}">

						            @error('phone_one')
								    	<strong class="text-danger">{{ $message }}</strong>
									@enderror
						        </div>

					        	<div class="form-group col-lg-6">
						            <label for="phone_two">Phone Two</label>
						            <input type="text" class="form-control @error('phone_two') is-invalid @enderror" id="phone_two" name="phone_two" required="" value="{{ $setting->phone_two }}">

						            @error('phone_two')
								    	<strong class="text-danger">{{ $message }}</strong>
									@enderror
						        </div>
					        </div>

					        <div class="row">
					        	<div class="form-group col-lg-6">
						            <label for="main_email">Main Email</label>
						            <input type="email" class="form-control @error('main_email') is-invalid @enderror" id="main_email" name="main_email" required="" value="{{ $setting->main_email }}">

						            @error('main_email')
								    	<strong class="text-danger">{{ $message }}</strong>
									@enderror
						        </div>

					        	<div class="form-group col-lg-6">
						            <label for="support_email">Support Email</label>
						            <input type="email" class="form-control @error('support_email') is-invalid @enderror" id="support_email" name="support_email" required="" value="{{ $setting->support_email }}">

						            @error('support_email')
								    	<strong class="text-danger">{{ $message }}</strong>
									@enderror
						        </div>
					        </div>

					        <div class="row">
					        	<div class="form-group col-lg-6">
					        		@isset($setting->logo)<img src="{{ asset($setting->logo) }}" alt=""><br>@endisset
						            <label for="logo">Logo</label>
						            <input type="hidden" name="old_logo" value="{{ $setting->logo }}">
						            <input type="file" class="form-control dropify" id="logo" name="logo" data-height="100" >
						        </div>

					        	<div class="form-group col-lg-6">
					        		@isset($setting->favicon)<img src="{{ asset($setting->favicon) }}" alt=""><br>@endisset
						            <label for="favicon">Favicon</label>
						            <input type="hidden" name="old_favicon" value="{{ $setting->favicon }}">
						            <input type="file" class="form-control dropify" id="favicon" name="favicon"
						             data-height="100" >
						        </div>
					        </div>

					        <div class="row">
					        	<div class="form-group col-lg-4">
						            <label for="facebook">Facebook</label>
						            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $setting->facebook }}">
						        </div>
					        	<div class="form-group col-lg-4">
						            <label for="twitter">Twitter</label>
						            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $setting->twitter }}">
						        </div>
					        	<div class="form-group col-lg-4">
						            <label for="instagram">Instagram</label>
						            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $setting->instagram }}">
						        </div>
					        </div>

					        <div class="row">
					        	<div class="form-group col-lg-6">
						            <label for="youtube">Youtube</label>
						            <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $setting->youtube }}">
						        </div>
					        	<div class="form-group col-lg-6">
						            <label for="pinterest">Pinterset</label>
						            <input type="text" class="form-control" id="pinterest" name="pinterest" value="{{ $setting->pinterest }}">
						        </div>
					        </div>
					        
						    <div class="form-group">
						        <button type="submit" class="btn btn-primary">update</button>
						    </div>
					  	</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
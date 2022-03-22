@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

@include('frontend.user.middle_header')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            @include('frontend.user.sidebar')
        </div>

        <div class="col-lg-8">
            <div class="card bg-light mb-2">
              <div class="list-group-item list-group-item-dark">
                <span>Dashboard </span>
                <a href="{{ route('write.review') }}" class="float-right text-danger">Write review</a>
              </div>
              <div class="card-body mt-2">
                  <h6>Your default shipping credential.</h6>

                  <form action="{{ route('web.review.store') }}" method="post">
                    @csrf
                      <div class="form-group">
                      	<label for="name">Shipping Name</label>
                          <input id="name" type="text" name="shipping_name" class="form-control" value="{{ Auth::user()->name }}" >
                      </div>

                      <div class="form-group">
                      	<label for="address">Shipping Address</label>
                          <input id="address" type="text" name="shipping_address" class="form-control" placeholder="Your shipping address..">
                      </div>

                      <div class="row">
                      	<div class="form-group col-md-6">
	                      	<label for="phone">Shipping Phone</label>
	                          <input id="phone" type="text" name="shipping_phone" class="form-control" placeholder="Your shipping number.." >
	                    </div>

                      	<div class="form-group col-md-6">
	                      	<label for="email">Shipping Email</label>
	                          <input id="email" type="email" name="shipping_email" class="form-control" placeholder="Your shipping email..">
	                    </div>
                      </div>

                      <div class="row">
                      	<div class="form-group col-md-4">
	                      	<label for="country">Shipping Country</label>
	                          <input id="country" type="text" name="shipping_country" class="form-control" placeholder="Your shipping country.." >
	                    </div>

                      	<div class="form-group col-md-4">
	                      	<label for="city">Shipping City</label>
	                          <input id="city" type="text" name="shipping_city" class="form-control" placeholder="Your shipping city..">
	                    </div>

                      	<div class="form-group col-md-4">
	                      	<label for="zip">Shipping Zip-Code</label>
	                          <input id="zip" type="text" name="shipping_zipcode" class="form-control" placeholder="Your shipping Zip-Code..">
	                    </div>
                      </div>

                      
                      <button type="submit" class="btn btn-info">Submit</button>
                  </form>  
              </div>
                
            
              <div class="card-body mt-2">
                  <h6>Change Password</h6>

                  <form action="{{ route('customer.password.change') }}" method="post">
                    @csrf
                      <div class="form-group">
                      	<label for="old_pass">Old Password</label>
                          <input id="old_pass" type="text" name="old_password" class="form-control" required="" placeholder="Your old password type here">
                      </div>

                      <div class="form-group">
                      	<label for="new_pass">New Password</label>
                          <input id="new_pass" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Type new password.." required="">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="form-group">
                      	<label for="con_pass">Confirm Password</label>
                          <input id="con_pass" type="password" name="password_confirmation" class="form-control" placeholder="Re-type password.." required="">
                      </div>
                      <button type="submit" class="btn btn-info">Update</button>
                  </form>  
              </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

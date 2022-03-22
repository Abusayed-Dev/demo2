@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>


<style>.btn{min-width: auto;}</style>
@include('frontend.user.middle_header')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            @include('frontend.user.sidebar')
        </div>

        <div class="col-lg-8">
            <div class="card bg-light mb-2">
              <div class="list-group-item list-group-item-dark">
                <span>Send Ticket </span>
              </div>
            </div>

            <div class="card bg-light mt-3 p-3">
                 <div class="card">
		            <div class="card-body">
	                 	<div class="list-group-item list-group-item-primary">
			                <strong>Send Ticket </strong>
			            </div>
		            	<form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data" class="pt-3">
		            		@csrf
		            		
		            		<div class="form-group">
			            		<label>Subject <strong class="text-danger">*</strong></label>
		            			<input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" placeholder="Type Subject">

		            			@error('subject')
								    <strong class="text-danger">{{ $message }}</strong>
								@enderror
		            		</div>

		            		<div class="row">
			            		<div class="form-group col-md-6">
			            			<label>Priority <strong class="text-danger">*</strong></label>
			            			<select name="priority" class="custom-select form-control @error('priority') is-invalid @enderror">
			            				<option value="Low">Low</option>
			            				<option value="Middium">Middium</option>
			            				<option value="High">High</option>
			            			</select>

			            			@error('priority')
									    <strong class="text-danger">{{ $message }}</strong>
									@enderror
			            		</div>
			            		<div class="form-group col-md-6">
			            			<label>Service <strong class="text-danger">*</strong></label>
			            			<select name="service" class="custom-select form-control @error('service') is-invalid @enderror">
			            				<option value="Technical">Technical</option>
			            				<option value="Payment">Payment</option>
			            				<option value="Affiliate">Affiliate</option>
			            				<option value="Return">Return</option>
			            				<option value="Refund">Refund</option>
			            			</select>

			            			@error('service')
									    <strong class="text-danger">{{ $message }}</strong>
									@enderror
			            		</div>
			            	</div>

			            	<div class="form-group">
			            		<label>Messege <strong class="text-danger">*</strong></label>
		            			<textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Your experienced type here..."></textarea>

		            			@error('message')
								    <strong class="text-danger">{{ $message }}</strong>
								@enderror
		            		</div>

			            	<div class="form-group">
			            		<label>Image </label>
		            			<input class="form-control" type="file" name="image">
		            		</div>

		            		<button type="submit" class="btn btn-danger">Submit Ticket</button>

		            	</form>
		            </div>
                 </div>
            </div>
        </div>
    </div>
</div>



@endsection

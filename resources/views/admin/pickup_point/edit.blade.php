<form action="{{ route('update.pickup_point', $pickuppoint->id) }}" method="POST">
	@csrf
    <div class="form-group">
        <label for="pickup_point_name">Pickup Point Name</label>
        <input type="text" class="form-control  @error('pickup_point_name') is-invalid @enderror" id="pickup_point_name" name="pickup_point_name" value="{{ $pickuppoint->pickup_point_name }}">

        @error('pickup_point_name')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
    </div>

    
    <div class="form-group">
        <label for="pickup_point_address">Pickup Point Address</label>
        <input type="text" class="form-control  @error('pickup_point_address') is-invalid @enderror" id="pickup_point_address" name="pickup_point_address" value="{{ $pickuppoint->pickup_point_address }}">

        @error('pickup_point_address')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
    </div>
    
    <div class="form-group">
        <label for="pickup_phone">Pickup Point Phone</label>
        <input type="text" class="form-control" id="pickup_phone" name="pickup_phone" value="{{ $pickuppoint->pickup_phone }}">
    </div>
    
    <div class="form-group">
        <label for="pickup_phone_two">Pickup Point Phone Two</label>
        <input type="text" class="form-control" id="pickup_phone_two" name="pickup_phone_two" value="{{ $pickuppoint->pickup_phone_two }}">
    </div>
    
    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><span class="processing d-none">Processing...</span>Update</button>
    </div>
	</form>
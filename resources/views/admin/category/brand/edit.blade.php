<form action="{{ route('update.brand', $data->id) }}" method="POST" enctype="multipart/form-data">
	@csrf
    <div class="form-group">
        <label for="brand_name">Brand Name</label>
        <input type="text" class="form-control  @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name" value="{{ $data->brand_name }}" required="">

        @error('brand_name')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
        
    </div>
    <div class="form-group">
    	<img src="{{ asset($data->brand_logo) }}" class="img-fluid" alt=""><br>
    	<input type="hidden" name="old_logo" value="{{ $data->brand_logo }}">
        <label for="brand_logo">Brand Logo</label>
        <input type="file" class="form-control dropify @error('brand_logo') is-invalid @enderror" id="brand_logo" name="brand_logo">

        @error('brand_logo')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
    </div>
    <div class="form-group">
        <label for="front_page">Homepage</label>
        <select name="front_page" id="front_page" class="form-control">
        	<option @if($data->front_page==0) selected @endif value="0">Deactive</option>
        	<option @if($data->front_page==1) selected @endif value="1">Active</option>
        </select>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
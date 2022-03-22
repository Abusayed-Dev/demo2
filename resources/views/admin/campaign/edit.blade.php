<form action="{{ route('update.campaign', $campaign->id) }}" method="POST" id="add-form" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="old_image" value="{{ $campaign->image }}">
    <div class="form-group">
        <label for="title">Title <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $campaign->title }}" required="">
        <small class="text-danger">Campaign name/title</small>
    </div>

    
    <div class="row">
    	<div class="form-group col-sm-6">
            <label for="start_date">Start Date <strong class="text-danger">*</strong></label>
            <input type="date" class="form-control" id="start_date" name="start_date" required="" value="{{ $campaign->start_date }}">
        </div>
        
        <div class="form-group col-sm-6">
            <label for="end_date">End Date <strong class="text-danger">*</strong></label>
            <input type="date" class="form-control" id="end_date" name="end_date" required="" value="{{ $campaign->end_date }}">
        </div>
    </div>
    
    <div class="row">
    	<div class="form-group col-sm-6">
            <label>Status <strong class="text-danger">*</strong></label>
            <select name="status" id="status" class="form-control" required="">
            	<option disabled="" selected="">==Choose one==</option>
            	<option @if($campaign->status == 0) selected="" @endif value="0">Deactive</option>
            	<option @if($campaign->status == 1) selected="" @endif value="1">Active</option>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label for="discount">Discount <strong class="text-danger">*</strong></label>
            <input type="number" class="form-control" id="discount" name="discount" required="" value="{{ $campaign->discount }}">
        </div>
    </div>

    <div class="form-group">
    	<div>
    		<img class="img-fluid" src="{{ asset($campaign->image) }}" alt="">
    	</div>
        <label for="image">Campaign Image <strong class="text-danger">*</strong></label>
        <input type="file" class="form-control dropify" id="image" name="image">
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><span class="processing d-none">Processing...</span>Update</button>
    </div>
	</form>
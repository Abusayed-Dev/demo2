<form action="{{ route('update.coupon', $coupon->id) }}" method="POST" id="edit-form">
	@csrf
    <div class="form-group">
        <label for="coupon_code">Coupon Code</label>
        <input type="text" class="form-control  @error('coupon_code') is-invalid @enderror" id="coupon_code" name="coupon_code" value="{{ $coupon->coupon_code }}">

        @error('coupon_code')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
    </div>

    
    <div class="form-group">
        <label for="coupon_code">Coupon Amount</label>
        <input type="text" class="form-control  @error('coupon_amount') is-invalid @enderror" id="coupon_amount" name="coupon_amount" value="{{ $coupon->coupon_amount }}">

        @error('coupon_amount')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
    </div>
    
    <div class="form-group">
        <label>Coupon Type</label>
        <select name="type" id="type" class="form-control">
        	<option @if($coupon->type==0) selected="" @endif value="0">Fixed</option>
        	<option @if($coupon->type==1) selected="" @endif  value="1">Percentage</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="valid_date">Valid Date</label>
        <input type="date" class="form-control" id="valid_date" name="valid_date" value="{{ $coupon->valid_date }}">
    </div>
    
    <div class="form-group">
        <label>Coupon Status</label>
        <select name="status" id="status" class="form-control">
        	<option disabled="" selected="">==Choose one==</option>
        	<option @if($coupon->status==0) selected="" @endif value="0">Deactive</option>
        	<option @if($coupon->status==1) selected="" @endif value="1">Active</option>
        </select>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><span class="processing d-none">Processing...</span>update</button>
    </div>
</form>


<script type="text/javascript">
	$('body').on('submit', '#edit-form', function (e) {
		e.preventDefault();
		var url = $(this).attr('action');
		var req = $(this).serialize();
		$('.processing').removeClass('d-none');

		$.ajax({
				url: url,
				type: 'post',
				data: req,
				success: function (data) {
					$('.processing').addClass('d-none');
					$('#editModal').modal('hide');
					table.ajax.reload();
					toastr.success(data);

				}
			});

	})
</script>
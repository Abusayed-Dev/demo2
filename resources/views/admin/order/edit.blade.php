
<form action="{{ route('update.order.status', $order->id) }}" method="POST" id="edit_form" >
	@csrf
    <div class="form-group">
        <label for="name">Name <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $order->name }}" required="">
    </div>

    <div class="form-group">
        <label for="email">Email <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="email" name="email" value="{{ $order->email }}" required="">
    </div>

    <div class="form-group">
        <label for="shipping_address">Address <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="shipping_address" name="shipping_address" value="{{ $order->shipping_address }}" required="">
    </div>

    <div class="form-group">
        <label for="phone">Phone <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $order->phone }}" required="">
    </div>

    <div class="form-group">
        <label for="phone">Order Status</label>
        <select name="status" id="status" class="form-control">
        	<option @if($order->status == 0) selected @endif value="0">Pending</option>
        	<option @if($order->status == 1) selected @endif value="1">Recevied</option>
        	<option @if($order->status == 2) selected @endif value="2">Shipped</option>
        	<option @if($order->status == 3) selected @endif value="3">Complite</option>
        	<option @if($order->status == 4) selected @endif value="4">Return</option>
        	<option @if($order->status == 5) selected @endif value="5">Cancel</option>
        </select>
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
        	<span class="d-none" id="loader"><i class="fas fa-spinner fa-pulse"></i></span>
        	<span class="up_btn">Update</span>
    	</button>
    </div>
</form>



<script type="text/javascript">

	//__update order
	$('body').on('submit', '#edit_form', function(event) {
		event.preventDefault();
		var url = $(this).attr('action');
		var req = $(this).serialize();

		$('#loader').removeClass('d-none');
		$('.up_btn').addClass('d-none');

		$.ajax({
			url: url,
			type: 'post',
			data:req,
			success: function (data) {
				$('#loader').addClass('d-none');
				$('.up_btn').removeClass('d-none');
				$('#editModal').modal('hide');
				table.ajax.reload();

			}
		});
		
	});

</script>
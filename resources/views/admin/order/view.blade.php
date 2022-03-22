
<form action="{{ route('update.order.status', $order->id) }}" method="POST" id="view_form" >
	@csrf
    <input type="hidden" name="name" id="name" value="{{$order->name}}">
	<div class="row">
		<div class="col-md-4 mb-2">
			Name: {{ $order->name }}
		</div>
		<div class="col-md-4 mb-2">
			Phone: {{ $order->phone }}
		</div>
		<div class="col-md-4 mb-2">
			Email: {{ $order->email }}
		</div>
		<div class="col-md-4 mb-2">
			Address: {{ $order->shipping_address }}
		</div>
		<div class="col-md-4 mb-2">
			Country: {{ $order->country }}
		</div>
		<div class="col-md-4 mb-2">
			Zip-Code: {{ $order->zip_code }}
		</div>
		<div class="col-md-4 mb-2">
			Order ID: {{ $order->order_id }}
		</div>
		<div class="col-md-4 mb-2">
			Subtotal: {{ $order->subtotal }}
		</div>
		<div class="col-md-4 mb-2">
			Total: {{ $order->total }}
		</div>
	</div>

	<div class="row">
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th>Product</th>
		      <th>Size</th>
		      <th>Color</th>
		      <th>Qty X Price</th>
		      <th>Subtotal</th>
		    </tr>
		  </thead>
		  <tbody>

		  	@foreach($order_details as $row)
			    <tr>
			      <th>{{ $row->product_name }}</th>
			      <td>{{ $row->size }}</td>
			      <td>{{ $row->color }}</td>
			      <td>{{ $row->quantity }} X {{ $row->single_price }}{{ $setting->currency }}</td>
			      <td>{{ $row->subtotal_price }} {{ $setting->currency }}</td>
			    </tr>
		    @endforeach
		  </tbody>
		</table>
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
	$('body').on('submit', '#view_form', function(event) {
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
				$('#viewModal').modal('hide');
				table.ajax.reload();

			}
		});
		
	});

</script>
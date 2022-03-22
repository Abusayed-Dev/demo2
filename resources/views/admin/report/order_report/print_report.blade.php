<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="company-name text-center">
				<h4><b>Abu Ecommerce Course</b></h4>
				<h6>All Order Details</h6>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<table id="table" class="table table-sm table-bordered  table-striped mb-0">
                <thead>
                    <tr>
                    	<th>Sl</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Subtotal ({{ $setting->currency }})</th>
                        <th>Total ({{ $setting->currency }})</th>
                        <th>Payment Type</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($order as $key => $row)
	                	<tr>
	                		<td><h6 class="p-0 m-0">{{ ++$key }}</h6></td>
	                		<td><h6 class="p-0 m-0">{{ $row->name }}</h6></td>
	                		<td><h6 class="p-0 m-0">{{ $row->phone }}</h6></td>
	                		<td><h6 class="p-0 m-0">{{ $row->email }}</h6></td>
	                		<td><h6 class="p-0 m-0">{{ $row->subtotal }}</h6></td>
	                		<td><h6 class="p-0 m-0">{{ $row->total }}</h6></td>
	                		<td><h6 class="p-0 m-0">{{ $row->payment_type }}</h6></td>
	                		<td><h6 class="p-0 m-0">{{ $row->date }}</h6></td>
	                		<td><h6 class="p-0 m-0">
	                			@if($row->status == 0) Pending @endif
					        	@if($row->status == 1) Recevied @endif 
					        	@if($row->status == 2) Shipped @endif 
					        	@if($row->status == 3) Complite @endif 
					        	@if($row->status == 4) Return @endif 
					        	@if($row->status == 5) Cancel @endif 
	                		</h6></td>
	                	</tr>
                	@endforeach
                </tbody>
            </table>
		</div>
	</div>
</div>
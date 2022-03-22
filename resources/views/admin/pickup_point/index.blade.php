@extends('layouts.admin')


@section('title', 'Coupon Page')


@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Coupon</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item active text-primary" aria-current="page">
                                	<a data-toggle="modal" data-target="#insertModal" class="btn-sm btn btn-danger" href="">Add New+</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                    <div>
                        <table id="table" class="table table-sm table-bordered  table-striped mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                    <th>Pickup Point Name</th>
                                    <th>Address</th>
                                    <th>Pickup Point Phone</th>
                                    <th>Pickup Point Phone Two</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	
                            </tbody>
                        </table>
                    </div>
            	</div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>

<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pickup Point Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
	        <form action="{{ route('store.pickup_point') }}" method="POST" id="add-form">
	        	@csrf
	            <div class="form-group">
	                <label for="pickup_point_name">Pickup Point Name</label>
	                <input type="text" class="form-control  @error('pickup_point_name') is-invalid @enderror" id="pickup_point_name" name="pickup_point_name" placeholder="pickup point name..">

	                @error('pickup_point_name')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	            </div>

	            
	            <div class="form-group">
	                <label for="pickup_point_address">Pickup Point Address</label>
	                <input type="text" class="form-control  @error('pickup_point_address') is-invalid @enderror" id="pickup_point_address" name="pickup_point_address" placeholder="pickup point address..">

	                @error('pickup_point_address')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	            </div>
	            
	            <div class="form-group">
	                <label for="pickup_phone">Pickup Point Phone</label>
	                <input type="text" class="form-control" id="pickup_phone" name="pickup_phone" placeholder="pickup point phone..">
	            </div>
	            
	            <div class="form-group">
	                <label for="pickup_phone_two">Pickup Point Phone Two</label>
	                <input type="text" class="form-control" id="pickup_phone_two" name="pickup_phone_two" placeholder="pickup point phone two..">
	            </div>
	            
			    <div class="form-group">
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary"><span class="processing d-none">Processing...</span>Add</button>
			    </div>
	      	</form>
        </div>
      	</div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pickup Point Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body" id="card_body">
	        
        </div>
      	</div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">

	$(function childcategory() {
		table = $('#table').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('pickuppoint.index') }}",
			columns:[
				{data:'DT_RowIndex', name:'DT_RowIndex'},
				{data:'pickup_point_name', name:'pickup_point_name'},
				{data:'pickup_point_address', name:'pickup_point_address'},
				{data:'pickup_phone', name:'pickup_phone'},
				{data:'pickup_phone_two', name:'pickup_phone_two'},
				{data:'action', name:'action', orderable:true, searchable:true},
			]
		});
	});
	
	$('body').on('click', '.edit', function (e) {
		e.preventDefault();
		var url = $(this).attr('href');
		$.ajax({
			url: url,
			type: 'get',
			success: function (data) {
				$('#card_body').html(data);
			}
		});
	});

</script>

@endsection

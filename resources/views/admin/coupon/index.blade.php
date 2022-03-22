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
                    <div class="table-responsive">
                        <table id="table" class="table table-sm table-bordered  table-striped mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                    <th>Coupon Code</th>
                                    <th>Coupon Amount</th>
                                    <th>Coupon Date</th>
                                    <th>Coupon Status</th>
                                    <th>Coupon Type</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Coupon Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
	        <form action="{{ route('store.coupon') }}" method="POST" id="add-form">
	        	@csrf
	            <div class="form-group">
	                <label for="coupon_code">Coupon Code</label>
	                <input type="text" class="form-control  @error('coupon_code') is-invalid @enderror" id="coupon_code" name="coupon_code" placeholder="Coupon code..">

	                @error('coupon_code')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	            </div>

	            
	            <div class="form-group">
	                <label for="coupon_code">Coupon Amount</label>
	                <input type="text" class="form-control  @error('coupon_amount') is-invalid @enderror" id="coupon_amount" name="coupon_amount" placeholder="Coupon code..">

	                @error('coupon_amount')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	            </div>
	            
	            <div class="form-group">
	                <label>Coupon Type</label>
	                <select name="type" id="type" class="form-control">
	                	<option value="0">Fixed</option>
	                	<option value="1">Percentage</option>
	                </select>
	            </div>
	            
	            <div class="form-group">
	                <label for="valid_date">Valid Date</label>
	                <input type="date" class="form-control" id="valid_date" name="valid_date" required="">
	            </div>
	            
	            <div class="form-group">
	                <label>Coupon Status</label>
	                <select name="status" id="status" class="form-control">
	                	<option disabled="" selected="">==Choose one==</option>
	                	<option value="0">Deactive</option>
	                	<option value="1">Active</option>
	                </select>
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
        <h5 class="modal-title" id="exampleModalLabel">Coupon Update</h5>
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
			ajax:"{{ route('coupon.index') }}",
			columns:[
				{data:'DT_RowIndex', name:'DT_RowIndex'},
				{data:'coupon_code', name:'coupon_code'},
				{data:'coupon_amount', name:'coupon_amount'},
				{data:'valid_date', name:'valid_date'},
				{data:'status', name:'status'},
				{data:'type', name:'type'},
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

	$('body').on('submit', '#add-form', function (e) {
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
					$('#insertModal').modal('hide');
					$('#add-form')[0].reset();
					toastr.success(data);
					table.ajax.reload()

				}
			});

	});

	$('body').on('click', '#ajaxdelete', function (e) {
		e.preventDefault();
		var url = $(this).attr('href');

			swal({
              title: "Are you sure?",
              text: "You will not be able to recover this imaginary file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, Delete it!",
              cancelButtonText: "No, cancel!",
            },
            function(isConfirm) {
              if (isConfirm) {
                swal("Deleted!", "Yes, Delete it.", "success");
                $.ajax({
					url: url,
					type: 'get',
					success: function (data) {
						toastr.success(data);
						table.ajax.reload()

					}
				});
              } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
              }
            });
	});

	
	

</script>

@endsection

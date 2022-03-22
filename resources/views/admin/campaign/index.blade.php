@extends('layouts.admin')


@section('title', 'Campaign Page')


@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Campaign</h1>
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
                    <div class="">
                        <table id="table" class="table table-sm table-bordered  table-striped mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                    <th>Start Date</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Discount</th>
                                    <th>Status</th>
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
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Campaign Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
	        <form action="{{ route('store.campaign') }}" method="POST" id="add-form" enctype="multipart/form-data">
	        	@csrf
	            <div class="form-group">
	                <label for="title">Title <strong class="text-danger">*</strong></label>
	                <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" placeholder="Campaign title.." required="">
	                <small class="text-danger">Campaign name/title</small>

	                @error('title')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	            </div>

	            
	            <div class="row">
	            	<div class="form-group col-sm-6">
		                <label for="start_date">Start Date <strong class="text-danger">*</strong></label>
		                <input type="date" class="form-control  @error('start_date') is-invalid @enderror" id="start_date" name="start_date" required="">

		                @error('start_date')
					    	<strong class="text-danger">{{ $message }}</strong>
						@enderror
		            </div>
		            
		            <div class="form-group col-sm-6">
		                <label for="end_date">End Date <strong class="text-danger">*</strong></label>
		                <input type="date" class="form-control  @error('end_date') is-invalid @enderror" id="end_date" name="end_date" required="">

		                @error('end_date')
					    	<strong class="text-danger">{{ $message }}</strong>
						@enderror
		            </div>
	            </div>
	            
	            <div class="row">
	            	<div class="form-group col-sm-6">
		                <label>Status <strong class="text-danger">*</strong></label>
		                <select name="status" id="status" class="form-control" required="">
		                	<option disabled="" selected="">==Choose one==</option>
		                	<option value="0">Deactive</option>
		                	<option value="1">Active</option>
		                </select>
		            </div>

		            <div class="form-group col-sm-6">
		                <label for="discount">Discount <strong class="text-danger">*</strong></label>
		                <input type="number" class="form-control  @error('discount') is-invalid @enderror" id="discount" name="discount" required="">

		                @error('discount')
					    	<strong class="text-danger">{{ $message }}</strong>
						@enderror
		            </div>
	            </div>

	            <div class="form-group">
	                <label for="image">Campaign Image <strong class="text-danger">*</strong></label>
	                <input type="file" class="form-control dropify @error('image') is-invalid @enderror" id="image" name="image">

	                @error('image')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
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
        <h5 class="modal-title" id="exampleModalLabel">Campaign Update</h5>
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
			ajax:"{{ route('campaign.index') }}",
			columns:[
				{data:'DT_RowIndex', name:'DT_RowIndex'},
				{data:'start_date', name:'start_date'},
				{data:'title', name:'title'},
				{data:'image', name:'image'},
				{data:'discount', name:'discount'},
				{data:'status', name:'status'},
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

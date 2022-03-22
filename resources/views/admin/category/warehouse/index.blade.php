@extends('layouts.admin')


@section('title', 'Warehouse Page')


@section('admin_content')

<style>body{color: #000;}</style>

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Warehouse</h1>
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
                    <div class="table-responsive" style="overflow:hidden;">
                        <table id="table" class="table table-sm table-bordered  table-striped mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                	<th>Warehouse Name</th>
                                	<th>Address</th>
                                    <th>Phone</th>
                                    <th >Action</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Warehouse</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
	        <form action="{{ route('store.warehouse') }}" method="POST" id="add-form">
	        	@csrf
	            <div class="form-group">
	                <label for="warehouse_name">Warehouse Name</label>
	                <input type="text" class="form-control  @error('warehouse_name') is-invalid @enderror" id="warehouse_name" name="warehouse_name" placeholder="Warehouse name..">

	                @error('warehouse_name')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	            </div>
	            <div class="form-group">
	                <label for="warehouse_address">Warehouse Address</label>
	                <input type="text" class="form-control  @error('warehouse_address') is-invalid @enderror" id="warehouse_address" name="warehouse_address" placeholder="Warehouse addr..">

	                @error('warehouse_address')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	            </div>
	            <div class="form-group">
	                <label for="warehouse_phone">Warehouse Phone</label>
	                <input type="text" class="form-control  @error('warehouse_phone') is-invalid @enderror" id="warehouse_phone" name="warehouse_phone" placeholder="Warehouse phone..">

	                @error('warehouse_phone')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	            </div>
			    <div class="form-group">
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        <button type="submit" class=" btn btn-primary"><span class="add-btn d-none">loading...</span>Add</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Warehouse</h5>
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
			ajax:"{{ route('warehouse.index') }}",
			columns:[
				{data:'DT_RowIndex', name:'DT_RowIndex'},
				{data:'warehouse_name', name:'warehouse_name'},
				{data:'warehouse_address', name:'warehouse_address'},
				{data:'warehouse_phone', name:'warehouse_phone'},
				{data:'action', name:'action', orderable:true, searchable:true},
			]
		});
	});


	$('body').on('click', '.edit', function () {
		let url = $(this).attr('href');
		$.ajax({
			url: url,
			type: 'get',
			success: function (data) {
				$('#card_body').html(data);
			}
		});
	});

	//__insert data by ajax
	$('body').on('submit', '#add-form', function (e) {
		e.preventDefault();
		var url = $(this).attr('action');
		var req = $(this).serialize();

		$('.add-btn').removeClass('d-none');
		$.ajax({
			url: url,
			type: 'post',
			data: req,
			success: function (data) {
				$('.add-btn').addClass('d-none');
				$('#insertModal').modal('hide');
				$('#add-form')[0].reset();
				toastr.success(data);
				table.ajax.reload();
			}
		});
	});

	$('body').on('click', '#deleteID', function(event) {
		event.preventDefault();
		var url = $(this).attr('href');

		swal({
              title: "Are you sure?",
              text: "You will not be able to recover this imaginary file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, delete it!",
              cancelButtonText: "No, cancel!",
            },
            function(isConfirm) {
              if (isConfirm) {
                swal("Deleted!", "You are delete.", "success");

                $.ajax({
            		url: url,
            		type: 'get',
            		success: function (data) {
            			toastr.success(data);
            			table.ajax.reload();
            		}
            	});

              }
         	});
	});

</script>


@endsection





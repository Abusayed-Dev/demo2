@extends('layouts.admin')


@section('title', 'Product Page')


@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Product List</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item active text-primary" aria-current="page">
                                	<a class="btn-sm btn btn-danger" href="{{ route('create.product') }}">Add New+</a>
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
                	<div class="row pb-5">
                		<div class="col-lg-3">
                			<label>Category</label>
                			<select name="category_id" id="category_id" class="form-control submitable">
                				<option value="">All</option>
                				@foreach($category as $row)
                					<option value="{{ $row->id }}">{{ $row->category_name }}</option>
                				@endforeach
                			</select>
                		</div>
                		<div class="col-lg-3">
                			<label>Brand</label>
                			<select name="brand_id" id="brand_id" class="form-control submitable">
                				<option value="">All</option>
                				@foreach($brand as $row)
                					<option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                				@endforeach
                			</select>
                		</div>
                		<div class="col-lg-3">
                			<label>Warehouse</label>
                			<select name="warehouse_id" id="warehouse_id" class="form-control submitable">
                				<option value="">All</option>
                				@foreach($warehouse as $row)
                					<option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                				@endforeach
                			</select>
                		</div>
                		<div class="col-lg-3">
                			<label>Status</label>
                			<select name="status" id="status" class="form-control submitable">
                				<option value="">All</option>
                				<option value="on">Active</option>
                				<option value="off">Deactive</option>
                			</select>
                		</div>
                	</div>
                    <div>
                        <table id="table" class="table table-sm table-bordered  table-striped mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                    <th>Thumbnail</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
                                    <th>Brand</th>
                                    <th>Featured</th>
                                    <th>Deal</th>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">

	$(function product() {
		table = $('#table').DataTable({
			"processing":true,
			"serverSide":true,
			"ajax":{
				"url": "{{route('index.product')}}",
				"data":function (e) {
					e.category_id = $('#category_id').val();
					e.brand_id = $('#brand_id').val();
					e.warehouse_id = $('#warehouse_id').val();
					e.status = $('#status').val();
				}
			},

			columns:[
				{data:'DT_RowIndex', name:'DT_RowIndex'},
				{data:'thumbnail', name:'thumbnail'},
				{data:'name', name:'name'},
				{data:'code', name:'code'},
				{data:'category_name', name:'category_name'},
				{data:'subcategory_name', name:'subcategory_name'},
				{data:'brand_name', name:'brand_name'},
				{data:'featured', name:'featured'},
				{data:'today_deal', name:'today_deal'},
				{data:'status', name:'status'},
				{data:'action', name:'action', orderable:true, searchable:true},
			]
		});
	});



	//__delete product
	$('body').on('click', '#ajaxdelete', function (e) {
		e.preventDefault();
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
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
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



	//__active featured product
	$('body').on('click', '#activeFeatured', function (e) {
		e.preventDefault();
		var url = $(this).attr('href');

		$.ajax({
			url: url,
			type: 'get',
			success: function (data) {
				toastr.success(data);
				table.ajax.reload();
			}
		});
	});

	//__deactive featured product
	$('body').on('click', '#deactiveFeatured', function (e) {
		e.preventDefault();
		var url = $(this).attr('href');

		$.ajax({
			url: url,
			type: 'get',
			success: function (data) {
				toastr.success(data);
				table.ajax.reload();
			}
		});
	});

	//__active Today deal 
	$('body').on('click', '#activeDeal', function (e) {
		e.preventDefault();
		var url = $(this).attr('href');

		$.ajax({
			url: url,
			type: 'get',
			success: function (data) {
				toastr.success(data);
				table.ajax.reload();
			}
		});
	});

	//__deactive Today deal 
	$('body').on('click', '#deactiveDeal', function (e) {
		e.preventDefault();
		var url = $(this).attr('href');

		$.ajax({
			url: url,
			type: 'get',
			success: function (data) {
				toastr.success(data);
				table.ajax.reload();
			}
		});
	});

	//__active Status 
	$('body').on('click', '#activeStatus', function (e) {
		e.preventDefault();
		var url = $(this).attr('href');

		$.ajax({
			url: url,
			type: 'get',
			success: function (data) {
				toastr.success(data);
				table.ajax.reload();
			}
		});
	});

	//__deactive Status
	$('body').on('click', '#deactiveStatus', function (e) {
		e.preventDefault();
		var url = $(this).attr('href');

		$.ajax({
			url: url,
			type: 'get',
			success: function (data) {
				toastr.success(data);
				table.ajax.reload();
			}
		});
	});

	//__submitable on change ajax call
	$('body').on('change', '.submitable', function () {
		$('#table').DataTable().ajax.reload();
	});

</script>

@endsection

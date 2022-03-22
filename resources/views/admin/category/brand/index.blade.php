@extends('layouts.admin')


@section('title', 'Brand Page')


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
                        <h1>Brand</h1>
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
                                	<th>Brand Name</th>
                                	<th>Brand-Slug</th>
                                    <th>Brand Logo</th>
                                    <th>Homepage</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
	        <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
	        	@csrf
	            <div class="form-group">
	                <label for="brand_name">Brand Name</label>
	                <input type="text" class="form-control  @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name" placeholder="brand name.." required="">

	                @error('brand_name')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	                
	            </div>
	            <div class="form-group">
	                <label for="brand_logo">Brand Logo</label>
	                <input type="file" class="form-control dropify @error('brand_logo') is-invalid @enderror" id="brand_logo" name="brand_logo">

	                @error('brand_logo')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
	            </div>
	            <div class="form-group">
	                <label for="front_page">Homepage</label>
	                <select name="front_page" id="front_page" class="form-control">
	                	<option value="0">Deactive</option>
	                	<option value="1">Active</option>
	                </select>
	            </div>
			    <div class="form-group">
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Add</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Child-Category</h5>
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
		var table = $('#table').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('brand.index') }}",
			columns:[
				{data:'DT_RowIndex', name:'DT_RowIndex'},
				{data:'brand_name', name:'brand_name'},
				{data:'brand_slug', name:'brand_slug'},
				{data:'brand_logo', name:'brand_logo', render: function (data, type, full, meta) {
					return "<img src='"+data+"' height='40'>"
				}},
				{data:'front_page', name:'front_page'},
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
</script>


@endsection


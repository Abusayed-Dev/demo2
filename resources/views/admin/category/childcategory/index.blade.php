@extends('layouts.admin')


@section('title', 'Childcategory Page')


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
                        <h1>Subcategory</h1>
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
                                	<th>Childcategory Name</th>
                                	<th>Childcategory-Slug</th>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Child-Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
	        <form action="{{ route('store.childcategory') }}" method="POST">
	        	@csrf
	            <div class="form-group">
	                <label for="category_id">Category-Subcategory</label>

	                <select name="subcategory_id" id="subcategory_id" class="form-control">
	                	@foreach($category as $row)

	                	@php
	                		$subcat = DB::table('subcategories')->where('category_id', $row->id)->get();
	                	@endphp

	                		<option class="text-danger" disabled="" value="{{ $row->id }}">{{ $row->category_name }}</option>

	                		@foreach($subcat as $row)
	                			<option value="{{ $row->id }}">-- {{ $row->subcategory_name }}</option>
	                		@endforeach
	                	@endforeach
	                </select>
	            </div>
	            <div class="form-group">
	                <label for="childcategory_name">Child-Category Name</label>
	                <input type="text" class="form-control  @error('childcategory_name') is-invalid @enderror" id="childcategory_name" name="childcategory_name" placeholder="Subcategory name..">

	                @error('childcategory_name')
				    	<strong class="text-danger">{{ $message }}</strong>
					@enderror
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
			ajax:"{{ route('childcategory.index') }}",
			columns:[
				{data:'DT_RowIndex', name:'DT_RowIndex'},
				{data:'childcategory_name', name:'childcategory_name'},
				{data:'childcategory_slug', name:'childcategory_slug'},
				{data:'category_name', name:'category_name'},
				{data:'subcategory_name', name:'subcategory_name'},
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





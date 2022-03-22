@extends('layouts.admin')


@section('title', 'Subcategory Page')


@section('admin_content')

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
                                	<a data-toggle="modal" data-target="#insertModal" class="btn-sm btn btn-danger" href="{{ route('admin.home') }}">Add New+</a>
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
                                    <th>Sub-Category Name</th>
                                    <th>Sub-Category Slug</th>
                                    <th>Category</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($subcategory as $key => $row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->subcategory_name }}</td>
                                    <td>{{ $row->subcat_slug }}</td>
                                    <td>{{ $row->category_name }}</td>
                                    <td>
                                    	<a data-toggle="modal" id="edit" data-target="#editModal" href="{{ route('edit.subcategory', $row->id) }}" class="btn btn-primary btn-sm" style="font-size: 18px;"><i class="fa fa-edit"></i></a>
                                    	<a id="delete" href="{{ route('delete.subcategory', $row->id) }}" class="btn btn-danger btn-sm" style="font-size: 18px;"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
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
        <h5 class="modal-title" id="exampleModalLabel">Subcategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
	        <form action="{{ route('store.subcategory') }}" method="POST">
	        	@csrf
	            <div class="form-group">
	                <label for="category_id">Category</label>

	                @php
	                	$category = DB::table('categories')->get();
	                @endphp

	                <select name="category_id" id="category_id" class="form-control">
	                	<option disabled="" selected="">==Chosse One==</option>
	                	@foreach($category as $row)
	                		<option value="{{ $row->id }}">{{ $row->category_name }}</option>
	                	@endforeach
	                </select>
	            </div>
	            <div class="form-group">
	                <label for="subcategory_name">Sub-Category Name</label>
	                <input type="text" class="form-control  @error('subcategory_name') is-invalid @enderror" id="subcategory_name" name="subcategory_name" placeholder="Subcategory name..">

	                @error('subcategory_name')
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
        <h5 class="modal-title" id="exampleModalLabel">Category</h5>
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
	
	$('body').on('click', '#edit', function (e) {
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







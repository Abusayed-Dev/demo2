@extends('layouts.admin')


@section('title', 'Blog Category Page')

@section('admin_content')

<link rel="stylesheet" href="{{ asset('public/frontend') }}/dataTable/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('public/frontend') }}/dataTable/jquery-3.5.1.js">
<link rel="stylesheet" href="{{ asset('public/frontend') }}/dataTable/jquery.dataTables.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Blog Category</h1>
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
                        <table id="myTable" class="table table-sm mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($category as $key => $row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->category_name }}</td>
                                    <td>{{ $row->category_slug }}</td>
                                    <td>
                                    	<a data-toggle="modal" id="edit" data-target="#editModal" href="{{ route('edit.blog.category', $row->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    	<a id="delete" href="{{ route('delete.blog.category', $row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Blog Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
	        <form action="{{ route('store.blog.category') }}" method="POST">
	        	@csrf
	            <div class="form-group">
	                <label for="category_name">Category Name</label>
	                <input type="text" class="form-control  @error('category_name') is-invalid @enderror" id="category_name" name="category_name" placeholder="Category name..">

	                @error('category_name')
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
        <h5 class="modal-title" id="exampleModalLabel">Blog Category Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body" id="card_body">
	       <span class="text-warning" id="loader" style="font-size:50px"><i class="fas fa-spinner fa-pulse"></i></span> 
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">

	$(document).ready( function () {
	    $('#myTable').DataTable();
	} );
	


	$('body').on('click', '#edit', function (e) {
		e.preventDefault();

		var url = $(this).attr('href');
		$.ajax({
			url: url,
			type: 'get',
			success: function (data) {
				$('#loader').addClass('d-none');
				$('#card_body').html(data);
			}
		});
	});
	
	

</script>

@endsection







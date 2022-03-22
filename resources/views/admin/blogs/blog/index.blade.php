@extends('layouts.admin')


@section('title', 'Blog Page')

@section('admin_content')

<link rel="stylesheet" href="{{ asset('public/frontend') }}/dataTable/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('public/frontend') }}/dataTable/jquery-3.5.1.js">
<link rel="stylesheet" href="{{ asset('public/frontend') }}/dataTable/jquery.dataTables.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

{{-- Dropify --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

{{-- summernote --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Blog</h1>
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
                        <table id="myTable" class="table table-sm mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                    <th>Thumbnail</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Publish Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($blog as $key => $row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>
                                    	<img src="{{ asset($row->thumbnail) }}" alt="" width="150px" height="80px">
                                    </td>
                                    <td>{{ $row->category_name }}</td>
                                    <td>{{ substr($row->title, 0, 50) }}..</td>
                                    <td>{{ $row->publish_date }}</td>
                                    <td>
                                    	@if( $row->status == '1')
                                    		<span class="badge badge-success">Active</span>
                                    	@endif
                                    </td>
                                    <td>
                                    	<a data-toggle="modal" id="edit" data-target="#editModal" href="{{ route('edit.blog', $row->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    	<a id="delete" href="{{ route('delete.blog', $row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Blog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
	        <form action="{{ route('store.blog') }}" method="POST" enctype="multipart/form-data">
	        	@csrf
	            <div class="form-group">
	                <label>Category</label>
	                <select name="blog_category_id" class="form-control">
	                	<option selected disabled>==Choosse One==</option>
	                	@foreach($category as $row)
	                		<option value="{{ $row->id }}">{{ $row->category_name }}</option>
	                	@endforeach
	                </select>
	            </div>

	            <div class="form-group">
	                <label>Title</label>
	                <input type="text" name="title" class="form-control" placeholder="Blog title..">
	            </div>

	            <div class="form-group">
	                <label>Description</label>
	                <textarea name="description"  class="form-control summernote" placeholder="Type description.."></textarea>
	            </div>

	            <div class="row">
	            	<div class="form-group col-md-6">
		                <label>Tag</label>
		                <input type="text" name="tag" class="form-control" placeholder="Type tag..">
		            </div>
	            	<div class="form-group col-md-6">
		                <label>Status</label>
		                <select name="status" class="form-control">
		                	<option value="0">Deactive</option>
		                	<option value="1">Active</option>
		                </select>
		            </div>
	            </div>

	            <div class="form-group">
	                <label>Thumbnail</label>
	                <input type="file" name="thumbnail" class="form-control dropify"  data-height="100">
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
  <div class="modal-dialog modal-lg" role="document">
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

<script type="text/javascript">

	//summernote
	$(document).ready(function() {
	  $('.summernote').summernote();
	});

	$('.dropify').dropify();

	$(document).ready( function () {
	    $('#myTable').DataTable();
	} );
	
</script>

@endsection


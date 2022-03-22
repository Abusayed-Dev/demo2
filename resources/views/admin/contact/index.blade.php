@extends('layouts.admin')


@section('title', 'Contact Page')

@section('admin_content')

<link rel="stylesheet" href="{{ asset('public/frontend') }}/dataTable/jquery.dataTables.min.css">
<script src="{{ asset('public/frontend') }}/dataTable/jquery-3.5.1.js"></script>
<script src="{{ asset('public/frontend') }}/dataTable/jquery.dataTables.min.js"></script>
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
                        <h1>Contact</h1>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($contact as $key => $row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ substr($row->message, 0, 100) }}..</td>
                                    <td>
                                    	@if( $row->status == 0)
                                    		<span class="badge badge-warning">Pending</span>
                                    	@elseif ( $row->status == 1)
                                    		<span class="badge badge-success">Replied</span>
                                    	@endif
                                    </td>
                                    <td>
                                    	<a data-toggle="modal" id="reply" data-target="#editModal" href="{{ route('reply.contact.message', $row->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact Reply</h5>
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

	//dataTabel
	 $(document).ready( function () {
	    $('#myTable').DataTable();
	} );


	$('body').on('click', '#reply', function (e) {
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


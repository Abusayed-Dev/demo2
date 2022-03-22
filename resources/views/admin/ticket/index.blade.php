@extends('layouts.admin')


@section('title', 'Ticket Page')


@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>All Ticket</h1>
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
                			<label>Type</label>
                			<select name="service" id="service" class="form-control submitable">
                				<option>All</option>
            					<option value="Technical">Technical</option>
	            				<option value="Payment">Payment</option>
	            				<option value="Affiliate">Affiliate</option>
	            				<option value="Return">Return</option>
	            				<option value="Refund">Refund</option>
                			</select>
                		</div>
                		<div class="col-lg-3">
                			<label>Date</label>
                			<input type="date" class="form-control" name="date" id="date">
                		</div>
                		<div class="col-lg-3">
                			<label>Status</label>
                			<select name="status" id="status" class="form-control submitable">
                				<option >All</option>
            					<option value="0">Pending</option>
            					<option value="1">Replied</option>
            					<option value="2">Closed</option>
                			</select>
                		</div>
                	</div>
                    <div>
                        <table id="table" class="table table-sm table-bordered  table-striped mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                    <th>User</th>
                                    <th>Subject</th>
                                    <th>Service</th>
                                    <th>Priority</th>
                                    <th>Date</th>
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
				"url": "{{route('index.ticket')}}",
				"data":function (e) {
					e.service = $('#service').val();
					e.date = $('#date').val();
					e.status = $('#status').val();
				}
			},

			columns:[
				{data:'DT_RowIndex', name:'DT_RowIndex'},
				{data:'name', name:'name'},
				{data:'subject', name:'subject'},
				{data:'service', name:'service'},
				{data:'priority', name:'priority'},
				{data:'date', name:'date'},
				{data:'status', name:'status'},
				{data:'action', name:'action', orderable:true, searchable:true},
			]
		});
	});


	//__submitable on change ajax call
	$('body').on('change', '.submitable', function () {
		$('#table').DataTable().ajax.reload();
	});

	//__submitable on change ajax call
	$('body').on('blur', '#date', function () {
		$('#table').DataTable().ajax.reload();
	});

</script>

@endsection

@extends('layouts.admin')


@section('title', 'Order Report')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>



@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>All Orders</h1>
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
                			<select name="payment_type" id="payment_type" class="form-control submitable">
                				<option value="">All</option>
            					<option value="Hand Cash">Hand Cash</option>
            					<option value="Aamarpay">Aamarpay</option>
            					<option value="Surjopay">Surjopay</option>
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
            					<option value="1">Recevied</option>
            					<option value="2">Shiped</option>
            					<option value="3">Complite</option>
            					<option value="4">Return</option>
            					<option value="5">Cancel</option>
                			</select>
                		</div>

                		<div class="col-3">
                			<label for="">Print Report</label><br>
                			<button class="btn btn-info btn-sm" id="OrderPrint" type="submit">
                				<span class="d-none loader_btn" style="font-size:20px"><i class="fas fa-spinner fa-pulse"></i></span>
                			 	<span class="report_text">Report Print</span>
                			</button>
                		</div>
                	</div>
                    <div>
                        <table id="table" class="table table-sm table-bordered  table-striped mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Subtotal ({{ $setting->currency }})</th>
                                    <th>Total ({{ $setting->currency }})</th>
                                    <th>Payment Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
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
				"url": "{{route('order.report')}}",
				"data":function (e) {
					e.payment_type = $('#payment_type').val();
					e.date = $('#date').val();
					e.status = $('#status').val();
				}
			},

			columns:[
				{data:'DT_RowIndex', name:'DT_RowIndex'},
				{data:'name', name:'name'},
				{data:'phone', name:'phone'},
				{data:'email', name:'email'},
				{data:'subtotal', name:'subtotal'},
				{data:'total', name:'total'},
				{data:'payment_type', name:'payment_type'},
				{data:'date', name:'date'},
				{data:'status', name:'status'},
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



	//__Order Print 
	$('#OrderPrint').click(function () {
		$('.loader_btn').removeClass('d-none');
		$('.report_text').addClass('d-none');

		$.ajax({
			url: '{{ route('report.order.print') }}',
			type: 'get',
			data: {payment_type: $('#payment_type').val(), date: $('#date').val(), status: $('#status').val()},
			success: function (data) {
				$('.loader_btn').addClass('d-none');
				$('.report_text').removeClass('d-none');

				$(data).printThis({
				    debug: false,           
				    importCSS: true,       
				    importStyle: false,  
				    printDelay: 500,  
				    removeInline: false, 
				    header: null,        
    				footer: null,       
				});
			}
		});

	});

</script>

@endsection

@extends('layouts.app')


@section('content')
@include('layouts.frontend_partial.header')


<main class="main" style="padding-top: 150px;">

    <div class="page-content">
    	<div class="cart">
            <div class="container">
            	<div class="row">
            		<div class="col-lg-9">
            			<div class="card py-3">
            				<h4 class="text-center mb-3">Billing Address</h4>

	            			<form action="{{ route('order.place') }}" method="post">
	            				@csrf
	            				<div class="row">
	            					<div class="col-md-6 form-group">
	            						<label>Customer Name</label>
	            						<input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" readonly="">
	            					</div>
	            					<div class="col-md-6 form-group">
	            						<label>Phone</label>
	            						<input type="text" class="form-control" name="phone">
	            					</div>
	            				</div>
	            				<div class="row">
	            					<div class="col-md-6 form-group">
	            						<label>Email Address</label>
	            						<input type="text" class="form-control" name="email">
	            					</div>
	            					<div class="col-md-6 form-group">
	            						<label>Shipping Adreess</label>
	            						<input type="text" class="form-control" name="shipping_address">
	            					</div>
	            				</div>

	            				<div class="row">
	            					<div class="col-md-6 form-group">
	            						<label>Country</label>
	            						<input type="text" class="form-control" name="country">
	            					</div>
	            					<div class="col-md-6 form-group">
	            						<label>Zip-Code</label>
	            						<input type="text" class="form-control" name="zip_code">
	            					</div>
	            				</div>

	            				<div class="row">
	            					<div class="col-md-6 form-group">
	            						<label>City</label>
	            						<input type="text" class="form-control" name="city">
	            					</div>
	            					<div class="col-md-6 form-group">
	            						<label>Extra Phone</label>
	            						<input type="text" class="form-control" name="extra_phone">
	            					</div>
	            				</div>
	            				
            					<div class="form-group">
            						<strong>Payment Gateway</strong>
            					</div>

	            				<div class="row">
	            					<div class="col-md-4 form-group">
	            						<label>Paypal</label>
	            						<input type="radio"  name="payment_type" value="Paypal">
	            					</div>
	            					<div class="col-md-4 form-group">
	            						<label>Baksh/Rocket/Nagad</label>
	            						<input type="radio" name="payment_type" value="Aamarpay" checked="">
	            					</div>
	            					<div class="col-md-4 form-group">
	            						<label>Hand Cash</label>
	            						<input type="radio" name="payment_type" value="Hand Cash">
	            					</div>
	            				</div>

	            				<button class="btn btn-danger" type="submit">Order Place</button>
	            			</form>
            			</div>

            		</div><!-- End .col-lg-9 -->
            		<aside class="col-lg-3">
            			<div class="summary summary-cart">
            				<h3 class="summary-title">Cart</h3><!-- End .summary-title -->

            				@if(Session::has('coupon'))
            				@else
	            				<div class="cart-discount">
		            				<form action="{{ route('apply.coupon') }}" method="post">
		            					@csrf
		            					<div class="input-group">
			        						<input type="text" class="form-control" name="coupon_code" required="" placeholder="coupon code">
			        						<div class="input-group-append">
												<button class="btn btn-outline-primary-2" type="submit"><i class="arrow icon-long-arrow-right"></i><span class="d-none process">...</span></button>
											</div><!-- .End .input-group-append -->
		        						</div><!-- End .input-group -->
		            				</form>
		            			</div>
	            			@endif

            				<table class="table table-summary">
            					<tbody>
            						
            						<tr class="summary-subtotal">
            							<td>Subtotal:</td>
            							<td>{{ $setting->currency }}{{ Cart::subtotal() }} </td>
            						</tr>
            						
            						<tr class="summary-shipping-row">
            							<td>Shipping Charge</td>
            							<td>{{ $setting->currency }}{{ 120 }}</td>
            						</tr>

            						@if(Session::has('coupon')) 
	            						<tr class="summary-shipping-row">
	            							<td>Coupon Code:</td>
	            							<td>({{ Session::get('coupon')['name'] }})</td>
	            						</tr> 

	            						<tr class="summary-shipping-row">
	            							<td>Coupon:</td>
	            							<td>({{ $setting->currency }}{{ Session::get('coupon')['discount_price'] }})<a href="{{ route('remove.coupon') }}" class="text-danger ml-5">X</a></td>
	            						</tr> 
            						@endif           						

            						<tr class="summary-shipping-row">
            							<td>Tax:</td>
            							<td>0.00%</td>
            						</tr>
            						<tr class="summary-shipping-row">
            							<td>Total:</td>
            							@if(Session::has('coupon')) 
            							<td class="text-danger h6">{{ $setting->currency }}{{ Session::get('coupon')['after_discount'] }}</td>
            							@else
            							<td class="text-danger h6">{{ $setting->currency }}{{ Cart::total() }}</td>
            							@endif
            						</tr>
            						
            					</tbody>
            				</table><!-- End .table table-summary -->
            			</div><!-- End .summary -->
            		</aside><!-- End .col-lg-3 -->
            	</div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$('body').on('blur', '.qty', function() {
		var qty = $(this).val();
		var rowId = $('.cartID').data('id');
		$.ajax({
			url: '{{ url('/update/cart-qty/') }}/'+rowId+'/'+qty,
			type: 'get',
			success: function (data) {
				toastr.success(data);
				location.reload()
			}
		});
	});
</script>


<script type="text/javascript">

$('body').on('change', '.cartID', function() {
	var color = $(this).val();
	var rowId = $(this).data('id');
	$.ajax({
		url: '{{ url('/update/') }}/'+rowId+'/'+color,
		type: 'get',
		success: function (data) {
			toastr.success(data);
			location.reload()
		}
	});
});	

</script>



@endsection
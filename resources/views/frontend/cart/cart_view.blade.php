@extends('layouts.app')


@section('content')
@include('layouts.frontend_partial.header')


<main class="main">
	<div class="page-header text-center" style="background-image: url('{{asset('public/frontend')}}/assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title">Shopping Cart</h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item">Shop</li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
    	<div class="cart">
            <div class="container">
            	<div class="row">
            		<div class="col-lg-9">
            			<table class="table table-cart table-mobile">
							<thead>
								<tr>
									<th>Product</th>
									<th>Color</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
								@foreach( $all_content as $row )

								@php
									$product = DB::table('products')->where('id', $row->id)->first();
									$color = explode(',', $product->color);
								@endphp

								<tr>
									<td class="product-col">
										<div class="product">
											<figure class="product-media">
												<a href="#">
													<img src="{{ asset($row->options->thumbnail) }}" alt="Product image">
												</a>
											</figure>

											<h3 class="product-title">
												<a href="#">{{ substr($row->name, 0, 30) }}..</a>
											</h3><!-- End .product-title -->
										</div><!-- End .product -->
									</td>
									
									<td class="quantity-col ">
										<select name="color" data-id="{{ $row->rowId }}" class="cart-product-quantity cartID">
											@foreach($color as $color)
												<option @if($color == $row->options->color) selected @endif value="{{ $color }}">{{ $color }}</option>
											@endforeach
										</select>
									</td>
									<td class="price-col">{{ $setting->currency }} {{ $row->price }} x {{ $row->qty }}</td>
									<td class="quantity-col">
                                        <div class="cart-product-quantity">
                                            <input type="number" class="form-control qty" min="1" max="10" value="{{ $row->qty }}" name="qty">
                                        </div>
                                    </td>
									<td class="total-col">{{ $setting->currency }} {{ $row->price*$row->qty}}</td>
									<td class="remove-col">
										<a href="{{ route('remove.cartRow', $row->rowId) }}" class="btn-remove text-danger"><i class="icon-close"></i></a>
									</td>
								</tr>
								@endforeach

							</tbody>
						</table><!-- End .table table-wishlist -->

            			<div class="cart-bottom">
	            			<a href="{{ url('/') }}" class="btn btn-outline-dark-2 ml-0">CONTINUE SHOPPING<i class="icon-refresh"></i></a>

	            			<a href="{{ route('destroy.cart') }}" class="btn btn-outline-dark-2">ClEAR CART<i class="icon-close"></i></a>
	            			<a href="{{ route('checkout') }}" class="btn btn-outline-dark-2 ml-3"><span>CHECKOUT CART</span><i class="icon-rocket"></i></a>
            			</div><!-- End .cart-bottom -->
            		</div><!-- End .col-lg-9 -->
            		<aside class="col-lg-3">
            			<div class="summary summary-cart">
            				<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

            				<table class="table table-summary">
            					<tbody>
            						<tr class="summary-subtotal">
            							<td>Total:</td>
            							<td>{{ $setting->currency }}{{ Cart::total() }} </td>
            						</tr><!-- End .summary-subtotal -->

            						<tr class="summary-shipping-row">
            							<td>Shipping Charge</td>
            							<td>{{ $setting->currency }}{{ 120 }}</td>
            						</tr>
            						
            					</tbody>
            				</table><!-- End .table table-summary -->

            				<a href="{{ route('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
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
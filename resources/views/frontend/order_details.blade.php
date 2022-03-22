@extends('layouts.app')

@section('content')

@include('frontend.user.middle_header')

<main class="main">
	<div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')  }}/assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title"> Order Tracking</h1>
		</div><!-- End .container -->
	</div>

    <div class="page-content py-3">
        <div class="container">
		    <div class="row">

		    	<div class="col-lg-4">
		    		<div class="card bg-light p-3">
		            	
	            		<span>Name: {{ $order->name }} </span>
	            	
	            		<span>Phone: {{ $order->phone }} </span>
	            	
	            		<span>Order Id: {{ $order->order_id }} </span>
	            	
	            		<span>Status:
							@if($order->status == 0)
		                        <strong class="badge badge-danger">Order Pending</strong>
		                    @elseif($order->status == 1)
		                        <strong class="badge badge-info">Order Recevied</strong>
		                    @elseif($order->status == 2)
		                        <strong class="badge badge-primary">Order Shipped</strong>
		                    @elseif($order->status == 3)
		                        <strong class="badge badge-success">Complited</strong>
		                    @elseif($order->status == 4)
		                        <strong class="badge badge-warning">Order Return</strong>
		                    @elseif($order->status == 5)
		                        <strong class="badge badge-danger">Order Cancel</strong>
		                    @endif
		            	 </span>
		            	
            			<span>Date: {{ $order->date }} </span>
            			<span>Subtotal: {{ $order->subtotal }} {{ $setting->currency }}</span>
            			<span>Total: {{ $order->total }} {{ $setting->currency }}</span>
			        </div>
		        </div>
		        

		        <div class="col-lg-8">
		            <div class="card bg-light p-3">
		                <table class="table" id="myTable">
		                  <strong class="text-info">My Order</strong>
		                  <thead>
		                    <tr>
		                      <th>SL</th>
		                      <th>Product</th>
		                      <th>Color</th>
		                      <th>Size</th>
		                      <th>Qty</th>
		                      <th>Price</th>
		                      <th>Subtotal Price</th>
		                    </tr>
		                  </thead>
		                  <tbody>

		                    @foreach($order_details as $key => $row)
		                    <tr>
		                      <td>{{ ++$key }}</td>
		                      <td>{{ substr($row->product_name, 0, 30) }}..</td>
		                      <td>@isset($row->color){{ $row->color }}@endisset</td>
		                      <td>@isset($row->size){{ $row->size }}@endisset</td>
		                      <td>{{ $row->quantity }}</td>
		                      <td>{{ $setting->currency }} {{ $row->single_price }}</td>
		                      <td>{{ $setting->currency }} {{ $row->subtotal_price }}</td>
		                    </tr>
		                    @endforeach
		                    
		                  </tbody>
		                </table>  
		            </div>

		        </div>
		    </div>
		</div>
    </div>
    <hr>
</main><!-- End .main -->




@endsection
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

{{-- dataTable --}}
<link rel="stylesheet" href="{{ asset('public/frontend/dataTable') }}/jquery.dataTables.min.css"/>
<script type="text/javascript" src="{{ asset('public/frontend/dataTable') }}/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ asset('public/frontend/dataTable') }}/jquery.dataTables.min.js"></script>


@include('frontend.user.middle_header')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            @include('frontend.user.sidebar')
        </div>

        <div class="col-lg-8">
            <div class="card bg-light mb-2">
              <div class="list-group-item list-group-item-dark">
                <span>Dashboard </span>
              </div>
            </div>

            <div class="card bg-light p-3">
            	<div class="row">
	            	<div class="col-lg-3">
	            		<span>Name: {{ $order->name }} </span>
	            	</div>
	            	<div class="col-lg-3">
	            		<span>Phone: {{ $order->phone }} </span>
	            	</div>
	            	<div class="col-lg-3">
	            		<span>Order Id: {{ $order->order_id }} </span>
	            	</div>
	            	<div class="col-lg-3">
	            		<span>Status:
												@if($order->status == 0)
		                        <strong class="badge badge-danger">Order Pending</strong>
		                    @elseif($order->status == 1)
		                        <strong class="badge badge-info">Order Recevied</strong>
		                    @elseif($order->status == 2)
		                        <strong class="badge badge-primary">Order Shipped</strong>
		                    @elseif($order->status == 3)
		                        <strong class="badge badge-success">Order Delivered</strong>
		                    @elseif($order->status == 4)
		                        <strong class="badge badge-warning">Order Return</strong>
		                    @elseif($order->status == 5)
		                        <strong class="badge badge-danger">Order Cancel</strong>
		                    @endif
		            	 </span>
	            	</div>
	            </div>
            	<div class="row">
	            	<div class="col-lg-3">
            			<span>Date: {{ $order->date }} </span>
	            	</div>
	            	<div class="col-lg-3">
            			<span>Subtotal: {{ $order->subtotal }} {{ $setting->currency }}</span>
	            	</div>
	            	<div class="col-lg-3">
            			<span>Total: {{ $order->total }} {{ $setting->currency }}</span>
	            	</div>
	            </div>
            </div>

            <div class="card bg-light mt-3 p-3">
                <table class="table table-striped" id="myTable">
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


<script type="text/javascript">

    $('#myTable').DataTable();

</script>

@endsection

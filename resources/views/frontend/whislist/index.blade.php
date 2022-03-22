@extends('layouts.app')


@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>


@include('layouts.frontend_partial.header')


<main class="main">
	<div class="page-header text-center" style="background-image: url('{{asset('public/frontend')}}/assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title">Your Whislist</h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Whislist</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
    	<div class="cart">
            <div class="container">
            	<div class="row justify-content-center">
            		<div class="col-lg-10">
            			<table class="table table-cart table-mobile">
							<thead>
								<tr>
									<th>Date</th>
									<th>Thumbnail</th>
									<th>Product Name</th>
									<th>Price</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
								@foreach( $whislist as $row )

								<tr>
									<td class="product-col">{{$row->date}}</td>
									<td class="product-col">
										<img height="100px" width="70px" src="{{ asset($row->thumbnail) }}" alt="{{$row->name}}">
									</td>
									<td class="product-col">{{ substr($row->name, 0, 30) }}..</td>
									@if($row->selling_price)
										<td class="product-col">{{ $setting->currency }} {{ $row->selling_price }}</td>
									@else
										<td class="product-col">{{ $setting->currency }} {{ $row->discount_price }}</td>
									@endif

									<td colspan="2" class="remove-col">
										<a href="{{ route('product.details', $row->slug) }}" class="btn-remove text-info"><i class="icon-shopping-cart"></i></a>
										<a href="{{ route('delete.whislist', $row->id) }}" class="btn-remove text-danger"><i class="icon-close"></i></a>
									</td>
								</tr>
								@endforeach

							</tbody>
						</table>

						<div class="justify-content-end d-flex">
							<a href="{{ route('clear.total.whislist') }}" class="btn btn-danger">Clear Whislist</a>
						</div>
            		</div>
            	</div>

            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main>


@endsection
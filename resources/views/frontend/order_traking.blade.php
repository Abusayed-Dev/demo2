@extends('layouts.app')

@section('content')

@include('frontend.user.middle_header')

<main class="main">
	<div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')  }}/assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title"> Tracking Order</h1>
		</div><!-- End .container -->
	</div>

    <div class="page-content py-3">
        <div class="container">
        	<div class="row justify-content-center">
        		<div class="col-lg-8">
        			<div class="border p-3">
        				<form action="{{ route('check.track') }}" method="post">
	        				@csrf

	        				<div class="form-group">
	        					<label for="">Order ID</label>
	        					<input type="text" class="form-control" name="order_id" placeholder="Track Your Order">
	        				</div>

	        				<button type="submit" class="btn btn-info">Track ID</button>
	        			</form>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
    <hr>
</main><!-- End .main -->




@endsection
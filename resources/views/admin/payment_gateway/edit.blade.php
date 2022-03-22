@extends('layouts.admin')


@section('title', 'Category Page')


@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Category</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item active text-primary" aria-current="page">
                                	<a data-toggle="modal" data-target="#insertModal" class="btn-sm btn btn-danger" href="{{ route('admin.home') }}">Add New+</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                	<div class="card-header"><strong>Aamarpay Payment Gateway</strong></div>

                	<div class="card-body">
				        <form action="{{ route('update.aamarpay', $aamarPay->id) }}" method="POST">
				        	@csrf
				            <div class="form-group">
				                <label for="store_id">Store ID</label>
				                <input type="text" class="form-control  @error('store_id') is-invalid @enderror" id="store_id" name="store_id" value="{{ $aamarPay->store_id }}">

				                @error('store_id')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
				            </div>

				            <div class="form-group">
				                <label for="signature_key">Signature Key</label>
				                <input type="text" class="form-control  @error('signature_key') is-invalid @enderror" id="signature_key" name="signature_key" value="{{ $aamarPay->signature_key }}">

				                @error('signature_key')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
				            </div>

				            <div class="form-group">
				                <input type="checkbox" name="status" value="1" @if($aamarPay->status == 1) checked @endif >
				                <label>Live Server</label>
				            </div>
				           
						    <div class="form-group">
						        <button type="submit" class="btn btn-success btn-sm">Update</button>
						    </div>
				      	</form>
			        </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                	<div class="card-header"><strong>Surjopay Payment Gateway</strong></div>

                	<div class="card-body">
				        <form action="{{ route('update.surjopay', $surjoPay->id) }}" method="POST">
				        	@csrf
				            <div class="form-group">
				                <label for="store_id">Store ID</label>
				                <input type="text" class="form-control  @error('store_id') is-invalid @enderror" id="store_id" name="store_id" value="{{ $surjoPay->store_id }}">

				                @error('store_id')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
				            </div>

				            <div class="form-group">
				                <label for="signature_key">Signature Key</label>
				                <input type="text" class="form-control  @error('signature_key') is-invalid @enderror" id="signature_key" name="signature_key" value="{{ $surjoPay->signature_key }}">

				                @error('signature_key')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
				            </div>

				            <div class="form-group">
				                <input type="checkbox" name="status" value="1" @if($surjoPay->status == 1) checked @endif >
				                <label>Live Server</label>
				            </div>
				           
						    <div class="form-group">
						        <button type="submit" class="btn btn-success btn-sm">Update</button>
						    </div>
				      	</form>
			        </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                	<div class="card-header"><strong>SSL Commerz Payment Gateway</strong></div>

                	<div class="card-body">
				        <form action="{{ route('update.ssl', $ssl->id) }}" method="POST">
				        	@csrf
				            <div class="form-group">
				                <label for="store_id">Store ID</label>
				                <input type="text" class="form-control  @error('store_id') is-invalid @enderror" id="store_id" name="store_id" value="{{ $ssl->store_id }}">

				                @error('store_id')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
				            </div>

				            <div class="form-group">
				                <label for="signature_key">Signature Key</label>
				                <input type="text" class="form-control  @error('signature_key') is-invalid @enderror" id="signature_key" name="signature_key" value="{{ $ssl->signature_key }}">

				                @error('signature_key')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
				            </div>

				            <div class="form-group">
				                <input type="checkbox" name="status" value="1" @if($ssl->status == 1) checked @endif >
				                <label>Live Server</label>
				            </div>
				           
						    <div class="form-group">
						        <button type="submit" class="btn btn-success btn-sm">Update</button>
						    </div>
				      	</form>
			        </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>


@endsection







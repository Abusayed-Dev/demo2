@extends('layouts.admin')


@section('title', 'Create Role')


@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Create Role</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item active text-primary" aria-current="page">
                                	<a class="btn-sm btn btn-danger" href="{{ route('manage.role') }}">Manage Role</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>

        <div class="row">
        	<div class="col-md-12">
			    <div class="list-group-item active">Add New Role</div>
			  	
        		<div class="card">
			    <div class="card-body">
			        <form action="{{ route('store.role') }}" method="POST">
			        	@csrf
			            <div class="row">
		            		<div class="form-group col-4">
				                <label>Employe Name <strong class="text-danger">*</strong></label>
				                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Employe name..">

				                @error('name')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
				            </div>
		            		<div class="form-group col-4">
				                <label>Employe Email <strong class="text-danger">*</strong></label>
				                <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Employe email..">

				                @error('email')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
				            </div>
		            		<div class="form-group col-4">
				                <label for="category_name">Password <strong class="text-danger">*</strong></label>
				                <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="password..">

				                @error('password')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
				            </div>
			            </div>

			            <div class="row">
			            	<div class="form-group col-2">
				                <input type="checkbox" name="category" value="1" checked>
				                <label>Category</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="setting" value="1" checked>
				                <label>Setting</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="offer" value="1" checked>
				                <label>Offer</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="pickup" value="1" checked>
				                <label>Pickup</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="product" value="1" checked>
				                <label>Product</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="ticket" value="1" checked>
				                <label>Ticket</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="payment" value="1" checked>
				                <label>Payment</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="order" value="1" checked>
				                <label>Order</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="blog" value="1" checked>
				                <label>Blog</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="contact" value="1" checked>
				                <label>Contact</label>
				            </div>
			            	<div class="form-group col-1">
				                <input type="checkbox" name="report" value="1" checked>
				                <label>Report</label>
				            </div>
			            	<div class="form-group col-2">
				                <input type="checkbox" name="user_role" value="1" checked>
				                <label>User Role</label>
				            </div>
			            </div>
			            
					    <div class="form-group">
					        <button type="submit" class="btn btn-info">Add Role</button>
					    </div>
			      	</form>
			    </div>
			</div>
        	</div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>

@endsection




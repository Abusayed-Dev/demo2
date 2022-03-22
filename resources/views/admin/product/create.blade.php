@extends('layouts.admin')


@section('title', 'Create Product Page')


@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">

        <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xl-8">
                <div class="card card-statistics">
                    <div class="card-header">
                        <div class="card-heading">
                            <h4 class="card-title">Add Product</h4>
                        </div>
                    </div>
                    <div class="card-body">

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label for="name">Product Name <strong class="text-danger">*</strong></label>
	                                <input type="text" class="form-control" name="name" id="name"  placeholder="Product name..">
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="code">Product Code <strong class="text-danger">*</strong></label>
	                                <input type="text" class="form-control" name="code" id="code"  placeholder="Product code..">
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label for="category_id">Category-Subcategory <strong class="text-danger">*</strong></label>

	                                <select name="subcategory_id" id="subcategory_id" class="form-control">
	                                	<option disabled="" selected="">==Choose One==</option>
	                                	@foreach($category as $row)
	                                	   <option disabled="" class="text-danger" value="{{ $row->id }}">{{ $row->category_name }}</option>
	                                	@php
			                               $subcategory = DB::table('subcategories')->where('category_id', $row->id)->get();
			                            @endphp   
	                                	   @foreach($subcategory as $subcat)
	                                	   <option value="{{ $subcat->id }}">---{{ $subcat->subcategory_name }}</option>
	                                	   @endforeach
	                                	@endforeach
	                                </select>
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="childcategory_id">Child-Category <strong class="text-danger">*</strong></label>
	                                <select name="childcategory_id" id="childcategory_id" class="form-control"></select>
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label for="brand_id">Brand <strong class="text-danger">*</strong></label>
	                                <select name="brand_id" id="brand_id" class="form-control">
	                                	<option disabled="" selected="">==Choose One==</option>

	                                	@foreach( $brand as $row )
	                                	  <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
	                                	@endforeach
	                                </select>
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="pickup_point_id">Pickup Point <strong class="text-danger">*</strong></label>
	                                <select name="pickup_point_id" id="pickup_point_id" class="form-control">
	                                	<option disabled="" selected="">==Choose One==</option>

	                                	@foreach( $pickuppoint as $row )
	                                	  <option value="{{ $row->id }}">{{ $row->pickup_point_name }}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label for="unit">Unit <strong class="text-danger">*</strong></label>
	                                <input type="text" name="unit" id="unit" class="form-control">
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="tags">Tags</label>
	                                <input type="text" name="tags" id="tags" placeholder="tags.." class="form-control">
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-4">
	                                <label for="purchage_price">Purchage Price</label>
	                                <input type="text" name="purchage_price" id="purchage_price" placeholder="Purchage price.." class="form-control">
	                            </div>

                            	<div class="form-group col-lg-4">
	                                <label for="selling_price">Selling Price <strong class="text-danger">*</strong></label>
	                                <input type="text" name="selling_price" id="selling_price" class="form-control" placeholder="Selling price..">
	                            </div>

                            	<div class="form-group col-lg-4">
	                                <label for="discount_price">Discount Price</label>
	                                <input type="text" name="discount_price" id="discount_price" placeholder="Discount price.." class="form-control">
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label for="stock_quantity">Quantity</label>
	                                <input type="text" name="stock_quantity" id="stock_quantity" placeholder="Stock quantity.." class="form-control">
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="warehouse_id">Warehouse <strong class="text-danger">*</strong></label>
	                                <select name="warehouse_id" id="warehouse_id" class="form-control">
	                                	<option disabled="" selected="">==Choose One==</option>

	                                	@foreach( $warehouse as $row )
	                                	  <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
                            		<label for="color">Color</label><br>   
                                    <input type="text" name="color" id="color" class="bs-input"  data-role="tagsinput" placeholder="type color then enter..">
                                </div>

                            	<div class="form-group col-lg-6">
                            		<label for="color">Size</label><br>   
                                    <input type="text" name="size" id="size" class="bs-input"  data-role="tagsinput" placeholder="type size then enter..">
                                </div>
                            </div>

                        	<div class="form-group">
                                <label for="description">Product Details</label>
                                
                                <textarea name="description" id="summernote" class="form-control summernote"></textarea>
                            </div>

                        	<div class="form-group">
                                <label for="video">Video Embed Code</label>
                                <input type="text" name="video" id="video" class="form-control" placeholder="Video embed code..">
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
            	<div class="form-group">
                    <label for="video">Main Thumbnail  <strong class="text-danger">*</strong></label>
                    <input type="file" name="thumbnail" data-height="150" id="thumbnail" class="form-control dropify">
                </div>

                <div class="">  
                    <table class="table table-bordered" id="dynamic_field">
                    <div class="card-header">
                      <p class="card-title">More Images (Click Add For More Image)<p>
                    </div> 
                      <tr>  
                          <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>  
                          <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>  
                      </tr>  
                    </table>    
                </div>

                
                <div class="form-group card p-4">
                    <div class="checkbox checbox-switch switch-info">
                    	<h4 class="mb-4">Featured Product</h4>
                        <label>
                            <input type="checkbox" name="featured">
                            <span style="cursor: pointer;"></span>
                        </label>
                    </div>
                </div>

                
                <div class="form-group card p-4">
                    <div class="checkbox checbox-switch switch-info">
                    	<h4 class="mb-4">Today Deal</h4>
                        <label>
                            <input type="checkbox" name="today_deal">
                            <span style="cursor: pointer;"></span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group card p-4">
                    <div class="checkbox checbox-switch switch-info">
                    	<h4 class="mb-4">Trendy Product</h4>
                        <label>
                            <input type="checkbox" name="trendy">
                            <span style="cursor: pointer;"></span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group card p-4">
                    <div class="checkbox checbox-switch switch-info">
                    	<h4 class="mb-4">Slider Product</h4>
                        <label>
                            <input type="checkbox" name="slider_product">
                            <span style="cursor: pointer;"></span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group card p-4">
                    <div class="checkbox checbox-switch switch-info">
                    	<h4 class="mb-4">Status</h4>
                        <label>
                            <input type="checkbox" name="status">
                            <span style="cursor: pointer;"></span>
                        </label>
                    </div>
                </div>

            </div>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>

    	</form>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){      
	   var postURL = "<?php echo url('addmore'); ?>";
	   var i=1;  
	   $('#add').click(function(){  
	        i++;  
	        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
	   });  

	   $(document).on('click', '.btn_remove', function(){  
	        var button_id = $(this).attr("id");   
	        $('#row'+button_id+'').remove();  
	   });  
	 });




	//__childcategory auto select

	$(document).ready(function(){     
	$('#subcategory_id').change(function() {
		var id = $(this).val();
		$.ajax({
			url: "{{ url("/get-child-category/") }}/"+id,
			type: 'GET',
			success:function (data) {
				$('select[name="childcategory_id"]').empty();
				$.each(data, function (key, data) {
					$('select[name="childcategory_id"]').append('<option value="'+data.id+'">'+data.childcategory_name+'</option>');
				});
			}
		});
		
		
	});
	});
</script>



@endsection

@extends('layouts.admin')


@section('title', 'Update Product Page')



@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">

        <form action="{{ route('update.product', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xl-8">
                <div class="card card-statistics">
                    <div class="card-header">
                        <div class="card-heading">
                            <h4 class="card-title">Update Product</h4>
                        </div>
                    </div>
                    <div class="card-body">

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label for="name">Product Name <strong class="text-danger">*</strong></label>
	                                <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}">
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="code">Product Code <strong class="text-danger">*</strong></label>
	                                <input type="text" class="form-control" name="code" id="code" value="{{ $data->code }}">
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
	                                	   <option  @if($data->subcategory_id == $subcat->id) selected @endif value="{{ $subcat->id }}">---{{ $subcat->subcategory_name }}</option>
	                                	   @endforeach
	                                	@endforeach
	                                </select>
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="childcategory_id">Child-Category <strong class="text-danger">*</strong></label>
	                                <select name="childcategory_id" id="childcategory_id" class="form-control">
	                                	@foreach($childcat as $row)
	                                	   <option  @if($data->childcategory_id == $row->id) selected @endif value="{{ $row->id }}">---{{ $row->childcategory_name }}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label for="brand_id">Brand <strong class="text-danger">*</strong></label>
	                                <select name="brand_id" id="brand_id" class="form-control">
	                                	<option disabled="" selected="">==Choose One==</option>

	                                	@foreach( $brand as $row )
	                                	  <option @if($data->brand_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->brand_name }}</option>
	                                	@endforeach
	                                </select>
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="pickup_point_id">Pickup Point <strong class="text-danger">*</strong></label>
	                                <select name="pickup_point_id" id="pickup_point_id" class="form-control">
	                                	<option disabled="" selected="">==Choose One==</option>

	                                	@foreach( $pickuppoint as $row )
	                                	  <option @if($data->pickup_point_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->pickup_point_name }}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label for="unit">Unit <strong class="text-danger">*</strong></label>
	                                <input type="text" name="unit" id="unit" class="form-control" value="{{ $data->unit }}">
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="tags">Tags</label>
	                                <input type="text" name="tags" id="tags" value="{{ $data->tags }}" class="form-control">
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-4">
	                                <label for="purchage_price">Purchage Price</label>
	                                <input type="text" name="purchage_price" id="purchage_price" value="{{ $data->purchage_price }}" class="form-control">
	                            </div>

                            	<div class="form-group col-lg-4">
	                                <label for="selling_price">Selling Price <strong class="text-danger">*</strong></label>
	                                <input type="text" name="selling_price" id="selling_price" class="form-control" value="{{ $data->selling_price }}">
	                            </div>

                            	<div class="form-group col-lg-4">
	                                <label for="discount_price">Discount Price</label>
	                                <input type="text" name="discount_price" id="discount_price" value="{{ $data->discount_price }}" class="form-control">
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label for="stock_quantity">Quantity</label>
	                                <input type="text" name="stock_quantity" id="stock_quantity" value="{{ $data->stock_quantity }}" class="form-control">
	                            </div>

                            	<div class="form-group col-lg-6">
	                                <label for="warehouse_id">Warehouse <strong class="text-danger">*</strong></label>
	                                <select name="warehouse_id" id="warehouse_id" class="form-control">
	                                	<option disabled="" selected="">==Choose One==</option>

	                                	@foreach( $warehouse as $row )
	                                	  <option @if($data->warehouse_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
                            		<label for="color">Color</label><br>   
                                    <input type="text" name="color" id="color" class="bs-input"  data-role="tagsinput" value="{{ $data->color }}">
                                </div>

                            	<div class="form-group col-lg-6">
                            		<label for="color">Size</label><br>   
                                    <input type="text" name="size" id="size" class="bs-input"  data-role="tagsinput" value="{{ $data->size }}">
                                </div>
                            </div>  
                            

                        	<div class="form-group">
                                <label for="description">Product Details</label>
                                
                                <textarea name="description" id="summernote" class="form-control summernote">
                                	{{$data->description}}
                                </textarea>
                            </div>

                        	<div class="form-group">
                                <label for="video">Video Embed Code</label>
                                <input type="text" name="video" id="video" class="form-control" value="{{ $data->video }}">
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
            	<div class="form-group">
            		<img class="w-50" src="{{ asset($data->thumbnail) }}" alt=""><br>
            		<input type="hidden" name="old_thumbnail" value="{{ $data->thumbnail }}">
                    <label for="video">Main Thumbnail  <strong class="text-danger">*</strong></label>
                    <input type="file" name="thumbnail" data-height="150" id="thumbnail" class="form-control dropify">
                </div>

                <div class="">  
                    <table class="table table-bordered" id="dynamic_field">
                    <div class="card-header">
                      <p class="card-title">More Images (Click Add For More Image)<p>
                    </div>
                    <div class="row p-2">
                    	@php
                    	$images = json_decode($data->images, true);
                    	@endphp

                    	@if($images)
	                    	@foreach($images as $image)
	                    	<div class="col-lg-4 remove_image">
		                    	<img style="width:50px; height: 50px" src="{{ asset('public/files/product/'.$image) }}" alt="">
		                    	<input type="hidden" name="old_images[]" value="{{ $image }}">
		                    	<button type="button" class="btn btn-sm remove_files">X</button>
	                    	</div>
		                    @endforeach
	                    @endif
                    	
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
                            <input type="checkbox" name="featured" @if($data->featured == 'on') checked @endif>
                            <span style="cursor: pointer;"></span>
                        </label>
                    </div>
                </div>

                
                <div class="form-group card p-4">
                    <div class="checkbox checbox-switch switch-info">
                    	<h4 class="mb-4">Today Deal</h4>
                        <label>
                            <input type="checkbox" name="today_deal" @if($data->today_deal == 'on') checked @endif>
                            <span style="cursor: pointer;"></span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group card p-4">
                    <div class="checkbox checbox-switch switch-info">
                    	<h4 class="mb-4">Trendy Product</h4>
                        <label>
                            <input type="checkbox" name="trendy" @if($data->trendy == 'on') checked @endif>
                            <span style="cursor: pointer;"></span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group card p-4">
                    <div class="checkbox checbox-switch switch-info">
                    	<h4 class="mb-4">Slider Product</h4>
                        <label>
                            <input type="checkbox" name="slider_product" @if($data->slider_product == 'on') checked @endif>
                            <span style="cursor: pointer;"></span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group card p-4">
                    <div class="checkbox checbox-switch switch-info">
                    	<h4 class="mb-4">Status</h4>
                        <label>
                            <input type="checkbox" name="status" @if($data->status == 'on') checked @endif>
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

	//__remove images
	$('body').on('click', '.remove_files', function() {
		$(this).parent('.remove_image').remove();
	});
</script>



@endsection

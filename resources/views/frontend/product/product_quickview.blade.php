<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 30px;
  height: 30px;
  margin-left: 45%;
  margin-top: 15%;
  margin-bottom: 18%;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>


 @php
 	$size = explode(',', $product->size);     
 	$color = explode(',', $product->color);     
 @endphp 


{{-- preloader for product quick view --}}
<div class="loader"></div>


<div class="row product_view d-none">

      <form action="{{ route('add.to.cart.quickview', $product->id) }}" method="post" id="addToCart-form" >
        @csrf

        @if($product->discount_price)
          <input type="hidden" name="price" value="{{ $product->discount_price }}">
        @else
         <input type="hidden" name="price" value="{{ $product->selling_price }}">
        @endif

        <div class="col-sm-12">
            <span class="py-3 d-block">
              <img style="height: 300px;width: 100% !important;" src="{{ asset($product->thumbnail) }}" alt="">
            </span>

            <h6>{{ substr($product->name, 0, 200) }}...</h6>
            <p>{{ $product->category->category_name }} > {{ $product->childcategory->childcategory_name }}</p>
            <p>Brand: {{ $product->brand->brand_name }}</p>
            <p>
                Price:@if($product->discount_price)
                			<del class="text-danger"><small>{{ $product->selling_price }}</small></del>
                			<span>{{ $product->discount_price }}</span>
                		@else
                			<span>{{ $product->selling_price }}</span>
                		@endif
            </p>
            <p>
            	Stock: @if($product->stock_quantity == NULL)
                			<span class="badge badge-danger">Product are not available</span>
                		@else
                			<span class="badge badge-success">Product available</span>
                		@endif
            </p>

            <div class="row">
              <div class="form-group col-sm-4">
                <label for="color">Color</label>
                <select name="color" class="form-control">

                	@foreach( $color as $color )
                  	<option value="{{ $color }}">{{ $color }}</option>
                  @endforeach
                </select>
              </div>

              @if( $product->size )
              <div class="form-group col-sm-4">
                <label for="size">Size</label>
                <select name="size" class="form-control">
                  @foreach( $size as $size )
                  	<option value="{{ $size }}">{{ $size }}</option>
                  @endforeach
                </select>
              </div>
              @endif

              <div class="form-group col-sm-4">
                <label for="Qty">Qty</label>
                <input type="number" name="qty" min="1" max="100" class="form-control" value="1">
              </div>
            </div>

            @if($product->stock_quantity <1)
    			<span class="badge badge-danger">Stock Out</span>
    		  @else
    			<button type="submit" class="btn btn-outline-primary">
            <span class="addcartBtn">Add To Cart</span>
            <span class="d-none prodcessing_btn">Processing...</span>
          </button>   
    		  @endif
            	      
        </div>
      </form>
</div>

<script type="text/javascript">
$('.loader').ready(function() {
  setTimeout(function() {
    $('.product_view').removeClass("d-none");
    $('.loader').css("display", "none");
  }, 500);
});
</script>  



<script type="text/javascript">
  $('#addToCart-form').submit(function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var req = $(this).serialize();

    $('.addcartBtn').addClass('d-none');
    $('.prodcessing_btn').removeClass('d-none');

    $.ajax({
        url: url,
        type: 'post',
        data: req,
        success: function (data) {
          $('.addcartBtn').removeClass('d-none');
          $('.prodcessing_btn').addClass('d-none');
          $('#addToCart-form')[0].reset();
          toastr.success(data);
          cart();
        }
      });
    
  });
</script>


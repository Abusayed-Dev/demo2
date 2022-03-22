@extends('layouts.app')


@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
<style>
    .btn-pro {display: inline-block;background: #33E8FF;
        color: #fff; font-size: 13px;font-weight: 400;padding: 5px 10px;border: 1px solid #7abaff;
    }
    .product-details-btn {
        padding-bottom: 15px;
    }
</style>

@include('layouts.frontend_partial.header')



<main class="main">
	<div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')  }}/assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title">@isset( $brands->brand->brand_name ) {{ $brands->brand->brand_name }} @endisset</h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $brands->category->category_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $brands->brand->brand_name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
        	<div class="row">
        		<div class="col-lg-9">
        			<div class="toolbox">
        				<div class="toolbox-left">
        					<div class="toolbox-info">
        						Showing <span>9 of {{ count($brandwiseProduct) }}</span> Products
        					</div><!-- End .toolbox-info -->
        				</div><!-- End .toolbox-left -->

        				<div class="toolbox-right">
        					<div class="toolbox-sort">
        						<label for="sortby">Sort by:</label>
        						<div class="select-custom">
									<select name="sortby" id="sortby" class="form-control">
										<option value="popularity" selected="selected">Most Popular</option>
										<option value="rating">Most Rated</option>
										<option value="date">Date</option>
									</select>
								</div>
        					</div><!-- End .toolbox-sort -->
        					
        				</div><!-- End .toolbox-right -->
        			</div><!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row justify-content-center">
                        	@foreach( $brandwiseProduct as $row )
	                            <div class="col-6 col-md-4 col-lg-4">
	                                <div class="product product-7 text-center">
	                                    <figure class="product-media">
	                                        <a href="{{ route('product.details', $row->slug) }}">
	                                            <img src="{{ asset($row->thumbnail) }}" alt="Product image" class="product-image">
	                                        </a>

	                                        <div class="product-action-vertical">
	                                            <a href="{{ route('add.whislist', $row->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
	                                            
	                                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
	                                        </div><!-- End .product-action-vertical -->

	                                        <div class="product-action">
	                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
	                                        </div><!-- End .product-action -->
	                                    </figure><!-- End .product-media -->

	                                    <div class="product-body">
	                                        <div class="product-cat">
	                                            <a href="#">{{ $row->category->category_name }}</a>
	                                        </div><!-- End .product-cat -->
	                                        <h3 class="product-title"><a href="{{ route('product.details', $row->slug) }}">{{ substr($row->name, 0, 30) }}...</a></h3><!-- End .product-title -->

	                                        @if($row->discount_price)
				                                <div class="product-price">
				                                    <small class="mr-2">
				                                        <del class="text-danger"><small>{{ $setting->currency }}{{ $row->selling_price }}</small></del>
				                                    </small>
				                                    {{ $setting->currency }}{{ $row->discount_price  }}
				                                </div><!-- End .product-price -->
				                            @else
				                                <div class="product-price">
				                                    {{ $setting->currency }}{{ $row->selling_price }}
				                                </div><!-- End .product-price -->
				                            @endif

	                                    @php
	                                    	$images = json_decode($row->images, true);    
	                                    @endphp    
	                                        <div class="product-nav product-nav-thumbs">
	                                        	@foreach( $images as $img )
		                                            <a href="#" class="active">
		                                                <img src="{{ asset('public/files/product/'. $img) }}" alt="product desc">
		                                            </a>
	                                            @endforeach

	                                        </div><!-- End .product-nav -->
	                                    </div><!-- End .product-body -->
	                                </div><!-- End .product -->
	                            </div><!-- End .col-sm-6 col-lg-4 -->
	                        @endforeach

                        </div><!-- End .row -->
                    </div><!-- End .products -->

        			<nav aria-label="Page navigation">
					    <ul class="pagination justify-content-center">
					        {{ $brandwiseProduct->links() }}
					    </ul>
					</nav>
        		</div><!-- End .col-lg-9 -->
        		<aside class="col-lg-3 order-lg-first">
        			<div class="sidebar sidebar-shop">

        				<div class="widget widget-collapsible">
							<h3 class="widget-title">
							    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
							        Brand
							    </a>
							</h3><!-- End .widget-title -->

							<div class="collapse show" id="widget-1">
								<div class="widget-body">
									<div class="filter-items filter-items-count">

										@php
											$brands = DB::table('brands')->latest()->get();
										@endphp

										@foreach($brands as $row)
										@php
											$brandcount = DB::table('products')->where('brand_id', $row->id)->count();
										@endphp

											<div class="filter-item">
												<div class="custom-control custom-checkbox">
													<a href="{{ route('brandwise.product', $row->id) }}" class="text-dark">{{ $row->brand_name }}</a>
												</div>
												<span class="item-count">{{ $brandcount }}</span>
											</div>
										@endforeach
										
									</div><!-- End .filter-items -->
								</div><!-- End .widget-body -->
							</div><!-- End .collapse -->
						</div><!-- End .widget -->
						
        			</div><!-- End .sidebar sidebar-shop -->
        		</aside><!-- End .col-lg-3 -->
        	</div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->




@endsection
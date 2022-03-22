@extends('layouts.app')


@section('content')
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=620d45b249c8c1001914fea3&product=inline-share-buttons" async="async"></script>

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


@php
    $size = explode(',', $singleProduct->size);
    $color = explode(',', $singleProduct->color);
@endphp


<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>

            @php
            $childcategory = DB::table('childcategories')->where('id', $singleProduct->childcategory_id)->first();
            @endphp
                <li class="breadcrumb-item"><a href="#">{{ $childcategory->childcategory_name }}</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">

                <form action="{{ route('add.to.cart.quickview', $singleProduct->id) }}" method="post" id="addToCart-form">
                    @csrf

                    @if($singleProduct->discount_price)
                      <input type="hidden" name="price" value="{{ $singleProduct->discount_price }}">
                    @else
                     <input type="hidden" name="price" value="{{ $singleProduct->selling_price }}">
                    @endif

                    <div class="row">
                        <div class="col-md-5">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="row">
                                    <figure class="product-main-image">
                                        <img id="product-zoom" src="{{ asset($singleProduct->thumbnail) }}" data-zoom-image="{{ asset($singleProduct->thumbnail) }}" alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                    </figure><!-- End .product-main-image -->

                                    <div id="product-zoom-gallery" class="product-image-gallery">

                                    @php
                                    $smImage = json_decode($singleProduct->images, true);
                                    @endphp
                                        <a class="product-gallery-item active" href="#" data-image="{{ asset($singleProduct->thumbnail) }}" data-zoom-image="{{ asset($singleProduct->thumbnail) }}">
                                            <img src="{{ asset($singleProduct->thumbnail) }}" alt="product side">
                                        </a>
                                        @foreach($smImage as $img)
                                        <a class="product-gallery-item active" href="#" data-image="{{ asset('public/files/product/'.$img) }}" data-zoom-image="{{ asset('public/files/product/'.$img) }}">
                                            <img src="{{ asset('public/files/product/'.$img) }}" alt="product side">
                                        </a>
                                        @endforeach
                                        
                                    </div><!-- End .product-image-gallery -->
                                </div><!-- End .row -->
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->



@php
    $totalReview = DB::table('reviews')->where('product_id', $singleProduct->id)->count();
    $sum   = DB::table('reviews')->where('product_id', $singleProduct->id)->sum('rating');
@endphp
                        <div class="col-md-3">
                            <div class="product-details">
                                <h1 class="product-title">{{ substr($singleProduct->name, 0, 70) }}...</h1><!-- End .product-title -->

                                <div class="ratings-container">
                                    <div class="review">
                                        @if(intval($sum/5) == 5)
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                        @elseif( intval($sum/5) >= 4 && intval($sum/5) <5)
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                        @elseif( intval($sum/5) >= 3 && intval($sum/5) <4)
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                        @elseif( intval($sum/5) >= 2 && intval($sum/5) <3)
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                        @else
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                            <span ><i class="far fa-star"></i></span>
                                        @endif
                                        <span class="ratings-text">( {{ $totalReview }} Reviews )</span>
                                    </div>
                                </div><!-- End .rating-container -->

                                @if($singleProduct->discount_price)
                                    <div class="product-price">
                                        <small class="mr-2">
                                            <del class="text-danger"><small>{{ $setting->currency }}{{ $singleProduct->selling_price }}</small></del>
                                        </small>
                                        @isset($singleProduct->discount_price)
                                        {{ $setting->currency }}{{ $singleProduct->discount_price }}
                                        @endisset
                                    </div><!-- End .product-price -->
                                @else
                                    <div class="product-price">
                                        {{ $setting->currency }}{{ $singleProduct->selling_price }}
                                    </div><!-- End .product-price -->
                                @endif

                                <div class="product-content">
                                    <h6 class="text-primary"><small>Brand: </small>{{ $singleProduct->brand->brand_name }}</h6>
                                </div><!-- End .product-content -->

                                @isset($singleProduct->color)
                                <div class="details-filter-row details-row-size">
                                    <label for="color">Color:</label>
                                    <div class="select-custom">
                                        <select name="color" id="color" class="form-control">
                                            <option  selected="selected" disabled="">Select a Color</option>
                                            @foreach( $color as $color )
                                                <option value="{{ $color }}">{{ $color }}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- End .select-custom -->
                                </div><!-- End .details-filter-row -->
                                @endisset

                                @isset($singleProduct->size)
                                <div class="details-filter-row details-row-size">
                                    <label for="size">Size:</label>
                                    <div class="select-custom">
                                        <select name="size" id="size" class="form-control">
                                            <option disabled="" selected="selected">Select a size</option>
                                            @foreach( $size as $size )
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- End .select-custom -->
                                </div><!-- End .details-filter-row -->
                                @endisset

                                @if($singleProduct->stock_quantity == NULL || $singleProduct->stock_quantity == 0)
                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <strong class="text-danger">Out of Stock</strong>
                                        </div><!-- End .product-details-quantity -->
                                    </div><!-- End .details-filter-row --> 
                                @else
                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <strong class="text-success">Stock Available</strong>
                                    </div><!-- End .product-details-quantity -->
                                </div><!-- End .details-filter-row -->
                                @endif

                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" name="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->
                                </div><!-- End .details-filter-row -->

                                <div class="product-details-action">

                                    @if($singleProduct->stock_quantity < 1)
                                    <button type="submit" disabled="" class="btn-product btn-cart text-warning">
                                        <span>Not available</span>
                                    </button>
                                    @else
                                    <button type="submit" class="btn-product btn-cart">
                                        <span class="addcartBtn">Add to cart</span>
                                        <span class="procesing_btn d-none">Processing...</span>
                                    </button>
                                    @endif
                                    <!-- End .details-action-wrapper -->
                                </div><!-- End .product-details-action -->

                                <div class="product-details-btn">
                                    <a href="{{ route('add.whislist', $singleProduct->id) }}" class="btn-pro" title="Wishlist">Add to Wishlist</a>
                                    <a href="#" class="btn-pro" title="Compare">Add to Compare</a>
                                </div><!-- End .product-details-action -->

                                <div class="product-details-footer">

                                
                                    <div class="product-cat">
                                        <span>Category:</span>
                                            <a href="#">{{ $singleProduct->category->category_name }}</a>
                                    </div><!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <div class="sharethis-inline-share-buttons"></div>
                                        
                                    </div>
                                </div><!-- End .product-details-footer -->
                            </div><!-- End .product-details -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-4">
                            <div class="card bg-gray border p-2">
                                <div class="card-body">
                                    <div class="border-bottom">
                                        <span class="text-info">Pickup-point of this product</span>
                                        <h6 class="mt-1"><span class="mr-2"><i class="fa-solid fa-location-dot"></i></span>{{ $singleProduct->warehouse->warehouse_name }}</h6>
                                    </div>

                                    <div class="border-bottom mt-1">
                                        <span class="text-info">Home Delivery:</span>
                                        <p>-> (4-7) days after the order placed</p>
                                        <p>-> Case on delivery available</p>
                                    </div>

                                    <div class="border-bottom mt-1">
                                        <span class="text-info">Product Return &amp; Warenty:</span>
                                        <p>-> 7 day return guarrenty</p>
                                        <p>-> Warenty not available</p>
                                    </div>

                                    <div class=" mt-1">
                                        <span class="text-info">Product Video:</span>
                                        <p>
                                            <iframe width="340" height="260" src="https://www.youtube.com/embed/{{ $singleProduct->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .row -->
                </form>

            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ count($reviews) }})</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            {!! $singleProduct->description !!}
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>Delivery & returns</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                            We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                        <div class="reviews">
                            <h3>Reviews ({{ count($reviews) }})</h3>

                            <div class="review">
                                <form action="{{ route('store.review') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $singleProduct->id }}">
                                    <textarea name="review" class="form-control" placeholder="Type your reviews"></textarea>
                                    <select name="rating" class="form-control">
                                        <option disabled="" selected="">==Chosse Rating==</option>
                                        <option value="1">1Star</option>
                                        <option value="2">2Star</option>
                                        <option value="3">3Star</option>
                                        <option value="4">4Star</option>
                                        <option value="5">5Star</option>
                                    </select>
                                    @if(! Auth::check() )
                                        <p class="text-danger">At first login your account, then try to review.!</p>
                                    @else
                                        <button class="btn btn-info" type="submit">Submit</button>
                                    @endif
                                </form>
                            </div>

@php
    $proname = App\Models\Review::where('product_id', $singleProduct->id)->first();
    $ratingcount1 = App\Models\Review::where('product_id', $singleProduct->id)->where('rating', 1)->count();
    $ratingcount2 = App\Models\Review::where('product_id', $singleProduct->id)->where('rating', 2)->count();
    $ratingcount3 = App\Models\Review::where('product_id', $singleProduct->id)->where('rating', 3)->count();
    $ratingcount4 = App\Models\Review::where('product_id', $singleProduct->id)->where('rating', 4)->count();
    $ratingcount5 = App\Models\Review::where('product_id', $singleProduct->id)->where('rating', 5)->count();

    $totalRating = $ratingcount1+$ratingcount2+$ratingcount3+$ratingcount4+$ratingcount5;
    $avgRating = DB::table('reviews')->where('product_id', $singleProduct->id)->sum('rating');
@endphp
                        
                        @if($proname)
                            <div class="review">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Rating &amp; Review ({{ $proname->product->name }})</h3>

                                        <h2>{{ $avgRating/5 }}</h2>
                                        @if( intval($avgRating/5) == 5 )
                                        <div class="">
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                        </div>
                                        @elseif( intval($avgRating/5) >= 4 && intval($avgRating/5) <5)
                                        <div class="">
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                        </div>
                                        @elseif( intval($avgRating/5) >= 3 && intval($avgRating/5) <4)
                                        <div class="">
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                        </div>
                                        @elseif( intval($avgRating/5) >= 2 && intval($avgRating/5) <3)
                                        <div class="">
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                        </div>
                                        @else
                                        <div class="">
                                            <span class="text-warning h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                            <span class="h2"><i class="far fa-star"></i></span>
                                        </div>
                                        @endif

                                        <div class="">
                                            <p>Total Rating ({{ $totalRating }})</p>
                                        </div>
                                    </div>

                                     
                                    <div class="col">
                                        <div class="">
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span>Total: </span><strong>@isset( $ratingcount5 ) {{ $ratingcount5 }} @endisset</strong>
                                        </div>
                                        <div class="">
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <i class="far fa-star"></i>
                                            <span>Total: </span><strong>@isset( $ratingcount4 ) {{ $ratingcount4 }} @endisset</strong>
                                        </div>
                                        <div class="">
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span>Total: </span><strong>@isset( $ratingcount3 ) {{ $ratingcount3 }} @endisset</strong>
                                        </div>
                                        <div class="">
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span>Total: </span><strong>@isset( $ratingcount2 ) {{ $ratingcount2 }} @endisset</strong>
                                        </div>
                                        <div class="">
                                            <span class="text-warning"><i class="far fa-star"></i></span>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span>Total: </span><strong>{{ $ratingcount1 }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                        @endif

                            @foreach( $reviews as $row )

                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">{{ $row->user->name }}</a></h4>
                                        <div class="ratings-container">
                                            @if( $row->rating == 1)
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            @elseif( $row->rating == 2)
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            @elseif( $row->rating == 3)
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            @elseif( $row->rating == 4)
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <i class="far fa-star"></i>
                                            @elseif( $row->rating == 5)
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                                <span class="text-warning"><i class="far fa-star"></i></span>
                                            @endif
                                        </div>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>({{ $row->review_month }}) month reviewd this product.</h4>

                                        <div class="review-content">
                                            <p>{{ $row->review }}</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            Date: ({{ date($row->review_date, strtotime('d F, Y')) }}) 
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->
                            @endforeach

                        </div><!-- End .reviews -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

<div id="disqus_thread"></div>
<script>
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://abusayedmart.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<script id="dsq-count-scr" src="//abusayedmart.disqus.com/count.js" async></script>

            <h2 class="title text-center mb-4">Related Product</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>

                @foreach( $releatedProduct as $row )
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="{{ route('product.details', $row->slug) }}">
                            <img src="{{ asset($row->thumbnail) }}" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="{{ route('add.whislist', $row->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>

                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="{{ route('product.details', $row->slug) }}" class="btn-product"><span>View Product</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">{{ $row->subcategory->subcategory_name }}</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title">
                            <a href="{{ route('product.details', $row->slug) }}">{{ substr($row->name, 0, 30) }}...</a>
                        </h3><!-- End .product-title -->

                        @if($row->discount_price)
                            <div class="product-price">
                                <del class="text-danger"><small>{{ $setting->currency }} {{ $row->selling_price }}</small></del>
                                @isset($row->discount_price){{ $setting->currency }} {{ $row->discount_price }}@endisset
                            </div><!-- End .product-price -->
                        @else
                            <div class="product-price">
                                {{ $setting->currency }} {{ $row->selling_price }}
                            </div><!-- End .product-price -->
                        @endif

                    @php
                    $images = json_decode($row->images, true);
                    @endphp
                        <div class="product-nav product-nav-thumbs">
                            @foreach( $images as $img )
                            <a href="#" class="active">
                                <img src="{{ asset('public/files/product/'. $img ) }}" alt="product desc">
                            </a>
                            @endforeach
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
                @endforeach

            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-5" id="quickViewModal">

      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">
  $('#addToCart-form').submit(function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var req = $(this).serialize();

    $('.addcartBtn').addClass('d-none');
    $('.procesing_btn').removeClass('d-none');

    $.ajax({
        url: url,
        type: 'post',
        data: req,
        success: function (data) {
          $('.addcartBtn').removeClass('d-none');
          $('.procesing_btn').addClass('d-none');
          $('#addToCart-form')[0].reset();
          toastr.success(data);
          cart();
        }
      });
    
  });
</script>




@endsection
@extends('layouts.app')


@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

@include('layouts.frontend_partial.header')

<main class="main">
    <div class="intro-slider-container">
        <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                "nav": false,
                "responsive": {
                    "992": {
                        "nav": true
                    }
                }
            }'>

            @foreach( $slider_product as $row )
            <div class="intro-slide" style="background-image: url({{ $row->thumbnail }});">
                <div class="container intro-content">
                    <div class="row">
                        <div class="col-auto offset-lg-3 intro-col">
                            <h3 class="intro-subtitle">{{ $row->brand->brand_name }}</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title">{{ $row->name }}
                                <span>
                                    <sup class="font-weight-light line-through">{{ $setting->currency }}{{ $row->selling_price }}</sup>
                                    <span class="text-primary">{{ $setting->currency }}{{ $row->discount_price }}</span>
                                </span>
                            </h1><!-- End .intro-title -->

                            <a href="{{ route('product.details', $row->slug) }}" class="btn btn-outline-primary-2">
                                <span>Shop Now</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .col-auto offset-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container intro-content -->
            </div>
            @endforeach

        </div><!-- End .owl-carousel owl-simple -->

        <span class="slider-loader"></span><!-- End .slider-loader -->
    </div><!-- End .intro-slider-container -->

    <div class="mb-4"></div><!-- End .mb-2 -->

    @isset($campaignOne)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <strong class="mb-1">{{ $campaignOne->title }}</strong>
                    <img src="{{ asset($campaignOne->image) }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="mb-4"></div><!-- End .mb-2 -->
    @endisset

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @foreach($brand as $row)
                    <a href="{{ route('brandwise.product', $row->id) }}" class="d-inline-block border" title="{{ $row->brand_name }}">
                        <img class="img-fluid" src="{{ asset($row->brand_logo) }}" alt="{{ $row->brand_name }}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>


    <div class="mb-4"></div><!-- End .mb-2 -->

    <div class="container">
        <h2 class="title text-center mb-2">Explore Popular Categories</h2><!-- End .title -->

@php
 $category = DB::table('categories')->orderBy('category_name', 'ASC')->limit(6)->get();
@endphp
        <div class="cat-blocks-container">
            <div class="row">

                @foreach( $category as $row )
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="{{ route('nav.categorywise.product', $row->id) }}" class="cat-block">
                        <figure>
                            <span>
                                <img src="{{ asset($row->icon) }}" alt="{{ $row->icon }}">
                            </span>
                        </figure>

                        <h3 class="cat-block-title">{{ $row->category_name }}</h3><!-- End .cat-block-title -->
                    </a>
                </div><!-- End .col-sm-4 col-lg-2 -->
                @endforeach

            </div><!-- End .row -->
        </div><!-- End .cat-blocks-container -->
    </div><!-- End .container -->


    <div class="mb-3"></div><!-- End .mb-3 -->
    
    <div class="bg-light pt-3 pb-5">
        <div class="container">
            <div class="heading heading-flex heading-border mb-3">
                <div class="heading-left">
                    <h2 class="title">Featured Products</h2><!-- End .title -->
                </div><!-- End .heading-left -->

               <div class="heading-right">
                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="hot-all-link" data-toggle="tab" href="#hot-all-tab" role="tab" aria-controls="hot-all-tab" aria-selected="true">Featured Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="hot-elec-link" data-toggle="tab" href="#hot-elec-tab" role="tab" aria-controls="hot-elec-tab" aria-selected="false">Most Popular</a>
                        </li>
                    </ul>
               </div><!-- End .heading-right -->
            </div><!-- End .heading -->

            <div class="tab-content tab-content-carousel">
                <div class="tab-pane p-0 fade show active" id="hot-all-tab" role="tabpanel" aria-labelledby="hot-all-link">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
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
                                "1280": {
                                    "items":5,
                                    "nav": true
                                }
                            }
                        }'>

                        @foreach( $featured_product as $row )


@php
    $totalReview = DB::table('reviews')->where('product_id', $row->id)->count();
    $sum   = DB::table('reviews')->where('product_id', $row->id)->sum('rating');
@endphp
                            <div class="product">
                                <figure class="product-media">
                                    <span class="product-label label-sale">Sale</span>
                                    <a href="{{ route('product.details', $row->slug) }}">
                                        <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->thumbnail }}" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="{{ route('add.whislist', $row->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <a href="{{ route('quickView', $row->id) }}" id="quickViewBtn" data-toggle="modal" data-target="#exampleModal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">{{ $row->category->category_name }}</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title">
                                        <a href="{{ route('quickView', $row->id) }}" id="quickViewBtn" data-toggle="modal" data-target="#exampleModal">{{ substr($row->name, 0, 50) }}..</a>
                                    </h3><!-- End .product-title -->

                                    @if( $row->discount_price )
                                        <div class="product-price">
                                            <span class="new-price">
                                                @isset($row->discount_price)
                                                    {{ $setting->currency }}{{ $row->discount_price }}
                                                @endisset
                                            </span>
                                            <span class="old-price">
                                                @isset($row->selling_price)
                                                     <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                                @endisset
                                            </span>
                                        </div><!-- End .product-price -->
                                    @else
                                        <div class="product-price">
                                            @isset($row->discount_price)
                                            <span class="new-price">
                                                    {{ $setting->currency }}{{ $row->discount_price }}
                                            </span>
                                            @endisset
                                            <span class="old-price">
                                                @isset($row->selling_price)
                                                    <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                                @endisset
                                            </span>
                                        </div><!-- End .product-price -->
                                    @endif

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
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        @endforeach
                        
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="hot-elec-tab" role="tabpanel" aria-labelledby="hot-elec-link">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
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
                                "1280": {
                                    "items":5,
                                    "nav": true
                                }
                            }
                        }'>

                        @foreach( $popular_product as $row )
                        <div class="product">
                                <figure class="product-media">
                                    <span class="product-label label-sale">Sale</span>
                                    <a href="{{ route('product.details', $row->slug) }}">
                                        <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->thumbnail }}" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="{{ route('add.whislist', $row->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <a href="{{ route('quickView', $row->id) }}" id="quickViewBtn" data-toggle="modal" data-target="#exampleModal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">{{ $row->category->category_name }}</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title">
                                        <a href="{{ route('quickView', $row->id) }}" id="quickViewBtn" data-toggle="modal" data-target="#exampleModal">{{ substr($row->name, 0, 50) }}..</a>
                                    </h3><!-- End .product-title -->

                                    @if( $row->discount_price )
                                        <div class="product-price">
                                            <span class="new-price">
                                                @isset($row->discount_price)
                                                    {{ $setting->currency }}{{ $row->discount_price }}
                                                @endisset
                                            </span>
                                            <span class="old-price">
                                                @isset($row->selling_price)
                                                     <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                                @endisset
                                            </span>
                                        </div><!-- End .product-price -->
                                    @else
                                        <div class="product-price">
                                            @isset($row->discount_price)
                                            <span class="new-price">
                                                    {{ $setting->currency }}{{ $row->discount_price }}
                                            </span>
                                            @endisset
                                            <span class="old-price">
                                                @isset($row->selling_price)
                                                    <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                                @endisset
                                            </span>
                                        </div><!-- End .product-price -->
                                    @endif

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
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                
            </div><!-- End .tab-content -->
        </div><!-- End .container -->
    </div><!-- End .bg-light pt-5 pb-5 -->

    <div class="mb-3"></div><!-- End .mb-3 -->

    @isset($campaignTwo)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <strong class="mb-1">{{ $campaignTwo->title }}</strong>
                    <img src="{{ asset($campaignTwo->image) }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="mb-3"></div><!-- End .mb-2 -->
    @endisset



    <div class="container furniture">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">Trendy Product</h2><!-- End .title -->
            </div><!-- End .heading-left -->
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="furn-new-tab" role="tabpanel" aria-labelledby="furn-new-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
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
                            "1280": {
                                "items":5,
                                "nav": true
                            }
                        }
                    }'>

                    @foreach( $trendy_product as $row )
@php
    $totalReview = DB::table('reviews')->where('product_id', $row->id)->count();
    $sum   = DB::table('reviews')->where('product_id', $row->id)->sum('rating');
@endphp
                    <div class="product">
                        <figure class="product-media">
                            <span class="product-label label-sale">Sale</span>
                            <a href="{{ route('product.details', $row->slug) }}">
                                <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->thumbnail }}" class="product-image">
                            </a>

                            <div class="product-action-vertical">
                                <a href="{{ route('add.whislist', $row->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            </div><!-- End .product-action-vertical -->

                            <div class="product-action">
                                <a href="{{ route('quickView', $row->id) }}" id="quickViewBtn" data-toggle="modal" data-target="#exampleModal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#">{{ $row->category->category_name }}</a>
                            </div>
                            <!-- End .product-cat -->
                            <h3 class="product-title">
                                <a href="{{ route('quickView', $row->id) }}" id="quickViewBtn" data-toggle="modal" data-target="#exampleModal">{{ substr($row->name, 0, 50) }}..</a>
                            </h3><!-- End .product-title -->

                            @if( $row->discount_price )
                                <div class="product-price">
                                    <span class="new-price">
                                        @isset($row->discount_price)
                                            {{ $setting->currency }}{{ $row->discount_price }}
                                        @endisset
                                    </span>
                                    <span class="old-price">
                                        @isset($row->selling_price)
                                             <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                        @endisset
                                    </span>
                                </div><!-- End .product-price -->
                            @else
                                <div class="product-price">
                                    @isset($row->discount_price)
                                    <span class="new-price">
                                            {{ $setting->currency }}{{ $row->discount_price }}
                                    </span>
                                    @endisset
                                    <span class="old-price">
                                        @isset($row->selling_price)
                                            <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                        @endisset
                                    </span>
                                </div><!-- End .product-price -->
                            @endif

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
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
            
        </div><!-- End .tab-content -->
    </div><!-- End .container -->

    @foreach( $category as $row )

    @php
       $catByProduct = App\Models\Product::where('category_id', $row->id)->get();
    @endphp
    <div class="container furniture">
        <div class="heading heading-flex heading-border mb-3">
            <div class="heading-left">
                <h2 class="title">{{ $row->category_name }}</h2><!-- End .title -->
            </div><!-- End .heading-left -->

           <div class="heading-right">
                <ul class="nav nav-pills nav-border-anim justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#" >View All</a>
                    </li>
                </ul>
           </div><!-- End .heading-right -->
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active"  >
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
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
                            "1280": {
                                "items":5,
                                "nav": true
                            }
                        }
                    }'>

                    @foreach( $catByProduct as $row )

                    @php
                        $totalReview = DB::table('reviews')->where('product_id', $row->id)->count();
                        $sum   = DB::table('reviews')->where('product_id', $row->id)->sum('rating');
                    @endphp

                    <div class="product">
                        <figure class="product-media">
                            <span class="product-label label-new">New</span>
                            <a href="{{ route('product.details', $row->slug) }}">
                                <img src="{{ asset($row->thumbnail) }}" alt="{{ asset($row->thumbnail) }}" class="product-image">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                
                            </div><!-- End .product-action-vertical -->

                            <div class="product-action">
                                <a href="{{ route('quickView', $row->id) }}" id="quickViewBtn" data-toggle="modal" data-target="#exampleModal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#">{{ $row->childcategory->childcategory_name }}</a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title">
                                <a href="{{ route('product.details', $row->slug) }}">{{ substr($row->name, 0, 30) }}..</a>
                            </h3><!-- End .product-title -->

                            @if($row->discount_price)
                            <div class="product-price">
                                <small class="text-danger"><del>{{ $setting->currency }}{{ $row->selling_price }}</del></small>
                                {{ $setting->currency }}{{ $row->discount_price }}
                            </div>
                            @else
                            <div class="product-price">
                                {{ $setting->currency }}{{ $row->selling_price }}
                            </div>
                            @endif
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
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                    @endforeach
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->
    @endforeach

    <div class="mb-3"></div><!-- End .mb-3 -->



    {{-- Today Deal Section --}}

    <div class="container">
        <div class="heading text-center mb-3">
            <h2 class="title">Today Deals</h2>
        </div>

        <div class="row">
            @foreach( $today_deal as $row )
                <div class="col-lg-6 deal-col mb-2">
                    <div class="deal p-5" style="background-image: url('{{ asset($row->thumbnail) }}">
                        <div class="deal-top">
                            <h2>Deal of the Day.</h2>
                            <h4> 
                                @if( $row->stock_quantity <1 ) 
                                <span class="text-danger">out of limit</span> 
                                @else Limited quantities. @endif 
                            </h4>
                        </div><!-- End .deal-top -->

                        <div class="deal-content">
                            <h3 class="product-title">
                                <a href="{{ route('product.details', $row->slug) }}">{{ substr($row->name, 0, 50) }}..</a>
                            </h3>
                            <h3 class="product-title text-info">{{ $row->subcategory->subcategory_name }}</h3>

                            @if($row->discount_price)
                                <div class="product-price">
                                    <span class="new-price">{{$setting->currency}} {{$row->discount_price}}</span>
                                    <span class="old-price"><del>{{$setting->currency}} {{$row->selling_price}}</del></span>
                                </div>
                            @else 
                                <div class="product-price">
                                    <span class="old-price">{{$setting->currency}} {{$row->selling_price}}</span>
                                </div>
                            @endif

                            <a href="product.html" class="btn btn-link"><span>Shop Now</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .deal-content -->

                        <div class="deal-bottom">
                            <div class="deal-countdown daily-deal-countdown is-countdown" data-until="+10h"><span class="countdown-row countdown-show3"><span class="countdown-section"><span class="countdown-amount">09</span><span class="countdown-period">hours</span></span><span class="countdown-section"><span class="countdown-amount">59</span><span class="countdown-period">minutes</span></span><span class="countdown-section"><span class="countdown-amount">20</span><span class="countdown-period">seconds</span></span></span></div><!-- End .deal-countdown -->
                        </div><!-- End .deal-bottom -->
                    </div><!-- End .deal -->
                </div>
            @endforeach
        </div><!-- End .row -->
    </div>

    <div class="mb-4"></div>


    <div class="container">
        <h2 class="title title-border mb-5">Shop by Brands</h2><!-- End .title -->
        <div class="owl-carousel mb-5 owl-simple" data-toggle="owl" 
            data-owl-options='{
                "nav": false, 
                "dots": true,
                "margin": 30,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":2
                    },
                    "420": {
                        "items":3
                    },
                    "600": {
                        "items":4
                    },
                    "900": {
                        "items":5
                    },
                    "1024": {
                        "items":6
                    },
                    "1280": {
                        "items":6,
                        "nav": true,
                        "dots": false
                    }
                }
            }'>

            @foreach($brands as $row )
                <a title="{{ $row->brand_name }}" href="{{ route('brandwise.product', $row->id ) }}" class="brand">
                    <img src="{{ asset($row->brand_logo) }}" alt="Brand Name">
                </a>
            @endforeach
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->


    <div class="cta cta-horizontal cta-horizontal-box bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2xl-5col">
                    <h3 class="cta-title text-white">Join Our Newsletter</h3><!-- End .cta-title -->
                    <p class="cta-desc text-white">Subcribe to get information about products and coupons</p><!-- End .cta-desc -->
                </div><!-- End .col-lg-5 -->
                
                <div class="col-3xl-5col">
                    <form action="{{ route('store.newsletter') }}" method="post" id="add-form">
                        @csrf
                        <div class="input-group">
                            <input type="email" class="form-control form-control-white" placeholder="Enter your Email Address" name="email" id="email" required>

                            <div class="input-group-append">
                                <button class="btn btn-outline-white-2" type="submit">
                                    <span class="subscribe">Subscribe</span>
                                    <span class="spinner-border loader text-warning d-none"></span><i class="icon-long-arrow-right"></i>
                                </button>
                            </div><!-- .End .input-group-append -->
                        </div><!-- .End .input-group -->
                    </form>
                </div><!-- End .col-lg-7 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cta -->

    <div class="blog-posts bg-light pt-4 pb-7">
        <div class="container">
            <h2 class="title">Latest Reviews</h2><!-- End .title-lg text-center -->

            <div class="owl-carousel owl-simple" data-toggle="owl" 
                data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "items": 3,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "600": {
                            "items":2
                        },
                        "992": {
                            "items":3
                        },
                        "1280": {
                            "items":4,
                            "nav": true, 
                            "dots": false
                        }
                    }
                }'>

                @foreach( $web_review as $row )
                    <article class="entry" style="min-height: 574px;">
                        <figure class="entry-media">
                            <a href="#">
                                <img src="{{ asset('public/files') }}/avatar.png" alt="image desc">
                            </a>
                        </figure>

                        <div class="entry-body">
                            <div class="entry-meta">
                                <a href="#">{{ $row->date }}</a>

                                <span class="ml-3">
                                    @if($row->rating == 5)
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                    @elseif( $row->rating == 4 )
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span ><i class="far fa-star"></i></span>
                                    @elseif( $row->rating == 3 )
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span class="text-warning"><i class="far fa-star"></i></span>
                                        <span ><i class="far fa-star"></i></span>
                                        <span ><i class="far fa-star"></i></span>
                                    @elseif( $row->rating == 2)
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
                                </span>
                            </div>

                            <h3 class="entry-title">
                                <a href="#">{{ $row->name }}</a>
                            </h3>

                            <div class="entry-content">
                                <p>{{ substr($row->review, 0, 150) }}..</p>
                                <a href="#" class="read-more">Read More</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                @endforeach

            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .blog-posts -->

    <div class="icon-boxes-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon">
                            <i class="icon-rocket"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                            <p>Orders $50 or more</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->
                
                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon">
                            <i class="icon-rotate-left"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                            <p>Within 30 days</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon">
                            <i class="icon-info-circle"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
                            <p>When you sign up</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon">
                            <i class="icon-life-ring"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                            <p>24/7 amazing services</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .icon-boxes-container -->
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
    $('body').on('click', '#quickViewBtn', function(event) {
        event.preventDefault();

        var url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'get',
            success: function (data) {
                $('#quickViewModal').html(data);
            }
        });
        
    });


    //__Subscribe Form
    $('body').on('submit', '#add-form', function(event) {
        event.preventDefault();
        var url = $(this).attr('action');
        var req = $(this).serialize();

        $('.subscribe').addClass('d-none');
        $('.loader').removeClass('d-none');

        $.ajax({
            url: url,
            type: 'post',
            data: req,
            success: function (data) {
                $('.subscribe').removeClass('d-none');
                $('.loader').addClass('d-none');
                toastr.success(data);
                $('#add-form')[0].reset()

            }
        });


        
    });
</script>


@endsection
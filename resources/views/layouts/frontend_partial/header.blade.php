
<style>
    .cart_count {text-align: center;line-height: 17px;}
</style>

@php
    $settings = DB::table('settings')->first();
@endphp

<header class="header header-10 header-intro-clearance">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <a href="tel:{{ $settings->phone_one }}"><i class="icon-phone"></i>Call: +{{ $settings->phone_one }}</a>
            </div><!-- End .header-left -->

            <div class="header-right">

                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">Currency</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">Dollar ($)</a></li>
                                            <li><a href="#">Euro (€)</a></li>
                                            <li><a href="#">Ruppe (₹)</a></li>
                                            <li><a href="#">TK (৳)</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div><!-- End .header-dropdown -->
                            </li>
                            <li>   
                                <div class="header-dropdown">
                                    <a href="#">Language</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">Hindy</a></li>
                                            <li><a href="#">Latin</a></li>
                                            <li><a href="#">Bangla</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div><!-- End .header-dropdown -->
                            </li>
                            @if(! Auth::check() )
                            <li class="login">
                                <a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a>
                            </li>
                            @else 

                            <li>   
                                <div class="header-dropdown">
                                    <a href="#">{{ Auth::user()->name }}</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="{{ route('home') }}">Profile</a></li>
                                            <li><a href="#">Order List</a></li>
                                            <li><a href="#">Setting</a></li>
                                            <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div><!-- End .header-dropdown -->
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                
                <a href="{{ url('/') }}" class="logo" title="{{ url('/') }}">
                    <img src="{{ asset('public/frontend') }}/assets/images/demos/demo-13/logo.png" alt="Molla Logo" width="105" height="25">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <div class="select-custom">
                                <select id="cat" name="cat">
                                    <option value="">All Departments</option>
                                    <option value="1">Fashion</option>
                                    <option value="2">- Women</option>
                                    <option value="3">- Men</option>
                                    <option value="4">- Jewellery</option>
                                    <option value="5">- Kids Fashion</option>
                                    <option value="6">Electronics</option>
                                    <option value="7">- Smart TVs</option>
                                    <option value="8">- Cameras</option>
                                    <option value="9">- Games</option>
                                    <option value="10">Home &amp; Garden</option>
                                    <option value="11">Motors</option>
                                    <option value="12">- Cars and Trucks</option>
                                    <option value="15">- Boats</option>
                                    <option value="16">- Auto Tools &amp; Supplies</option>
                                </select>
                            </div><!-- End .select-custom -->
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div>

            <div class="header-right">
                <div class="header-dropdown-link">
                    <div class="dropdown compare-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">
                            <i class="icon-random"></i>
                            <span class="compare-txt">Compare</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="compare-products">
                                <li class="compare-product">
                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                    <h4 class="compare-product-title"><a href="product.html">Blue Night Dress</a></h4>
                                </li>
                                <li class="compare-product">
                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                    <h4 class="compare-product-title"><a href="product.html">White Long Skirt</a></h4>
                                </li>
                            </ul>

                            <div class="compare-actions">
                                <a href="#" class="action-link">Clear All</a>
                                <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i class="icon-long-arrow-right"></i></a>
                            </div>
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .compare-dropdown -->

                    @php
                        $whislist = DB::table('whislists')->where('user_id', Auth::id())->count();
                        $showwhislist = DB::table('whislists')->where('user_id', Auth::id())->first();
                    @endphp

                    @if(Auth::check())
                    @isset($showwhislist)
                    <a href="{{ route('index.whislist', $showwhislist->user_id) }}" class="wishlist-link">
                        <i class="icon-heart-o"></i>
                        <span class="wishlist-count">{{ $whislist }}</span>
                        <span class="wishlist-txt">Wishlist</span>
                    </a>
                    @endisset
                    @endif

                    <div class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count"> <span class="cart_count"></span> </span>
                            <span class="cart-txt">Cart</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">

                            <div class="dropdown-cart-total">
                                <span>Total</span>

                                <span class="cart-total-price">{{ $setting->currency }} <span class="cart_total"></span> </span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="{{ route('view.cart') }}" class="btn btn-primary">View Cart</a>
                                <a href="#" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .dropdown-cart-total -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .cart-dropdown -->
                </div>
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown show is-on" data-visible="true">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                        Browse Categories
                    </a>

                    <div class="dropdown-menu show">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                @php
                                $category    = DB::table('categories')->get();
                                @endphp
                                @foreach($category as $row)
                                    <li class="megamenu-container">
                                        <a class="sf-with-ul" href="{{ route('nav.categorywise.product', $row->id) }}">
                                            {{ $row->category_name }}
                                        </a>

                                        <div class="megamenu">
                                            <div class="row no-gutters">
                                                <div class="col-md-8">
                                                    <div class="menu-col">
                                                        <div class="row">

                                                    @php
                                                    $subcategory = DB::table('subcategories')->where('category_id', $row->id)->get();
                                                    @endphp
                                                            @foreach($subcategory as $subcat)

                                                            <div class="col-md-6">
                                                                <div class="menu-title">{{ $subcat->subcategory_name }}</div>

                                                                <ul>
                                                            @php
                                                            $childcategory = DB::table('childcategories')->where('subcategory_id', $subcat->id)->get();
                                                            @endphp

                                                                @foreach($childcategory as $childcat)
                                                                    <li>
                                                                        <a href="{{ route('childcategorywise.product', $childcat->id) }}">{{ $childcat->childcategory_name }}</a>
                                                                    </li>
                                                                 @endforeach
                                                                </ul>
                                                            </div><!-- End .col-md-6 -->

                                                            @endforeach

                                                        </div><!-- End .row -->
                                                    </div><!-- End .menu-col -->
                                                </div><!-- End .col-md-8 -->

                                            </div><!-- End .row -->
                                        </div><!-- End .megamenu -->
                                    </li>
                                @endforeach
                            </ul><!-- End .menu-vertical -->
                        </nav><!-- End .side-nav -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .category-dropdown -->
            </div><!-- End .col-lg-3 -->
            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        
                        
                        <li>
                            <a href="#" class="sf-with-ul">Pages</a>

                            <ul>
                                @foreach($pages as $row)
                                <li>
                                    <a href="#">{{ $row->page_name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="sf-with-ul">Blog</a>

                            <ul>
                                @php
                                $blog_cat = DB::table('blog_categories')->get();
                                @endphp

                                @foreach( $blog_cat as $row )
                                    <li>
                                        <a href="{{ route('blog.category.details', $row->id) }}">{{ $row->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}" class="sf-with-ul">Contact</a>
                        </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .col-lg-9 -->
            <div class="header-right">
                <i class="la la-lightbulb-o"></i><p>Clearance Up to 30% Off</span></p>
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
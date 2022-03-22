<header class="header header-10 header-intro-clearance">

    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a>
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
                            <span class="cart-count"> <span class="cart_count" style="line-height: 16px;text-align: center;"></span> </span>
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
</header><!-- End .header -->
<style>
    .app-navbar .sidebar-nav ul.metismenu li.after-none .has-arrow:after{display: none;}
</style>

<aside class="app-navbar">
    <div class="sidebar-nav scrollbar scroll_light">
        <ul class="metismenu " id="sidebarNav">
            <li class="active after-none">
                <a class="has-arrow" href="{{ route('admin.home') }}">
                    <span class="nav-title">Dashboards</span>
                </a>
            </li>

            @if(Auth::user()->category == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Category</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('category.index') }}'>Category</a> </li>
                    <li> <a href='{{ route('subcategory.index') }}'>Subcategory</a> </li>
                    <li> <a href='{{ route('childcategory.index') }}'>Childcategory</a> </li>
                    <li> <a href='{{ route('brand.index') }}'>Brand</a> </li>
                    <li> <a href='{{ route('warehouse.index') }}'>Warehouse</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->setting == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Setting</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('seo.setting.index') }}'>Seo Setting</a> </li>
                    <li> <a href='{{ route('smtp.setting.index') }}'>SMTP Setting</a> </li>
                    <li> <a href='{{ route('page.setting.index') }}'>Page Setting</a> </li>
                    <li> <a href='{{ route('website.setting') }}'>Website Setting</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->offer == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Offer</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('coupon.index') }}'>Coupon</a> </li>
                    <li> <a href='{{ route('campaign.index') }}'>E Campaign</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->pickup == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Pickup Point</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('pickuppoint.index') }}'>Pickup Point</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->product == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Product</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('create.product') }}'>New Product</a> </li>
                    <li> <a href='{{ route('index.product') }}'>Manage Product</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->ticket == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Ticket</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('index.ticket') }}'>Ticket</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->payment == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Payment Gateway</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('payment.gateway') }}'>Payment Gateway</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->order == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Orders</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('admin.order') }}'>Order</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->blog == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Blogs</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('blog.category') }}'>Blog Category</a> </li>
                    <li> <a href='{{ route('blog.details') }}'>Blog</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->contact == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Contact</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('admin.contact') }}'>Contact</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->report == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Reports</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('order.report') }}'>Order Report</a> </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->user_role == 1)
            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">User Role</span></a>
                <ul aria-expanded="false">
                    <li> <a href='{{ route('create.role') }}'>Create Role</a> </li>
                    <li> <a href='{{ route('manage.role') }}'>Manage Role</a> </li>
                </ul>
            </li>
            @endif


            <li class="after-none">
                <a class="has-arrow" href="javascript:void(0)"><strong>Profile</strong></a>
            </li>

            <li><a class="has-arrow" href="{{ route('password.change') }}" ><span class="nav-title">Password</span></a></li>
        </ul>
    </div>
</aside>
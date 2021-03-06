<header class="app-header top-bar">
    <!-- begin navbar -->
    <nav class="navbar navbar-expand-md">

        <!-- begin navbar-header -->
        <div class="navbar-header d-flex align-items-center">
            <a href="javascript:void:(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
            <a class="navbar-brand" href="{{ route('admin.home') }}">
                <img src="{{ asset('public/backend') }}/assets/img/logo.png" class="img-fluid logo-desktop" alt="logo" />
                <img src="{{ asset('public/backend') }}/assets/img/logo-icon.png" class="img-fluid logo-mobile" alt="logo" />
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ti ti-align-left"></i>
        </button>
        <!-- end navbar-header -->
        <!-- begin navigation -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <div class="navigation d-flex">
		        <ul class="navbar-nav nav-left">
		            <li class="nav-item">
		                <a href="javascript:void(0)" class="nav-link sidebar-toggle">
		                    <i class="ti ti-align-right"></i>
		                </a>
		            </li>
		            <li class="nav-item">
		                <a id="logout" class="nav-link" href="{{ route('admin.logout') }}">Logout</a>
		            </li>
		            <li class="nav-item full-screen d-none d-lg-block" id="btnFullscreen">
		                <a href="javascript:void(0)" class="nav-link expand">
		                    <i class="icon-size-fullscreen"></i>
		                </a>
		            </li>
		        </ul>
		        <ul class="navbar-nav nav-right ml-auto">
		            <li class="nav-item dropdown user-profile">
		            	<a href="javascript:void(0)" class="nav-link">{{ auth()->user()->name }}</a>
		            </li>

		            <li class="nav-item dropdown user-profile">

		                <a href="javascript:void(0)" class="nav-link dropdown-toggle " id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                    <img src="{{ asset('public/backend') }}/assets/img/avtar/02.jpg" alt="avtar-img">
		                    <span class="bg-success user-status"></span>
		                </a>
		                <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
		                    <div class="bg-gradient px-4 py-3">
		                        <div class="d-flex align-items-center justify-content-between">
		                            <div class="mr-1">
		                                <h4 class="text-white mb-0">{{ auth()->user()->name }}</h4>
		                                <small class="text-white">{{ auth()->user()->email }}</small>
		                            </div>
		                            <a id="logout" href="{{ route('admin.logout') }}" class="text-white font-20 tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout"> <i
		                                            class="zmdi zmdi-power"></i></a>
		                        </div>
		                    </div>
		                    <div class="p-4">
		                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
		                            <i class="fa fa-user pr-2 text-success"></i> Profile</a>
		                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
		                            <i class="fa fa-envelope pr-2 text-primary"></i> Inbox
		                            <span class="badge badge-primary ml-auto">6</span>
		                        </a>
		                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
		                            <i class=" ti ti-settings pr-2 text-info"></i> Settings
		                        </a>
		                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
		                            <i class="fa fa-compass pr-2 text-warning"></i> Need help?</a>
		                        
		                    </div>
		                </div>
		            </li>
		        </ul>
		    </div>
		</div>
		 <!-- end navigation -->
	</nav>
    <!-- end navbar -->
</header>
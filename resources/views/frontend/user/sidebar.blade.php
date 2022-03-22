<style>
	.profile-img img {
	    width: 150px;
	    height: 150px;
	    border: 2px solid #3444;
	    border-radius: 50%;
	}
</style>

<div class="card bg-light ">
    <div class="list-group-item list-group-item-dark">
       Welcome, <strong>{{ Auth::user()->name }}</strong>
    </div> 

    <div class="profile-img border-bottom justify-content-center d-flex p-5">
        <img src="@isset(Auth::user()->avatar){{ Auth::user()->avatar }} @else {{ asset('public/files') }}/avatar.png @endif" alt="">
    </div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mx-2 p-3 border-bottom">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fa fa-home mr-1" style="line-height: 25px;"></i> Dashboard</a>
        </li>
      </ol>
    </nav>
    
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mx-2 p-3 border-bottom">
        <li class="breadcrumb-item">
            <a href="{{ route('order') }}"><i class="fa fa-file mr-1" style="line-height: 25px;"></i> My Order</a>
        </li>
      </ol>
    </nav>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mx-2 p-3 border-bottom">
        <li class="breadcrumb-item">
            <a href="{{ route('customer.setting') }}"><i class="fa fa-cog mr-1" style="line-height: 25px;"></i> Settings</a>
        </li>
      </ol>
    </nav>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mx-2 p-3 border-bottom">
        <li class="breadcrumb-item">
            <a href="{{ route('open.ticket') }}"><i class="fa fa-external-link mr-1" style="line-height: 25px;"></i> Open Ticket</a>
        </li>
      </ol>
    </nav>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mx-2 p-3">
        <li class="breadcrumb-item">
            <a href=""><i class="fa fa-sign-out-alt mr-1" style="line-height: 25px;"></i> Logout</a>
        </li>
      </ol>
    </nav>
</div>
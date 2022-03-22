@extends('layouts.app')


@section('content')


@include('frontend.user.middle_header')



<main class="main">
	<div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')  }}/assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title"> {{ $page->page_name }}</h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page->page_name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
        	<div class="row justify-content-center">
        		<div class="col-lg-8">
        			<h4 class="text-center mb-3 p-2">{{ $page->page_title }}</h4>
        			<p>{!! $page->page_description !!}</p>
        		</div>
        	</div>
        </div>
    </div>
    <hr>
</main><!-- End .main -->




@endsection
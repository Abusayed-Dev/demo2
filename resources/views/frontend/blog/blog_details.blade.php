@extends('layouts.app')


@section('content')
@include('frontend.user.middle_header')


<main class="main">
	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title">{{ $blogCat->category_name }}</h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $blogCat->category_name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
        	<div class="row">
        		<div class="col-lg-9">

        			@foreach( $blog as $row )
	                    <article class="entry">
	                        <figure class="entry-media">
	                            <a href="#">
	                                <img src="{{ asset($row->thumbnail) }}" alt="image desc">
	                            </a>
	                        </figure><!-- End .entry-media -->

	                        <div class="entry-body">
	                            <div class="entry-meta">
	                                <span class="entry-author">
	                                    by <a href="#">John Doe</a>
	                                </span>
	                                <span class="meta-separator">|</span>
	                                <a href="#">{{ $row->publish_date }}</a>
	                                <span class="meta-separator">|</span>
	                            </div><!-- End .entry-meta -->

	                            <h2 class="entry-title">
	                                <a href="#">{{ $row->title }}</a>
	                            </h2><!-- End .entry-title -->

	                            <div class="entry-content">
	                                {!! $row->description !!}
	                            </div><!-- End .entry-content -->
	                        </div><!-- End .entry-body -->
	                    </article><!-- End .entry -->
                    @endforeach

        			<nav aria-label="Page navigation">
					    <ul class="pagination">
					        {{ $blog->links() }}
					    </ul>
					</nav>
        		</div><!-- End .col-lg-9 -->

        		<aside class="col-lg-3">
        			<div class="sidebar">

                        <div class="widget widget-cats">
                            <h3 class="widget-title">Categories</h3><!-- End .widget-title -->

                            <ul>
                            	@php
                                $cat = DB::table('blog_categories')->get();
                                @endphp
                                @foreach($cat as $row)
                                @php
                                $blog_count = DB::table('blog')->where('blog_category_id', $row->id)->count();
                                @endphp
                               		<li><a href="{{ route('blog.category.details', $row->id) }}">{{ $row->category_name }}<span>{{ $blog_count }}</span></a></li>
                                @endforeach
                            </ul>
                        </div><!-- End .widget -->

                        @php
                        $campaign1 = DB::table('campaigns')->first();
                        $campaign2 = DB::table('campaigns')->skip(1)->first();
                        @endphp
                        <div class="widget widget-banner-sidebar">
                            <div class="banner-sidebar-title">{{ $campaign2->title }}</div><!-- End .ad-title -->
                            
                            <div class="banner-sidebar banner-overlay">
                                <a href="#">
                                    <img src="{{ asset($campaign2->image) }}" alt="banner">
                                </a>
                            </div><!-- End .banner-ad -->
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">Browse Tags</h3><!-- End .widget-title -->

                            <div class="tagcloud">
                            	@php
                            		$blogs = DB::table('blog')->get();
                            	@endphp
                            	@foreach( $blogs as $row )
                            	@php
                            		$tags = explode(',', $row->tag);
                            	@endphp
                            		@foreach($tags as $tag) 
                                		<a href="#">{{$tag}}</a> 
                                	@endforeach
                                @endforeach
                            </div><!-- End .tagcloud -->
                        </div><!-- End .widget -->

                        <div class="widget widget-text">
                            <h3 class="widget-title">About Blog</h3><!-- End .widget-title -->

                            <div class="widget-text-content">
                                <p>Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, pulvinar nunc sapien ornare nisl.</p>
                            </div><!-- End .widget-text-content -->
                        </div><!-- End .widget -->
        			</div><!-- End .sidebar -->
        		</aside><!-- End .col-lg-3 -->
        	</div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->



@endsection
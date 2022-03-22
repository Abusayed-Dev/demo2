@extends('layouts.app')


@section('content')

@include('frontend.user.middle_header')

<main class="main">
	<div class="page-header text-center" style="background-image: url('{{asset('public/frontend')}}/assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title">Contact Us </h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
    	<div class=" mb-5">
    		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28776.10661533052!2d88.6439936!3d25.637683199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fb52afd8ffffff%3A0x7de022e3f2abfb25!2sBaitul%20Mamur%20Mosque!5e0!3m2!1sen!2sbd!4v1646579283205!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    	</div><!-- End #map -->
        <div class="container">
        	<div class="row">
        		<div class="col-md-4">
        			<div class="contact-box text-center">
						<h3>Office</h3>

						<address>{{ $setting->address }}, <br>NY 10004, Thakurgaon</address>
					</div><!-- End .contact-box -->
        		</div><!-- End .col-md-4 -->

        		<div class="col-md-4">
        			<div class="contact-box text-center">
						<h3>Start a Conversation</h3>

						<div><a href="mailto:{{ $setting->support_email }}">{{ $setting->support_email }}</a></div>
						<div><a href="tel:#">+1 987-876-6543</a>, <a href="tel:#">+1 987-976-1234</a></div>
					</div><!-- End .contact-box -->
        		</div><!-- End .col-md-4 -->

        		<div class="col-md-4">
        			<div class="contact-box text-center">
						<h3>Social</h3>

						<div class="social-icons social-icons-color justify-content-center">
	    					<a href="{{ $setting->facebook }}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
	    					<a href="{{ $setting->twitter }}" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
	    					<a href="{{ $setting->instagram }}" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
	    					<a href="{{ $setting->youtube }}" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
	    					<a href="{{ $setting->pinterest }}" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
	    				</div><!-- End .soial-icons -->
					</div><!-- End .contact-box -->
        		</div><!-- End .col-md-4 -->
        	</div><!-- End .row -->

        	<hr class="mt-3 mb-5 mt-md-1">
        	<div class="touch-container row justify-content-center">
        		<div class="col-md-9 col-lg-7">
        			<div class="text-center">
        			<h2 class="title mb-1">Get In Touch</h2><!-- End .title mb-2 -->
        			<p class="mb-3">Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p>
        			</div><!-- End .text-center -->

        			<form action="{{ route('store.contact') }}" method="post" id="add-form" class="contact-form mb-2">
        				@csrf

        				<div class="row">
        					<div class="col-sm-4">
                                <label for="name" class="sr-only">Name</label>
        						<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name *" required>

        						@error('name')
								    <strong class="text-danger">{{ $message }}</strong>
								@enderror
        					</div><!-- End .col-sm-4 -->

        					<div class="col-sm-4">
                                <label for="email" class="sr-only">Email</label>
        						<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email *" required>

        						@error('email')
								    <strong class="text-danger">{{ $message }}</strong>
								@enderror
        					</div><!-- End .col-sm-4 -->

        					<div class="col-sm-4">
                                <label for="phone" class="sr-only">Phone</label>
        						<input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone">
        					</div><!-- End .col-sm-4 -->
        				</div><!-- End .row -->

                        <label for="subject" class="sr-only">Subject</label>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">

                        <label for="message" class="sr-only">Message</label>
        				<textarea class="form-control @error('message') is-invalid @enderror" name="message" cols="30" rows="4" id="message" placeholder="Message *"></textarea>

						@error('message')
						    <strong class="text-danger">{{ $message }}</strong>
						@enderror
						
						<div class="text-center">
            				<button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
            					<span>SUBMIT</span>
        						<i class="icon-long-arrow-right"></i>
            				</button>
        				</div><!-- End .text-center -->
        			</form><!-- End .contact-form -->
        		</div><!-- End .col-md-9 col-lg-7 -->
        	</div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	
 $('#add-form').submit(function(event) {
 	event.preventDefault();
 	var req = $(this).serialize();
 	var url = $(this).attr('action');
 	
 	$.ajax({
		url: url,
		type: 'post',
		data: req,
		success: function (data) {
			toastr.success(data);
			$('#add-form')[0].reset();
		}
	});

 });


</script>


@endsection


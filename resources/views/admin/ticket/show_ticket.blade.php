@extends('layouts.admin')


@section('title', 'Show Ticket Page')


@section('admin_content')

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Ticket Message Reply</h1>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
            	<strong class="p-2 text-dark">Subject: {{ $ticket->subject }}</strong><br>
            	<strong class="p-2 text-dark">Service: {{ $ticket->service }}</strong><br>
            	<strong class="p-2 text-dark">Priority: {{ $ticket->priority }}</strong><br>
            	<strong class="p-2 text-dark">Message: {{ $ticket->message }}</strong>
            </div>

            <div class="col-md-4">
            	<a href="{{asset($ticket->image)}}" title="Message Image"><img src="{{asset($ticket->image)}}" alt="" height="100px" width="150px"></a>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
		            <div class="card-body">
	                 	<div class="list-group-item list-group-item-info">
			                <strong class="text-dark">Reply Ticket </strong>
			            </div>
		            	<form action="{{ route('admin.reply.ticket', $ticket->id) }}" method="post" enctype="multipart/form-data" class="pt-3">
		            		@csrf
			            	<div class="form-group">
			            		<label>Messege <strong class="text-danger">*</strong></label>
		            			<textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Your experienced type here..."></textarea>

		            			@error('message')
								    <strong class="text-danger">{{ $message }}</strong>
								@enderror
		            		</div>

			            	<div class="form-group">
			            		<label>Image </label>
		            			<input class="form-control" type="file" name="image">
		            		</div>

		            		<button type="submit" class="btn btn-danger">Reply Ticket</button>
		            		<a href="{{ route('close.ticket', $ticket->id) }}" class="btn btn-danger">Close Ticket</a>
		            	</form>
		            </div>
                 </div>
            </div>

			@php
            	$replies = DB::table('replies')->where('ticket_id', $ticket->id)->latest()->get();
            @endphp
            
        	<div class="col-md-6 scroll-y p-3">

        		<div class="card">
        			<div class="list-group-item list-group-item-info">
				      	<i class="fa fa-user"></i> <strong class="p-2">All Replies</strong>
				    </div>
				@isset($replies)
    			@foreach( $replies as $row )
	        		<div class="card w-75 p-3 @if($row->user_id == 0) ml-5 @endif">
				      <div class="list-group-item @if($row->user_id == 0) list-group-item-danger @else list-group-item-info @endif ">
				      	<i class="fa fa-user"></i> <strong class="text-white p-2">@if($row->user_id == 0) Admin @else {{ $ticket->name }} @endif </strong>
				      </div>
				      <div class="card-body">
				        <blockquote class="blockquote">
						  <p class="mb-0">{{ $row->message }}</p>
						  <footer class="blockquote-footer">{{ date('d F , Y', strtotime($row->date)) }}</footer>
						</blockquote>
				      </div>
				    </div>
				@endforeach
				@endisset
        		</div>
			    
			</div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>




@endsection

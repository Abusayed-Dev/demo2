@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>


<style>
	.btn{min-width: auto;}
	.scroll-y {
	  background-color: lightskyblue;
	  height: 500px;
	  overflow-y: scroll;
	}
</style>
@include('frontend.user.middle_header')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            @include('frontend.user.sidebar')
        </div>

        <div class="col-lg-8">
            <div class="card bg-light mb-2">
              <div class="list-group-item list-group-item-dark">
                <span>Reply Ticket </span>
              </div>
            </div>

	        <strong class="px-2">Your Ticket Details </strong>

            <div class="row">
	            <div class="col-md-8">
	            	<strong class="p-2 text-dark">Subject: {{ $ticket->subject }}</strong><br>
	            	<strong class="p-2 text-dark">Service: {{ $ticket->service }}</strong><br>
	            	<strong class="p-2 text-dark">Priority: {{ $ticket->priority }}</strong><br>
	            	<strong class="p-2 text-dark">Message: {{ $ticket->message }}</strong>
	            </div>

	            <div class="col-md-4">
	            	<a href="{{asset($ticket->image)}}" title="Message Image"><img src="{{asset($ticket->image)}}" alt="" height="120px" width="200px"></a>
	            </div>
            </div>

            @php
            	$replies = DB::table('replies')->where('ticket_id', $ticket->id)->get();
            @endphp
            <div class="row mt-3">
            	<strong class="p-2">All Replies</strong>
            	<div class="col-sm-12 scroll-y p-3">

            		@isset( $replies )
	            		@foreach( $replies as $row )
					    <div class="card w-75 @if($row->user_id == 0) ml-5 @endif">
					      <div class="list-group-item  font-weight-bold @if($row->user_id == 0) list-group-item-danger @else list-group-item-primary @endif">
					      	<i class="fa fa-user"></i> @if($row->user_id == 0) Admin @else {{ Auth::user()->name }} @endif
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

            <div class="card bg-light mt-3 p-3">
                 <div class="card">
		            <div class="card-body">
	                 	<div class="list-group-item list-group-item-primary">
			                <strong>Reply Ticket </strong>
			            </div>
		            	<form action="{{ route('reply.ticket', $ticket->id) }}" method="post" enctype="multipart/form-data" class="pt-3">
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

		            		<button type="submit" class="btn btn-danger">Replay Ticket</button>

		            	</form>
		            </div>
                 </div>
            </div>
        </div>
    </div>
</div>



@endsection

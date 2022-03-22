@extends('layouts.admin')


@section('title', 'Dynamic Page')


@section('admin_content')

<div class="app-main p-5" id="main" style="margin-top: 100px;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="card p-3">
					<div class="card-title">Page Create</div>
					<div class="card-body">
					    <form action="{{ route('store.page.setting') }}" method="POST">
					    	@csrf
					        <div class="form-group">
					            <label for="page_name">Page Name</label>
					            <input type="text" class="form-control @error('page_name') is-invalid @enderror" id="page_name" name="page_name" required="">

					            @error('page_name')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
					        </div>

					        <div class="form-group">
					            <label for="page_title">Page Title</label>
					            <input type="text" class="form-control @error('page_title') is-invalid @enderror" id="page_title" name="page_title" required="">

					            @error('page_title')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
					        </div>

					        <div class="form-group">
					            <label for="front_page">Page Position</label>
					            <select name="page_position" id="page_position" class="form-control" required="">
					            	<option value="1">Line One</option>
					            	<option value="2">Line Two</option>
					            </select>
					        </div>

					        <div class="form-group">
					            <label for="page_description">Page Description</label>
					            <textarea name="page_description" id="summernote" class="form-control summernote"></textarea>

					            @error('page_description')
							    	<strong class="text-danger">{{ $message }}</strong>
								@enderror
					        </div>
						    <div class="form-group">
						        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-primary">Add</button>
						    </div>
					  	</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
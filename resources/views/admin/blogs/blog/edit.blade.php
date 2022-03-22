
{{-- Dropify --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

{{-- summernote --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>

<form action="{{ route('update.blog', $blog->id) }}" method="POST" enctype="multipart/form-data">
    	@csrf
        <div class="form-group">
            <label>Category</label>
            <select name="blog_category_id" class="form-control">
            	<option selected disabled>==Choosse One==</option>
            	@foreach($category as $row)
            		<option @if($blog->blog_category_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->category_name }}</option>
            	@endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description"  class="form-control summernote" placeholder="Type description..">
            	{!! $blog->description !!}
            </textarea>
        </div>

        <div class="row">
        	<div class="form-group col-md-6">
                <label>Tag</label>
                <input type="text" name="tag" class="form-control" value="{{ $blog->tag }}">
            </div>
        	<div class="form-group col-md-6">
                <label>Status</label>
                <select name="status" class="form-control">
                	<option @if($blog->status == 0) selected @endif value="0">Deactive</option>
                	<option @if($blog->status == 1) selected @endif value="1">Active</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Thumbnail</label><br>
            <img src="{{ asset($blog->thumbnail) }}" alt="" height="100px" width="150px"><br>
            <input type="file" name="thumbnail" class="form-control dropify"  data-height="100">
        </div>

        <input type="hidden" name="old_thumbnail" value="{{ $blog->thumbnail }}">
        
	    <div class="form-group">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add</button>
	    </div>
</form>

<script type="text/javascript">
	//summernote
	$(document).ready(function() {
	  $('.summernote').summernote();
	});

	$('.dropify').dropify();
</script>
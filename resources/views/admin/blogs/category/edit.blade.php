<form action="{{ route('update.blog.category', $category->id) }}" method="POST">
	@csrf
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" class="form-control  @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ $category->category_name }}">

        @error('category_name')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
    </div>
    
    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>
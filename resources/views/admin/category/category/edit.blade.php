<form action="{{ route('update.category', $category->id) }}" method="POST" enctype="multipart/form-data" id="edit-from">
	@csrf
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}">
    </div>
    <div class="form-group">
    	<img src="{{ asset($category->icon) }}" alt="" class="img-fluid"><br>
        <label>Icon</label>
        <input type="file" data-height="150" class="form-control dropify" id="icon" name="icon">
        <input type="hidden" name="oldicon" value="{{ asset($category->icon) }}">

    </div>
    <div class="form-group">
        <label>Homepage</label>
        <select name="home_page" id="home_page" class="form-control">
        	<option disabled="" selected="">==Choose one==</option>
        	<option @if($category->home_page == 0) selected @endif value="0">Deactive</option>
        	<option @if($category->home_page == 1) selected @endif  value="1">Active</option>
        </select>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

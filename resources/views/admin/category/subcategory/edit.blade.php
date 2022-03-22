<form action="{{ route('update.subcategory', $subcategory->id) }}" method="POST">
	@csrf
    <div class="form-group">
        <label for="category_id">Subcategory</label>

        @php
        	$category = DB::table('categories')->get();
        @endphp

        <select name="category_id" id="category_id" class="form-control">
        	<option disabled="" selected="">==Chosse One==</option>
        	@foreach($category as $row)
        		<option @if($row->id == $subcategory->category_id) selected="" @endif value="{{ $row->id }}">{{ $row->category_name }}</option>
        	@endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="subcategory_name">Sub-Category Name</label>
        <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="{{ $subcategory->subcategory_name }}" required="">
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
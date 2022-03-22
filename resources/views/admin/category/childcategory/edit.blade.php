<form action="{{ route('update.childcategory', $data->id) }}" method="POST">
	@csrf
    <div class="form-group">
        <label for="category_id">Category-Subcategory</label>

        <select name="subcategory_id" id="subcategory_id" class="form-control">
        	@foreach($category as $row)

        	@php
        		$subcat = DB::table('subcategories')->where('category_id', $row->id)->get();
        	@endphp

        		<option class="text-danger" disabled="" value="{{ $row->id }}">{{ $row->category_name }}</option>

        		@foreach($subcat as $row)
        			<option @if($data->subcategory_id == $row->id) selected="" @endif value="{{ $row->id }}">-- {{ $row->subcategory_name }}</option>
        		@endforeach
        	@endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="childcategory_name">Child-Category Name</label>
        <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" value="{{ $data->childcategory_name }}" required="">
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
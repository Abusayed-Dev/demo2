<form action="{{ route('update.warehouse', $data->id) }}" method="POST" id="edit-form">
	@csrf
    <div class="form-group">
        <label for="warehouse_name">Warehouse Name</label>
        <input type="text" class="form-control  @error('warehouse_name') is-invalid @enderror" id="warehouse_name" name="warehouse_name" value="{{ $data->warehouse_name }}">

        @error('warehouse_name')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
    </div>
    <div class="form-group">
        <label for="warehouse_address">Warehouse Address</label>
        <input type="text" class="form-control  @error('warehouse_address') is-invalid @enderror" id="warehouse_address" name="warehouse_address" value="{{ $data->warehouse_address }}">

        @error('warehouse_address')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
    </div>
    <div class="form-group">
        <label for="warehouse_phone">Warehouse Phone</label>
        <input type="text" class="form-control  @error('warehouse_phone') is-invalid @enderror" id="warehouse_phone" name="warehouse_phone" value="{{ $data->warehouse_phone }}">

        @error('warehouse_phone')
	    	<strong class="text-danger">{{ $message }}</strong>
		@enderror
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class=" btn btn-primary"><span class="add-btn d-none">loading...</span>Update</button>
    </div>
</form>

<script type="text/javascript">
	//__insert data by ajax
	$('body').on('submit', '#edit-form', function (e) {
		e.preventDefault();
		var url = $(this).attr('action');
		var req = $(this).serialize();

		$('.add-btn').removeClass('d-none');
		$.ajax({
			url: url,
			type: 'post',
			data: req,
			success: function (data) {
				$('.add-btn').addClass('d-none');
				$('#editModal').modal('hide');
				toastr.success(data);
				table.ajax.reload();
			}
		});
	});
</script>
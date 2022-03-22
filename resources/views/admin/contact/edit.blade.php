<form action="{{ route('reply.message') }}" method="POST">
	@csrf

	<div class="table-responsive" style="overflow:hidden;">
        <table id="myTable" class="table table-sm mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ substr($contact->message, 0, 100) }}..</td>
                </tr>
            </tbody>
        </table>
    </div>


    <input type="hidden" name="contact_id" value="{{ $contact->id }}">
	<div class="form-group">
	    <label>Message</label>
	    <textarea name="message"  class="form-control" placeholder="Reply Message.." required></textarea>
	</div>

	<div class="form-group">
	    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	    <button type="submit" class="btn btn-primary">Reply</button>
	</div>
</form>
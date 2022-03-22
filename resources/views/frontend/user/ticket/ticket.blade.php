@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

{{-- dataTable --}}
<link rel="stylesheet" href="{{ asset('public/frontend/dataTable') }}/jquery.dataTables.min.css"/>
<script type="text/javascript" src="{{ asset('public/frontend/dataTable') }}/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ asset('public/frontend/dataTable') }}/jquery.dataTables.min.js"></script>

<style>.btn{min-width: auto;}</style>
@include('frontend.user.middle_header')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            @include('frontend.user.sidebar')
        </div>

        <div class="col-lg-8">
            <div class="card bg-light mb-2">
              <div class="list-group-item list-group-item-dark">
                <span>All Tickets </span>
                <a href="{{ route('new.ticket') }}" class="float-right btn btn-danger">New Ticket</a>
              </div>
            </div>

            <div class="card bg-light mt-3 p-3">
                <table class="table table-striped" id="myTable">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Service</th>
                      <th>Subject</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($ticket as $row)
                    <tr>
                      <td>{{ $row->date }}</td>
                      <td>{{ $row->service }}</td>
                      <td>{{ $row->subject }}</td>
                      <td>
                        @if($row->status == 0)
                            <strong class="badge badge-danger">Pending</strong>
                        @elseif($row->status == 1)
                            <strong class="badge badge-success">Replied</strong>
                        @elseif($row->status == 2)
                            <strong class="badge badge-primary">Closed</strong>
                        @endif
                      </td>
                      <td>
                      	<a href="{{ route('show.ticket', $row->id) }}" class="btn btn-sm btn-info " style="min-width: auto;" title="View Order"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#myTable').DataTable();
</script>

@endsection

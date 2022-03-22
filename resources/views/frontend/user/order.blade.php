@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

{{-- dataTable --}}
<link rel="stylesheet" href="{{ asset('public/frontend/dataTable') }}/jquery.dataTables.min.css"/>
<script type="text/javascript" src="{{ asset('public/frontend/dataTable') }}/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ asset('public/frontend/dataTable') }}/jquery.dataTables.min.js"></script>


@include('frontend.user.middle_header')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            @include('frontend.user.sidebar')
        </div>

        <div class="col-lg-8">
            <div class="card bg-light mb-2">
              <div class="list-group-item list-group-item-dark">
                <span>Dashboard </span>
                <a href="{{ route('write.review') }}" class="float-right text-danger">Write a review</a>
              </div>
            </div>

            <div class="card bg-light mt-3 p-3">
                <table class="table table-striped" id="myTable">
                  <strong class="text-info">My Order</strong>
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Date</th>
                      <th>Total</th>
                      <th>Payment Type</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($order as $row)
                    <tr>
                      <td class="font-weight-bold">{{ $row->order_id }}</td>
                      <td>{{ $row->date }}</td>
                      <td>{{ $setting->currency }} {{ $row->total }}</td>
                      <td>{{ $row->payment_type }}</td>
                      <td>
                        @if($row->status == 0)
                            <strong class="badge badge-danger">Order Pending</strong>
                        @elseif($row->status == 1)
                            <strong class="badge badge-info">Order Recevied</strong>
                        @elseif($row->status == 2)
                            <strong class="badge badge-primary">Order Shipped</strong>
                        @elseif($row->status == 3)
                            <strong class="badge badge-success">Order Delivered</strong>
                        @elseif($row->status == 4)
                            <strong class="badge badge-warning">Order Return</strong>
                        @elseif($row->status == 5)
                            <strong class="badge badge-danger">Order Cancel</strong>
                        @endif
                      </td>
                      <td>
                      	<a href="{{ route('order.details', $row->id) }}" class="btn btn-sm btn-info " style="min-width: auto;" title="View Order"><i class="fa fa-eye"></i></a>
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

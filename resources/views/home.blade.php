@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

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
              <div class="card-body mt-2">
                <div class="row text-center">
                    <div class="col-lg-3">
                        <div class="card p-4 bg-light">
                            <strong class="text-info">Total Order</strong>
                            <span class="text-info h6">{{ $total_order }}</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card p-4 bg-light">
                            <strong class="text-success">Complete Order</strong>
                            <span class="text-info h6">{{ $complete_order }}</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card p-4 bg-light">
                            <strong class="text-danger">Cancel Order</strong>
                            <span class="text-info h6">{{ $complete_order }}</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card p-4 bg-light">
                            <strong class="text-warning">Return Order</strong>
                            <span class="text-info h6">{{ $cancel_order }}</span>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="card bg-light mt-3 p-3">
                <table class="table">
                  <strong class="text-info">Recent Order</strong>
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Date</th>
                      <th>Total</th>
                      <th>Payment Type</th>
                      <th>Status</th>
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
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>

@endsection

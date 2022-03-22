@extends('layouts.admin')

@section('admin_content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">


@php
    $customer     = DB::table('users')->where('is_admin', '!=', 1)->orWhere('is_admin', Null)->take(7)->get();
    $latest_order = DB::table('orders')->orderBy('id', 'DESC')->take(10)->get();
    $most_view    = DB::table('products')->orderBy('product_view', 'DESC')->take(10)->get();
    $product      = DB::table('products')->count();
    $deactive_product = DB::table('products')->where('status', 'off')->count();
    $active_product = DB::table('products')->where('status', 'on')->count();
    $customers = DB::table('users')->where('is_admin', '!=', 1)->orWhere('is_admin', Null)->count();
    $category  = DB::table('categories')->count();
    $brands    = DB::table('brands')->count();
    $ticket    = DB::table('tickets')->count();
    $reviews   = DB::table('reviews')->count();
    $coupons   = DB::table('coupons')->count();
    $subscriber= DB::table('newsletter')->count();
    $pending_order = DB::table('orders')->where('status', 0)->count();
    $success_order = DB::table('orders')->where('status', 3)->count();
@endphp

        <!-- begin row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-statistics">
                    <div class="row">
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-lg-right border-bottom border-xxl-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-danger" style="font-size:50px"><i class="fas fa-parking"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i> {{ $product }} <small>Pc</small></h3>
                                        <p>Total Product</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-xxl-right border-bottom border-xxl-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-danger" style="font-size:50px"><i class="fas fa-parking"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i> {{ $deactive_product }} <small>Pc</small></h3>
                                        <p>Deactive Product</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-danger" style="font-size:50px"><i class="fas fa-parking"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i>{{ $active_product }} <small>Pc</small></h3>
                                        <p>Active Product</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-danger" style="font-size:50px"><i class="fas fa-parking"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i>{{ $customers }} <small>Pc</small></h3>
                                        <p>Customers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-statistics">
                    <div class="row">
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-lg-right border-bottom border-xxl-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-info" style="font-size:50px"><i class="fas fa-copyright"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i> {{ $category }} <small>Pc</small></h3>
                                        <p>Category</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-xxl-right border-bottom border-xxl-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-danger" style="font-size:50px"><i class="fab fa-asymmetrik"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i> {{ $brands }} <small>Pc</small></h3>
                                        <p>Brand</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-primary" style="font-size:50px"><i class="fas fa-comment"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i>{{ $ticket }} <small>Pc</small></h3>
                                        <p>Ticket</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-warning" style="font-size:50px"><i class="fab fa-r-project"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i>{{ $reviews }} <small>Pc</small></h3>
                                        <p>Review</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-statistics">
                    <div class="row">
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-lg-right border-bottom border-xxl-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-info" style="font-size:50px"><i class="fas fa-copyright"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i> {{ $coupons }} <small>Pc</small></h3>
                                        <p>Coupon</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-xxl-right border-bottom border-xxl-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-danger" style="font-size:50px"><i class="fab fa-scribd"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i> {{ $subscriber }} <small>Pc</small></h3>
                                        <p>Subscriber</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-primary" style="font-size:50px"><i class="fas fa-adjust"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i>{{ $pending_order }} <small>Pc</small></h3>
                                        <p>Pending Order</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6">
                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                                
                                <div class="d-block d-sm-flex h-100 align-items-center">
                                    <div class="apexchart-wrapper">
                                        <strong class="text-success" style="font-size:50px"><i class="fas fa-check-circle"></i></strong>
                                    </div>
                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center">
                                        <h3 class="mb-0"><i class="icon-arrow-up-circle"></i>{{ $success_order }} <small>Pc</small></h3>
                                        <p>Success Order</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12 m-b-30">
                <div class="card card-statistics apexchart-tool-force-top">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-heading">
                            <h4 class="card-title">Latest Order</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-sm table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Total ({{ $setting->currency }})</th>
                                    <th>Payment Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latest_order as $row)
                                    <tr>
                                        <th class="text-dark">{{ $row->order_id }}</th>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->total }} {{ $setting->currency }}</td>
                                        <td>{{ $row->payment_type }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td>
                                            @if($row->status == 0) <span class="badge badge-danger">Pending </span>
                                            @elseif($row->status == 1)<span class="badge badge-info">Recevied </span> 
                                            @elseif($row->status == 2)<span class="badge badge-primary"> Shipped</span>
                                            @elseif($row->status == 3)<span class="badge badge-success"> Complite</span>
                                            @elseif($row->status == 4)<span class="badge badge-warning"> Return</span> 
                                            @else<span class="badge badge-danger"> Cancel</span> @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xxl-4 m-b-30">
                <div class="card card-statistics h-100 mb-0">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-heading">
                            <h4 class="card-title">Customer List</h4>
                        </div>
                        <strong class="p-2 text-dark">
                            Total Customer: <span class="text-danger">({{ count($customer) }})</span>
                        </strong>
                    </div>
                    <div class="card-body">

                        @foreach( $customer as $cus )
                            <div class="row active-task m-b-20">
                                <div class="col-xs-1">
                                    <div class="bg-type mb-1 mb-xs-0 mt-1">
                                        <span>{{ substr($cus->name, 0, 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <h5 class="mb-0"><a href="#">{{ $cus->name }}</a></h5>
                                    <ul class="list-unstyled list-inline">
                                        <li class="list-inline-item">
                                            <small>@isset($cus->created_at){{ $cus->created_at }} @endisset</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-8 m-b-30">
                <div class="card card-statistics h-100 mb-0">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-heading">
                            <h4 class="card-title">Most Viewed Product</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($most_view as $row)
                            <div class="row mb-2">
                                <div class="col-2">
                                    <img src="{{ asset($row->thumbnail) }}" height="50px" width="100px" alt="">
                                </div>
                                <div class="col-7">
                                    <strong class="text-dark">{{ substr($row->name, 0, 100) }}..</strong>
                                </div>
                                <div class="col-3 text-dark">
                                    (<strong class="text-danger">{{ $row->product_view }}</strong> time view)
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end container-fluid -->
</div>
@endsection

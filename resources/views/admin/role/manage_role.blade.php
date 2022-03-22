@extends('layouts.admin')


@section('title', 'Blog Category Page')

@section('admin_content')

<link rel="stylesheet" href="{{ asset('public/frontend') }}/dataTable/jquery.dataTables.min.css">
<script scr="{{ asset('public/frontend') }}/dataTable/jquery-3.5.1.js"></script>
<script scr="{{ asset('public/frontend') }}/dataTable/jquery.dataTables.min.js"></script>

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Blog Category</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item active text-primary" aria-current="page">
                                	<a class="btn-sm btn btn-danger" href="{{ route('create.role') }}">Add Role</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $key => $row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                    	@if($row->category == 1) <span class="badge badge-success">category</span>@endif
                                    	@if($row->product == 1) <span class="badge badge-success">product</span>@endif
                                    	@if($row->offer == 1) <span class="badge badge-success"> offer</span> @endif
                                    	@if($row->pickup == 1) <span class="badge badge-success"> pickup </span>@endif
                                    	@if($row->setting == 1) <span class="badge badge-success"> setting </span>@endif
                                    	@if($row->blog == 1) <span class="badge badge-success"> blog</span> @endif
                                    	@if($row->ticket == 1) <span class="badge badge-success"> ticket </span>@endif
                                    	@if($row->payment == 1) <span class="badge badge-success"> payment</span> @endif
                                    	@if($row->order == 1) <span class="badge badge-success"> order</span>@endif
                                    	@if($row->contact == 1) <span class="badge badge-success"> contact</span>@endif
                                    	@if($row->report == 1) <span class="badge badge-success"> report</span>@endif
                                    	@if($row->user_role == 1) <span class="badge badge-success"> user role</span>@endif
                                    </td>
                                    <td>
                                    	<a href="{{ route('edit.role', $row->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    	<a id="delete" href="{{ route('delete.role', $row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            	</div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>


@endsection


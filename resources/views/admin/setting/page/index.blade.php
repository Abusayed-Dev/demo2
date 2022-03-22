@extends('layouts.admin')


@section('title', 'Dynamic Page')


@section('admin_content')

<style>body{color: #000;}</style>

<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Page</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item active text-primary" aria-current="page">
                                	<a class="btn-sm btn btn-danger" href="{{ route('create.page.setting') }}">Add New+</a>
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
                    <div class="table-responsive" style="overflow:hidden;">
                        <table id="table" class="table table-sm table-bordered  table-striped mb-0">
                            <thead>
                                <tr>
                                	<th>Sl</th>
                                	<th>Page Name</th>
                                    <th>Slug</th>
                                	<th>Page Title</th>
                                	<th>Page Position</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $key => $row)
                            	<tr>
                            		<td>{{ ++$key }}</td>
                            		<td>{{ $row->page_name }}</td>
                            		<td>{{ $row->page_slug }}</td>
                            		<td>{{ $row->page_title }}</td>
                            		<td>
                            			@if($row->page_position ==1)
                            			Line One
                            			@elseif($row->page_position == 2)
                            			Line Two
                            			@endif
                            		</td>
                            		<td>
                            			<a href="{{ route('edit.page', $row->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            			<a href="{{ route('delete.page', $row->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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


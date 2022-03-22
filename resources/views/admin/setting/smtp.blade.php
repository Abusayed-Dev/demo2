@extends('layouts.admin')


@section('title', 'SMTP Setting Page')


@section('admin_content')

<style>body{color: #000;}</style>

<div class="app-main" id="main">
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-12 m-b-30">
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>SMTP Setting</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
        	<div class="col-lg-8">
        		<div class="card card-statistics">
                    <div class="card-header">
                        <div class="card-heading">
                            <h4 class="card-title">SMTP Setting</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.smtp.setting', $smtp->id) }}" method="POST">
                        	@csrf
                    		<div class="form-group col-lg-6">
                                <label> Mailer</label>
                                <input type="text" class="form-control" name="mailer" value="{{ $smtp->mailer }}" required="">
                            </div>
                    		<div class="form-group col-lg-6">
                                <label> Host</label>
                                <input type="text" class="form-control" name="host" value="{{ $smtp->host }}" required="">
                            </div>
                    		<div class="form-group col-lg-6">
                                <label> Port</label>
                                <input type="text" class="form-control" name="port" value="{{ $smtp->port }}" required="">
                            </div>
                    		<div class="form-group col-lg-6">
                                <label> User Name</label>
                                <input type="text" class="form-control" name="user_name" value="{{ $smtp->user_name }}" required="">
                            </div>
                    		<div class="form-group col-lg-6">
                                <label> Password</label>
                                <input type="text" class="form-control" name="password" value="{{ $smtp->password }}" required="">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
        	</div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>

@endsection

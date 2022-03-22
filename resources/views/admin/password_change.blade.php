@extends('layouts.admin')

@section('title', 'Change Password')

@section('admin_content')

<div class="app-main" id="main">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6 m-b-30">
                <div class="card card-statistics">
                    <div class="card-header">
                        <div class="card-heading">
                            <h4 class="card-title">Password Change</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.password.update') }}" method="POST">
                        	@csrf
                            <div class="form-group">
                                <label for="1">Old Password</label>
                                <input type="text" name="old_password" class="form-control" id="1" placeholder="old password">
                            </div>
                            
                            <div class="form-group">
                                <label for="1">New Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="1" placeholder="New password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="1">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="1" placeholder="Retype password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

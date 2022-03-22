@extends('layouts.app')

@section('content')


<main class="main py-5">
    

    {{-- Register --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card border p-3">
                    <div class="card-title text-center mb-2">
                        Sign up now
                    </div>

                    <div class="card-body">
                        <form action="{{ route('register') }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="name">Your Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Your Phone Number *</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone">
                                
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Your E-mail *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Confirm Password *</label>
                                <input type="password" class="form-control" id="password" name="password_confirmation" required>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>SIGN UP</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                    <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-footer -->
                        </form>
                        <div class="form-choice">
                            <p class="text-center">or sign in with</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{ route('social.oauth', 'google') }}" class="btn btn-login btn-g">
                                        <i class="icon-google"></i>
                                        Login With Google
                                    </a>
                                </div><!-- End .col-6 -->
                                <div class="col-sm-6">
                                    <a href="{{ route('social.oauth', 'github') }}" class="btn btn-login  btn-f">
                                        <i class="icon-github"></i>
                                        Login With Github
                                    </a>
                                </div><!-- End .col-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .form-choice -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .End .tab-pane -->


</main>


@endsection

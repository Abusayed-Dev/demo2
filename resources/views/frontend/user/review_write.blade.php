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
                <a href="{{ route('write.review') }}" class="float-right text-danger">Write review</a>
              </div>
              <div class="card-body mt-2">
                  <h6>Write your valuable review based on your product quality and services.</h6>

                  <form action="{{ route('web.review.store') }}" method="post">
                    @csrf
                      <div class="form-group">
                          <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly="">
                      </div>
                      <div class="form-group">
                          <textarea name="review" placeholder="write a review" class="form-control" required=""></textarea>
                      </div>

                      <div class="form-group">
                          <select name="rating" id="" class="form-control custom-select">
                              <option value="1">1 Star</option>
                              <option value="2">2 Star</option>
                              <option value="3">3 Star</option>
                              <option value="4">4 Star</option>
                              <option value="5">5 Star</option>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-info">Submit</button>
                  </form>  
              </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

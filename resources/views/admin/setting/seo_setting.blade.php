@extends('layouts.admin')


@section('title', 'SEO Setting Page')


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
                        <h1>Seo Setting</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
        	<div class="col-lg-10">
        		<div class="card card-statistics">
                    <div class="card-header">
                        <div class="card-heading">
                            <h4 class="card-title">Seo Setting</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.seo.setting', $seo_data->id) }}" method="POST">
                        	@csrf
                        	<div class="row">
                        		<div class="form-group col-lg-6">
	                                <label> Title</label>
	                                <input type="text" class="form-control" name="meta_title" value="{{ $seo_data->meta_title }}" required="">
	                            </div>
	                            <div class="form-group col-lg-6">
	                                <label>Author</label>
	                                <input type="text" class="form-control" name="meta_author"  placeholder=" author.." value="{{ $seo_data->meta_author }}" required="">
	                            </div>
                        	</div>

                        	
                            <div class="form-group">
                                <label>Tags</label>
                                <input type="text" class="form-control" name="meta_tag"  placeholder="Enter tag.." required=""  value="{{ $seo_data->meta_tag }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Description</label>
                                <textarea required="" class="form-control summernote" name="meta_description" id="summernote">
                                	{!!   $seo_data->meta_description !!}
                                </textarea>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
	                                <label>Google Verification</label>
	                                <input type="text" class="form-control" name="google_verification"  placeholder="google verification.." required="" value="{{ $seo_data->google_verification }}">
	                            </div>
	                            <div class="form-group col-lg-6">
	                                <label>Google Analytics</label>
	                                <input type="text" class="form-control" name="google_analytics"  placeholder="google analytics.." required="" value="{{ $seo_data->google_analytics }}">
	                            </div>
                            </div>

                            <div class="row">
	                            <div class="form-group col-lg-6">
	                                <label>Google Adsense</label>
	                                <input type="text" class="form-control" name="google_adsense"  placeholder="google adsense.." required="" value="{{ $seo_data->google_adsense }}">
	                            </div>
	                            <div class="form-group col-lg-6">
	                                <label>Alexa Verification</label>
	                                <input type="text" class="form-control" name="alexa_verification"  placeholder="alexa verification.." required=""  value="{{ $seo_data->alexa_verification }}">
	                            </div>
	                        </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
        	</div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>




@endsection





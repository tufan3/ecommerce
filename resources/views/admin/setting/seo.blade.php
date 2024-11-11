@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">OnPage SEO</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Your SEO setting</h3>
                            </div>
                            <form action="{{ route('seo.setting.update', $data->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="meta_title">Meta Title</label>
                                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                                    placeholder="Meta Title" value="{{ $data->meta_title }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_author">Meta Author</label>
                                                <input type="text" class="form-control" id="meta_author"
                                                    name="meta_author" placeholder="Meta Author"
                                                    value="{{ $data->meta_author }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_tag">Meta Tag</label>
                                                <input type="text" class="form-control" id="meta_tag"Tag
                                                    name="meta_tag" placeholder="Meta Tag"
                                                    value="{{ $data->meta_tag }}">
                                            </div>


                                            <div class="form-group">
                                                <label for="meta_keyword">Meta Keyword</label>
                                                <input type="text" class="form-control" id="meta_keyword"Tag
                                                    name="meta_keyword" placeholder="Meta Keyword"
                                                    value="{{ $data->meta_keyword }}">
                                                    <small style="color: rgb(189, 44, 44);">example: ecommerce, online shop, online maket</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Meta Description</label>
                                                    <textarea class="form-control" name="meta_description" placeholder="Meta Description">{{ $data->meta_description }}</textarea>
                                            </div>

                                        </div>
                                        <div class="col-6">

                                            <div class="form-group">
                                                <label for="google_analytics">Google Analytics</label>
                                                <input type="text" class="form-control" id="google_analytics"
                                                    name="google_analytics" placeholder="Google Analytics"
                                                    value="{{ $data->google_analytics }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="google_adsense">Google Adsense</label>
                                                <input type="text" class="form-control" id="google_adsense"
                                                    name="google_adsense" placeholder="Google Adsense"
                                                    value="{{ $data->google_adsense }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="google_verification">Google Verification</label>
                                                <input type="text" class="form-control" id="google_verification" name="google_verification"
                                                    placeholder="Google Verification" value="{{ $data->google_verification }}">
                                                    <small style="color: rgb(189, 44, 44);">put here only verification code</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="alexa_verification">Alexa Verification</label>
                                                <input type="text" class="form-control" id="alexa_verification"
                                                    name="alexa_verification" placeholder="Alexa Verification"
                                                    value="{{ $data->alexa_verification }}">
                                                    <small style="color: rgb(189, 44, 44);">put here only verification code</small>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

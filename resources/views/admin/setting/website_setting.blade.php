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
                            <li class="breadcrumb-item active">Website setting</li>
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
                                <h3 class="card-title">Your website setting</h3>
                            </div>
                            <form action="{{ route('website.setting.update', $website->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="currency">Website Currency</label>
                                                    <select class="form-control" name="currency" >
                                                        <option value="">----SELECT----</option>
                                                        <option value="৳" @if($website->currency === '৳') selected @endif>BDT</option>

                                                        <option value="$" @if($website->currency === '$') selected @endif>USD</option>
                                                    </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone_one">Phone One</label>
                                                <input type="text" class="form-control" id="phone_one" name="phone_one" placeholder="Phone One" value="{{ $website->phone_one }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="phone_two">Phone Two</label>
                                                <input type="text" class="form-control" id="phone_two" name="phone_two" placeholder="Phone Two" value="{{ $website->phone_two }}">
                                            </div>


                                            <div class="form-group">
                                                <label for="main_email">Main Email</label>
                                                <input type="text" class="form-control" id="main_email" name="main_email" placeholder="Main Email" value="{{ $website->main_email }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="support_email">Support Email</label>
                                                <input type="text" class="form-control" id="support_email" name="support_email" placeholder="Support Email" value="{{ $website->support_email }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                    <textarea class="form-control" name="address" placeholder="Address">{{ $website->address }}</textarea>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            {{-- <strong class="text-info">Social Link</strong> --}}
                                            <div class="form-group">
                                                <label for="facebook">Facebook Link</label>
                                                <input type="text" class="form-control" id="facebook"
                                                    name="facebook" placeholder="Facebook Link"
                                                    value="{{ $website->facebook }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="twitter">Twitter Link</label>
                                                <input type="text" class="form-control" id="twitter"
                                                    name="twitter" placeholder="Twitter Link"
                                                    value="{{ $website->twitter }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="instagram">Instagram Link</label>
                                                <input type="text" class="form-control" id="instagram" name="instagram"
                                                    placeholder="Instagram Link" value="{{ $website->instagram }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="linkedin">Linkedin Link</label>
                                                <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Linkedin Link" value="{{ $website->linkedin }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="youtube">YouTube Link</label>
                                                <input type="text" class="form-control" id="youtube" name="youtube" placeholder="YouTube Link" value="{{ $website->youtube }}">
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="logo">Logo</label>
                                                        <input type="file" class="form-control" id="logo" name="logo" placeholder="logo" >
                                                        <input type="hidden" name="old_logo" value="{{ $website->logo }}">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="favicon">Favicon</label>
                                                        <input type="file" class="form-control" id="favicon" name="favicon" placeholder="Favicon" value="{{ $website->favicon }}">
                                                        <input type="hidden" name="old_favicon" value="{{ $website->favicon }}">
                                                    </div>
                                                </div>
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

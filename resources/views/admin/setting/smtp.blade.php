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
                            <li class="breadcrumb-item active">SMTP Mail</li>
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
                                <h3 class="card-title">SMTP Mail Setting</h3>
                            </div>
                            <form action="{{ route('seo.setting.update', $smtp->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="mailer">Mail Mailer</label>
                                        <input type="text" class="form-control" id="mailer" name="mailer"
                                            placeholder="Mail Mailer Example: smtp" value="{{ $smtp->mailer }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="host">Mail Host</label>
                                        <input type="text" class="form-control" id="host" name="host"
                                            placeholder="Mail Host" value="{{ $smtp->host }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="port">Mail Port</label>
                                        <input type="text" class="form-control" id="port"Tag name="port"
                                            placeholder="Mail Port" value="{{ $smtp->port }}">
                                    </div>


                                    <div class="form-group">
                                        <label for="user_name">Mail Username</label>
                                        <input type="text" class="form-control" id="user_name"Tag name="user_name"
                                            placeholder="Mail Username" value="{{ $smtp->user_name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Mail Password</label>
                                        <input type="text" class="form-control" id="password"Tag name="password"
                                            placeholder="Mail Password" value="{{ $smtp->password }}">
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

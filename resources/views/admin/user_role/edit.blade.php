@extends('layouts.admin')

@section('admin_content')
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Toggle CSS -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    </head>

    <style>
        .custom-control-label {
            font-weight: bold;
            transition: color 0.3s;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background-color: #28a745;
        }

        .custom-control-input:not(:checked)~.custom-control-label::before {
            background-color: #dc3545;
        }

        .bootstrap-tagsinput .tag {
            background: #428bca;
            border: 1px solid white;
            padding: 2 6px;
            padding-left: 2px;
            margin-right: 2px;
            color: #fff;
            border-radius: 4px;

        }

        .bootstrap-toggle .toggle-on {
            color: white;
            background-color: green;
        }

        .bootstrap-toggle .toggle-off {
            color: white;
            background-color: red;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('role.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="e_role_id" value="{{ $role->id }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Employee Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Employee Name" value="{{ old('name',$role->name) }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Employee Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Employee Email" value="{{ old('email',$role->email) }}" required>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Category</label><br>
                                        <input type="checkbox" @if($role->category == 1) checked @endif  data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="category" value="1">
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Product</label><br>
                                        <input type="checkbox" @if($role->product == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="product" value="1">
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Offer</label><br>
                                        <input type="checkbox" @if($role->offer == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="offer" value="1">
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Order</label><br>
                                        <input type="checkbox" @if($role->order == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="order" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Pickup Point</label><br>
                                        <input type="checkbox" @if($role->pickup == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="pickup" value="1">
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Tickets</label><br>
                                        <input type="checkbox" @if($role->ticket == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="ticket" value="1">
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Contact</label><br>
                                        <input type="checkbox" @if($role->contact == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="contact" value="1">
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Report</label><br>
                                        <input type="checkbox" @if($role->report == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="report" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Setting</label><br>
                                        <input type="checkbox" @if($role->setting == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="setting" value="1">
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">Blog</label><br>
                                        <input type="checkbox" @if($role->blog == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="blog" value="1">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="toggle-switch">User Role</label><br>
                                        <input type="checkbox" @if($role->userrole == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="userrole" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap Toggle JS -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<script>
    $(document).ready(function() {
        $('#toggle-switch').change(function() {
            $(this).val(this.checked ? 1 : 0);
        });
    });
</script>

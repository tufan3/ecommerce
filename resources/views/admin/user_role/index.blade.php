@extends('layouts.admin')

@section('admin_content')

<!-- Bootstrap Toggle CSS -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Role</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                + Add New
                            </button>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All User Role List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ytable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>User Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>

    {{-- add modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="addModalLabel">Add New User Role</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('role.store') }}" method="POST" id="add_from">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name" class="form-label">Employee Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Employee Name" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email" class="form-label">Employee Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Employee Email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Category</label><br>
                                    <input type="checkbox" checked data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="category" value="1">
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Product</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="product" value="1">
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Offer</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="offer" value="1">
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Order</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="order" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Pickup Point</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="pickup" value="1">
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Tickets</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="ticket" value="1">
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Contact</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="contact" value="1">
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Report</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="report" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Setting</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="setting" value="1">
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">User Role</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="userrole" value="1">
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Blog</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="blog" value="1">
                                </div>

                            </div>
                            {{-- <div class="col-3">
                                <div class="form-group">
                                    <label for="toggle-switch">Report</label><br>
                                    <input type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="report" value="1">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add modal --}}

    {{-- ajax request form edit --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

    <script>
         $(function brand() {
            table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('role.index') }}",
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'user_role', name: 'user_role' },
                    { data: 'action', name: 'action', orderable: true, searchable: true },
                ]
            });
        });
    </script>

    {{-- edit without page load --}}
{{-- <script>
    $('body').on('click', '.edit', function() {
        var role_id = $(this).data('id');
        // alert(role_id);
        $.ajax({
            type: 'GET',
            url: 'role/edit/' + role_id,
            success: function(data) {
                $('#modal_body').html(data);
            }
        });
    });

</script> --}}

{{-- add data without page load --}}
<script>
    $('#add_from').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var request = $(this).serialize();
        // alert(request);
        $.ajax({
            type: 'POST',
            url: url,
            async: false,
            data: request,
            success: function(data) {
                toastr.success(data);
                $('#addModal').modal('hide');
                $('#add_from')[0].reset();
                table.ajax.reload();

                // Ensure backdrop is removed
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open'); // Remove open class to avoid overlay
            }
        });
    });

</script>

@endsection

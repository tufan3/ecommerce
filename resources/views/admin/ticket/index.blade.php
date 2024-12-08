@extends('layouts.admin')

@section('admin_content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #dd1515;
            transition: .4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #4CAF50;
        }

        input:checked+.slider:before {
            transform: translateX(14px);
        }
    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ticket List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        {{-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">All Product</li>
                        </ol> --}}
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
                                <div class="d-flex justify-content-between ">
                                    <!-- Title on the left -->
                                    <h3 class="card-title mb-0">All Tickets List</h3>

                                    <!-- Dropdowns on the right -->
                                    <div class="d-flex">
                                        <div class="form-group mr-2">
                                            <select class="form-control submitable" name="status" id="status">
                                                <option value="all">Status</option>
                                                <option value="0">Pending</option>
                                                <option value="1">Processing</option>
                                                <option value="2">Closed</option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2">
                                           <input type="date" class="form-control submitable_input" id="date" name="date" placeholder="date">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ytable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User name</th>
                                            <th>Subject</th>
                                            <th>Service</th>
                                            <th>Priority</th>
                                            <th>Date</th>
                                            <th>Status</th>
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



    <script>
        $(function brand() {
            var table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                searching: true,
                ajax: {
                    url: "{{ route('ticket.index') }}",
                    data: function(d) {
                        d.status = $('#status').val();
                        d.date = $('#date').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'subject', name: 'subject'},
                    {data: 'service', name: 'service'},
                    {data: 'priority', name: 'priority'},
                    {data: 'date', name: 'date'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: true, searchable: true}
                ]
            });
        });
    </script>


    <script>
        $(document).on('change','.submitable', function () {
            $('#ytable').DataTable().ajax.reload();
            // var status = $('#status').val()
            // alert(status);
        });

        $(document).on('change','.submitable_input', function () {
            $('#ytable').DataTable().ajax.reload();
        });
    </script>
@endsection

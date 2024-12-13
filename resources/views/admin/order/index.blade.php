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
                        <h1 class="m-0">Orders</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">All Order</li>
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
                                <div class="d-flex justify-content-between ">
                                    <!-- Title on the left -->
                                    <h3 class="card-title mb-0">All Order List</h3>

                                    <!-- Dropdowns on the right -->
                                    <div class="d-flex">
                                        <div class="form-group mr-2">
                                            <select class="form-control submitable" name="status" id="status">
                                                <option value="">Status</option>
                                                <option value="pending">Pending</option>
                                                <option value="received">Received</option>
                                                <option value="shipped">Shipped</option>
                                                <option value="completed">Completed</option>
                                                <option value="return">Return</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2">
                                            <input type="date" name="date" id="date" class="form-control submitable_input" placeholder="date">
                                        </div>

                                        {{-- <div class="form-group">
                                            <select class="form-control submitable" name="sort_by_price" id="sort_by_price">
                                                <option value="">Sort By</option>
                                                <option value="hl">Price(High to Low)</option>
                                                <option value="lh">Price(Low to High)</option>
                                            </select>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ytable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Order Number</th>
                                            <th>Sub-total({{ $setting->currency }})</th>
                                            <th>Total({{ $setting->currency }})</th>
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

    {{-- edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="editModalLabel">Update Order</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body"></div>
            </div>
        </div>
    </div>

    {{-- edit modal --}}

    {{-- view modal --}}
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="viewModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="view_modal_body"></div>
            </div>
        </div>
    </div>

    {{-- view modal --}}



    <script>
        $(function brand() {
            table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                searching: true,
                ajax: {
                    url: "{{ route('admin.order.index') }}",
                    data: function(d) {
                        d.status = $('#status').val();
                        d.date = $('#date').val();
                        // d.warehouse_id = $('#warehouse_id').val();
                        // d.sort_by_price = $('#sort_by_price').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'order_number', name: 'order_number'},
                    {data: 'sub_total', name: 'sub_total'},
                    {data: 'total', name: 'total'},
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
        });

        $(document).on('change','.submitable_input', function () {
            $('#ytable').DataTable().ajax.reload();
        });

    </script>

    <script>
        $('body').on('click', '.edit', function(){
            var order_id = $(this).data('id');
            // alert(id);
            $.ajax({
                type: 'GET',
                url: 'order/admin/edit/'+order_id,
                success: function(data){
                    $('#modal_body').html(data);
                    // $('#e_category_name').val(data.category_name);
                    // $('#e_home_page').val(data.home_page);
                    // $('#e_category_id').val(data.id);
                }
            })
        })
    </script>

    <script>
        $('body').on('click', '.view', function(){
            var view = $(this).data('id');
            // alert(view);
            $.ajax({
                type: 'GET',
                url: 'order/admin/view/'+view,
                success: function(data){
                    // alert(data);
                    $('#view_modal_body').html(data);
                }
            })
        })
    </script>
@endsection

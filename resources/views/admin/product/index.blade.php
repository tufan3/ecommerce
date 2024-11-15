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
                        <h1 class="m-0">Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">All Product</li>
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
                                    <h3 class="card-title mb-0">All Products</h3>

                                    <!-- Dropdowns on the right -->
                                    <div class="d-flex">
                                        <div class="form-group mr-2">
                                            <select class="form-control submitable" name="category_id" id="category_id">
                                                <option value="">All Category</option>
                                                @foreach($category as $row)
                                                <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mr-2">
                                            <select class="form-control submitable" name="brand_id" id="brand_id">
                                                <option value="">All Brand</option>
                                                @foreach($brand as $row)
                                                <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mr-2">
                                            <select class="form-control submitable" name="warehouse_id" id="warehouse_id">
                                                <option value="">All Warehouse</option>
                                                @foreach($warehouse as $row)
                                                <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control submitable" name="sort_by_price" id="sort_by_price">
                                                <option value="">Sort By</option>
                                                <option value="hl">Price(High to Low)</option>
                                                <option value="lh">Price(Low to High)</option>
                                            </select>
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
                                            {{-- <th>Thumbnail</th> --}}
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Brand</th>
                                            <th>Featured</th>
                                            <th>Today Deal</th>
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
                    url: "{{ route('product.index') }}",
                    data: function(d) {
                        d.category_id = $('#category_id').val();
                        d.brand_id = $('#brand_id').val();
                        d.warehouse_id = $('#warehouse_id').val();
                        d.sort_by_price = $('#sort_by_price').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'product_thumbnail', name: 'product_thumbnail',
                        render: function (data, type, row) {
                            return `<div style="display: flex;">
                                        ${data}
                                        <span style="margin-left: 2%;"> ${row.product_name}</span>
                                    </div>`;
                        }
                    },

                    {data: 'product_code', name: 'product_code'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'subcategory_name', name: 'subcategory_name'},
                    {data: 'brand_name', name: 'brand_name'},
                    {data: 'featured', name: 'featured'},
                    {data: 'today_deal', name: 'today_deal'},
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

        $('body').on('click', '.edit', function() {
            var brand_id = $(this).data('id');
            // alert(brand_id);
            $.ajax({
                type: 'GET',
                url: 'brand/edit/' + brand_id,
                success: function(data) {
                    $('#modal_body').html(data);
                }
            })
        })
    </script>

    <script>
        function getFeatured(id) {
            $.ajax({
                url: '{{ route('product.featured') }}',
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.status);
                    }
                }
            });
        }

        function getTodayDeal(id) {
            $.ajax({
                url: '{{ route('product.todayDeal') }}',
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.status);
                    }
                }
            });
        }

        function getStatus(id) {
            $.ajax({
                url: '{{ route('product.status') }}',
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.status);
                    }
                }
            });
        }
    </script>
@endsection

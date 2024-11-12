@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Warehouse</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#warehouseModal">
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
                                <h3 class="card-title">All Warehouse List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ytable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Warehouse Name</th>
                                            <th>Warehouse Address</th>
                                            <th>Warehouse Phone</th>
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

    {{-- brand add modal --}}
    <div class="modal fade" id="warehouseModal" tabindex="-1" aria-labelledby="warehouseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="warehouseModalLabel">Add New Warehouse</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('warehouse.store') }}" method="POST" id="add_from">
                {{-- <form action="#" method="POST" id="add_from"> --}}
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="warehouse_name" class="form-label">Warehouse Name</label>
                            <input type="text" class="form-control @error('warehouse_name') is-invalid @enderror" id="warehouse_name" name="warehouse_name" placeholder="Warehouse Name" value="">

                            @error('warehouse_name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="warehouse_phone" class="form-label">Warehouse Phone</label>
                            <input type="text" class="form-control @error('warehouse_phone') is-invalid @enderror" id="warehouse_phone" name="warehouse_phone" placeholder="Warehouse Phone" value="">

                            @error('warehouse_phone')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="warehouse_address" class="form-label">Warehouse Address</label>
                            <input type="text" class="form-control @error('warehouse_address') is-invalid @enderror" id="warehouse_address" name="warehouse_address" placeholder="Warehouse Address" value="">

                            @error('warehouse_address')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i> Loading...</span> <span class="submit_btn">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- brand add modal --}}

    {{-- brand edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Update Warehouse</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>
    {{-- brand edit modal --}}

    {{-- ajax request form edit --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script>
        $(function brand() {
            var table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('warehouse.index') }}",
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'warehouse_name', name: 'warehouse_name'},
                    {data: 'warehouse_address', name: 'warehouse_address'},
                    {data: 'warehouse_phone', name: 'warehouse_phone'},
                    {data: 'action', name: 'action', orderable: true,searchable: true },
            ]
            });
        });
    </script>

    <script>
        $('body').on('click', '.edit', function(){
            var warehouse_id = $(this).data('id');
            // alert(warehouse_id);
            $.ajax({
                type: 'GET',
                url: 'warehouse/edit/'+warehouse_id,
                success: function(data){
                    $('#modal_body').html(data);
                    }
            })
        })

        $('#add_from').on('submit', function(){
            $('.loader').removeClass('d-none');
            $('.submit_btn').addClass('d-none');
            // alert('sfvsv');
            // $.ajax({
            //     type: 'GET',
            //     url: 'warehouse/edit/'+warehouse_id,
            //     success: function(data){
            //         $('#modal_body').html(data);
            //         }
            // })
        })


    </script>
@endsection

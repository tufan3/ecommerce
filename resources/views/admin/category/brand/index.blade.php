@extends('layouts.admin')

@section('admin_content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Brand</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#childcategoryModal">
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
                                <h3 class="card-title">All Brands List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ytable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Brand Name</th>
                                            <th>Brand Slug</th>
                                            <th>Brand Logo</th>
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
    <div class="modal fade" id="childcategoryModal" tabindex="-1" aria-labelledby="childcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="childcategoryModalLabel">Add New Brand</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data" id="add_from">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="brand_name" class="form-label">Brand Name</label>
                            <input type="text" class="form-control @error('brand_name') is-invalid @enderror"
                                id="brand_name" name="brand_name" placeholder="Brand Name"
                                value="">

                            @error('brand_name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand_name" class="form-label">Brand Logo</label>
                            {{-- <input type="file" class="form-control" name="brand_logo" id=""> --}}
                            <input type="file" class="dropify" name="brand_logo" data-height="140" data-width="140" required/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
                    <h1 class="modal-title fs-5" id="editModalLabel">Update Brand</h1>
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
                    url: "{{ route('brand.index') }}",
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'brand_name', name: 'brand_name'},
                    {data: 'brand_slug', name: 'brand_slug'},
                    {data: 'brand_logo', name: 'brand_logo', render: function(data, type, full, meta){
                        return "<img src=\"" + data + "\" width=\"100\" height=\"100\"/>";
                    }},
                    {data: 'action', name: 'action', orderable: true,searchable: true },
            ]
            });
        });
    </script>

    {{-- model data show --}}
    {{-- <script>
        $(function childcategory() {
            var table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('childcategory.index') }}",
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'subcategory_name', name: 'subcategory_name'},
                    {data: 'childcategory_name', name: 'childcategory_name'},
                    {data: 'childcategory_slug', name: 'childcategory_slug'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script> --}}
    {{-- model data show --}}

    <script>
        $('body').on('click', '.edit', function(){
            var brand_id = $(this).data('id');
            // alert(brand_id);
            $.ajax({
                type: 'GET',
                url: 'brand/edit/'+brand_id,
                success: function(data){
                    $('#modal_body').html(data);
                    }
            })
        })
    </script>
@endsection

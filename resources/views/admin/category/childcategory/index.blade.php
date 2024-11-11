@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Child Category</h1>
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
                                <h3 class="card-title">All Child Categories List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ytable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Child Category name</th>
                                            <th>Child Category Slug</th>
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

    {{-- sub category add modal --}}
    <div class="modal fade" id="childcategoryModal" tabindex="-1" aria-labelledby="childcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="childcategoryModalLabel">Add New Child Category</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('childcategory.store') }}" method="POST" id="add_from">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_id" class="form-label">Catrgory Name</label>
                            <select name="subcategory_id" id="" class="form-control">
                                <option value="">----SELECT----</option>
                                @foreach ($category as $cat_data)
                                @php
                                    $subcat = App\Models\SubCategory::where('category_id', $cat_data->id)->get();
                                @endphp
                                <option class="text-info" value="" disabled>{{ $cat_data->category_name}}</option>
                                    @foreach ($subcat as $row)
                                        <option value="{{ $row->id }}">----{{ $row->subcategory_name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="form-group">
                            <label for="subcategory_id" class="form-label">Sub Catrgory Name</label>
                            <select name="subcategory_id" id="" class="form-control">
                                <option value="">----SELECT----</option>
                                @foreach ($subcategory as $sub_data)
                                <option value="{{ $sub_data->id }}">{{ $sub_data->subcategory_name}}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label for="childcategory_name" class="form-label">Child Catrgory Name</label>
                            <input type="text" class="form-control @error('childcategory_name') is-invalid @enderror"
                                id="childcategory_name" name="childcategory_name" placeholder="Child Category Name"
                                value="">

                            @error('childcategory_name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- sub category add modal --}}

    {{-- sub category edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Update child-Category</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>
    {{-- sub category edit modal --}}

    {{-- ajax request form edit --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(function childcategory() {
            var table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('childcategory.index') }}",
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'subcategory_name', name: 'subcategory_name'},
                    {data: 'childcategory_name', name: 'childcategory_name'},
                    {data: 'childcategory_slug', name: 'childcategory_slug'},
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
            var child_cat_id = $(this).data('id');
            // alert(child_cat_id);
            $.ajax({
                type: 'GET',
                url: 'childcategory/edit/'+child_cat_id,
                success: function(data){
                    $('#modal_body').html(data);
                    }
            })
        })
    </script>
@endsection

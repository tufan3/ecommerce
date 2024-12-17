@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Campaign</h1>
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
                                <h3 class="card-title">All Campaign List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ytable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Discount (%)</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                                <form id="deleted_form" action="" method="delete">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add New Campaign</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data" id="add_from">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Campaign Title" value="{{ old('title') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Campaign start Date" value="{{ old('start_date') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Campaign end Date" value="{{ old('end_date') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="discount" class="form-label">Discount (%) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" value="{{ old('discount') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="" class="form-control" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" class="dropify" name="image" data-height="140" data-width="140" required/>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> <span class="d-none loader"><i
                                    class="fas fa-spinner"></i> Loading...</span> <span
                                class="submit_btn">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add modal --}}

    {{-- edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Update Campaign</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>
    {{-- edit modal --}}

    {{-- campaign product modal --}}
    <div class="modal fade" id="campaignProductModal" tabindex="-1" aria-labelledby="campaignProductModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="campaignProductModalLabel">All Products for Campaign</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="campaign_product_modal_body"></div>
            </div>
        </div>
    </div>
    {{-- campaign product modal --}}

    {{-- ajax request form edit --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script>
         $(function brand() {
            table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('campaign.index') }}",
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'title', name: 'title' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'discount', name: 'discount' },
                    { data: 'status', name: 'status' },
                    {data: 'image', name: 'image', render: function(data, type, full, meta){
                        return "<img src=\"" + data + "\" width=\"100\" height=\"100\"/>";
                    }},
                    { data: 'action', name: 'action', orderable: true, searchable: true },
                ]
            });
        });

        // delete data
        $(document).ready(function() {
            $(document).on('click', '#delete_campaign', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $('#deleted_form').attr('action', url);

                swal({
                    title: "Are you sure you want to delete?",
                    text: "This action cannot be undone.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#deleted_form').submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
            });

            $('#deleted_form').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var request = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: url,
                    async: false,
                    data: request,
                    success: function(data) {
                        toastr.success(data);
                        $('#deleted_form')[0].reset();
                        table.ajax.reload();
                    }
                });
            });
        });
    </script>

    {{-- edit without page load --}}
<script>
    $('body').on('click', '.edit', function() {
        var campaign_id = $(this).data('id');
        // alert(campaign_id);
        $.ajax({
            type: 'GET',
            url: 'campaign/edit/' + campaign_id,
            success: function(data) {
                $('#modal_body').html(data);
            }
        });
    });

</script>

<script>
    $('body').on('click', '.campaign_product', function(){
        var campaign_id = $(this).data('id');
        // alert(id);
        $.ajax({
            type: 'GET',
            url: 'campaign-product/'+campaign_id,
            success: function(data){
                $('#campaign_product_modal_body').html(data);
                }
        })
    })
</script>

{{-- add data without page load --}}
<script>
    $('#add_from').submit(function(e) {
        e.preventDefault();
        $('.loader').removeClass('d-none');
        $('.submit_btn').addClass('d-none');

        var url = $(this).attr('action');
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                toastr.success(data);
                $('#addModal').modal('hide');
                $('#add_from')[0].reset();
                table.ajax.reload();

                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            }
        });
    });


    // $('#add_from').submit(function(e) {
    //     e.preventDefault();
    //     $('.loader').removeClass('d-none');
    //     $('.submit_btn').addClass('d-none');
    //     var url = $(this).attr('action');
    //     var formData = new FormData(this);
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         data: formData,
    //         success: function(data) {
    //             toastr.success(data);
    //             $('#add_from')[0].reset();
    //             $('#addModal').modal('hide');
    //             table.ajax.reload();

    //             $('.modal-backdrop').remove();
    //             $('body').removeClass('modal-open');
    //         },
    //         error: function(xhr) {
    //             if (xhr.status === 422) {
    //                 var errors = xhr.responseJSON.errors;

    //                 $('.is-invalid').removeClass('is-invalid');
    //                 $('.invalid-feedback').remove();

    //                 if (errors.title) {
    //                     $('#title').addClass('is-invalid');
    //                     $('#title').after('<span class="invalid-feedback" role="alert"><strong>' + errors.title[0] + '</strong></span>');
    //                 }
    //             } else {
    //                 toastr.error('An error occurred');
    //             }
    //             $('.loader').addClass('d-none');
    //             $('.submit_btn').removeClass('d-none');
    //         }
    //     });
    // });

</script>

@endsection

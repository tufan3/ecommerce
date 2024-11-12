@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Coupon</h1>
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
                                <h3 class="card-title">All Coupon List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ytable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Coupon Code</th>
                                            <th>Coupon Amount</th>
                                            <th>Coupon Date</th>
                                            <th>Coupon Status</th>
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
                    <h1 class="modal-title fs-5" id="addModalLabel">Add New Coupon</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('coupon.store') }}" method="POST" id="add_from">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="coupon_code" class="form-label">Coupon Code</label>
                            <input type="text" class="form-control @error('coupon_code') is-invalid @enderror"
                                id="coupon_code" name="coupon_code" placeholder="Coupon Code" value="" required>
                            @error('coupon_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type" class="form-label">Coupon Type</label>
                            <select name="type" id="" class="form-control" required>
                                <option value="">----SELECT----</option>
                                <option value="1">Fixed</option>
                                <option value="2">Percentage</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="coupon_amount" class="form-label">Coupon Amount</label>
                            <input type="text" class="form-control" id="coupon_amount" name="coupon_amount"
                                placeholder="Coupon Amount" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="valid_date" class="form-label">Coupon Valid Date</label>
                            <input type="date" class="form-control" id="valid_date" name="valid_date"
                                placeholder="Coupon Valid Date" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Update Coupon</h1>
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

    {{-- ajax request form edit --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script>
         $(function brand() {
            table = $('#ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('coupon.index') }}",
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'coupon_code', name: 'coupon_code' },
                    { data: 'coupon_amount', name: 'coupon_amount' },
                    { data: 'valid_date', name: 'valid_date' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: true, searchable: true },
                ]
            });
        });

        // delete data
        $(document).ready(function() {
            $(document).on('click', '#delete_coupon', function(e) {
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
        var coupon_id = $(this).data('id');
        // alert(coupon_id);
        $.ajax({
            type: 'GET',
            url: 'coupon/edit/' + coupon_id,
            success: function(data) {
                $('#modal_body').html(data);
            }
        });
    });

</script>

{{-- add data without page load --}}
<script>
    // $('#add_from').submit(function(e) {
    //     e.preventDefault();
    //     $('.loader').removeClass('d-none');
    //     $('.submit_btn').addClass('d-none');
    //     var url = $(this).attr('action');
    //     var request = $(this).serialize();
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         async: false,
    //         data: request,
    //         success: function(data) {
    //             toastr.success(data);
    //             $('#addModal').modal('hide');
    //             $('#add_from')[0].reset();
    //             table.ajax.reload();

    //             // Ensure backdrop is removed
    //             $('.modal-backdrop').remove();
    //             $('body').removeClass('modal-open'); // Remove open class to avoid overlay
    //         }
    //     });
    // });

    $('#add_from').submit(function(e) {
    e.preventDefault();
    $('.loader').removeClass('d-none');
    $('.submit_btn').addClass('d-none');
    var url = $(this).attr('action');
    var request = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: url,
        data: request,
        success: function(data) {
            toastr.success(data);
            $('#add_from')[0].reset();
            $('#addModal').modal('hide');
            table.ajax.reload();

            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;

                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                if (errors.coupon_code) {
                    $('#coupon_code').addClass('is-invalid');
                    $('#coupon_code').after('<span class="invalid-feedback" role="alert"><strong>' + errors.coupon_code[0] + '</strong></span>');
                }
            } else {
                toastr.error('An error occurred');
            }
            $('.loader').addClass('d-none');
            $('.submit_btn').removeClass('d-none');
        }
    });
});

</script>

@endsection

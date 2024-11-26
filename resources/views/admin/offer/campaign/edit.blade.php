<form action="{{ route('campaign.update') }}" method="POST" enctype="multipart/form-data" id="edit_from">
    @csrf
    <div class="modal-body" style="">
        <input type="hidden" name="id" id="e_campaign_id" value="{{ $campaign->id }}">

            <div class="form-group">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="e_title" name="title"
                    placeholder="Campaign Title" value="{{ old('title',$campaign->title) }}" required>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Campaign start Date" value="{{ old('start_date',$campaign->start_date) }}" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Campaign end Date" value="{{ old('end_date', $campaign->end_date) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="discount" class="form-label">Discount (%) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" value="{{ old('discount', $campaign->discount) }}" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="" class="form-control" required>
                            <option value="active" {{ $campaign->status == 'active' ? 'selected' : ''}}>Active</option>
                            <option value="inactive" {{ $campaign->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Image <span class="text-danger">*</span></label>
                <input type="file" class="dropify" name="image" data-height="140" data-width="140" />

                <input type="hidden" name="old_image" id="" value="{{ $campaign->image }}">

            </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>


{{-- dropify --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script>
   $('.dropify').dropify({
messages: {
   'default': 'Click Here',
   'replace': 'Drag and drop or click to replace',
   'remove':  'Remove',
   'error':   'Ooops, something wrong happended.'
}
});
</script>

{{-- eidt data update without page load --}}
<script>
    // $('#edit_from').submit(function(e) {
    //     e.preventDefault();
    //     var url = $(this).attr('action');
    //     // var request = $(this).serialize();
    //     var formData = new FormData(this);
    //     // alert(formData);
    //     console.log(formData);
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         async: false,
    //         data: formData,
    //         success: function(data) {
    //             toastr.success(data);
    //             $('#edit_from')[0].reset();
    //             $('#editModal').modal('hide');
    //             table.ajax.reload();

    //             $('.modal-backdrop').remove();
    //             $('body').removeClass('modal-open');
    //         },
    //         error: function(xhr) {
    //         if (xhr.status === 422) {
    //             var errors = xhr.responseJSON.errors;

    //             $('.is-invalid').removeClass('is-invalid');
    //             $('.invalid-feedback').remove();

    //             if (errors.coupon_code) {
    //                 $('#e_title').addClass('is-invalid');
    //                 $('#e_title').after('<span class="invalid-feedback" role="alert"><strong>' + errors.coupon_code[0] + '</strong></span>');
    //             }
    //         }

    //     }
    //     });
    // });


    $('#edit_from').submit(function(e) {
        e.preventDefault();

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
                $('#editModal').modal('hide');
                $('#edit_from')[0].reset();
                table.ajax.reload();

                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            }
        });
    });
</script>

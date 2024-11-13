<form action="{{ route('pickuppoint.update') }}" method="POST" id="edit_from">
    @csrf
    <div class="modal-body">

        <input type="hidden" name="id" id="e_pickup-id" value="{{ $pickup_point->id }}">

        <div class="form-group">
            <label for="pickup_point_name" class="form-label">Pickup Point Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('pickup_point_name') is-invalid @enderror"
                id="e_pickup_point_name" name="pickup_point_name" placeholder="Pickup Point Name" value="{{ $pickup_point->pickup_point_name }}" required>
            @error('pickup_point_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="pickup_point_address" class="form-label">Pickup Point Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pickup_point_address" name="pickup_point_address"
                placeholder="Pickup Point Address" value="{{ $pickup_point->pickup_point_address }}" required>
        </div>

        <div class="form-group">
            <label for="pickup_point_phone" class="form-label">Pickup Point Phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pickup_point_phone" name="pickup_point_phone"
                placeholder="Pickup Point Phone" value="{{ $pickup_point->pickup_point_phone }}" required>
        </div>

        <div class="form-group">
            <label for="pickup_point_phone_two" class="form-label">Pickup Point Another Phone</label>
            <input type="text" class="form-control" id="pickup_point_phone_two" name="pickup_point_phone_two"
                placeholder="Pickup Point Other Phone" value="{{ $pickup_point->pickup_point_phone_two }}">
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

{{-- eidt data update without page load --}}
<script>
    $('#edit_from').submit(function(e) {
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
                $('#edit_from')[0].reset();
                $('#editModal').modal('hide');
                table.ajax.reload();

                // Ensure backdrop is removed
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open'); // Remove open class to avoid overlay
            },
            error: function(xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;

                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                if (errors.coupon_code) {
                    $('#e_pickup_point_name').addClass('is-invalid');
                    $('#e_pickup_point_name').after('<span class="invalid-feedback" role="alert"><strong>' + errors.coupon_code[0] + '</strong></span>');
                }
            }

        }
        });
    });
</script>

<form action="{{ route('coupon.update') }}" method="POST" id="edit_from">
    @csrf
    <div class="modal-body" style="">

        <input type="hidden" name="id" id="e_coupon_id" value="{{ $coupon->id }}">

        <div class="form-group">
            <label for="coupon_code" class="form-label">Coupon Code</label>
            <input type="text" class="form-control @error('coupon_code') is-invalid @enderror"
                id="edit_coupon_code" name="coupon_code" placeholder="Coupon Code" value="{{ $coupon->coupon_code }}" required>
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
                <option value="1" {{ $coupon->type == '1' ? 'selected' : ''}}>Fixed</option>
                <option value="2" {{ $coupon->type == '2' ? 'selected' : ''}}>Percentage</option>
            </select>
        </div>

        <div class="form-group">
            <label for="coupon_amount" class="form-label">Coupon Amount</label>
            <input type="text" class="form-control" id="coupon_amount" name="coupon_amount" placeholder="Coupon Amount" value="{{ $coupon->coupon_amount }}" required>
        </div>

        <div class="form-group">
            <label for="valid_date" class="form-label">Coupon Valid Date</label>
            <input type="date" class="form-control" id="valid_date" name="valid_date"
                placeholder="Coupon Valid Date" value="{{ $coupon->valid_date }}" required>
        </div>

        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="" class="form-control" required>
                <option value="active" {{ $coupon->status == 'active' ? 'selected' : ''}}>Active</option>
                <option value="inactive" {{ $coupon->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
            </select>
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
                    $('#edit_coupon_code').addClass('is-invalid');
                    $('#edit_coupon_code').after('<span class="invalid-feedback" role="alert"><strong>' + errors.coupon_code[0] + '</strong></span>');
                }
            }

        }
        });
    });
</script>

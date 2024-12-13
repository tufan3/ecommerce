<form action="{{ route('admin.order.update') }}" method="POST" id="edit_from">
    @csrf
    <input type="hidden" name="id" id="" value="{{ $order->id }}">
    <div class="modal-body">
        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="">Select Status</option>
                <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                <option value="received" @if($order->status == 'received') selected @endif>Received</option>
                <option value="shipped" @if($order->status == 'shipped') selected @endif>Shipped</option>
                <option value="completed" @if($order->status == 'completed') selected @endif>Completed</option>
                <option value="return" @if($order->status == 'return') selected @endif>Return</option>
                <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
            </select>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
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
                $('#editModal').modal('hide');
                $('#edit_from')[0].reset();
                table.ajax.reload();

                // Ensure backdrop is removed
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open'); // Remove open class to avoid overlay
            }
        });
    });
</script>

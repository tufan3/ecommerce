<form action="{{ route('warehouse.update') }}" method="POST" id="add_from">
    @csrf
    <div class="modal-body">
        <input type="hidden" id="e_warehouse_id" name="id" value="{{ $warehouse->id }}">

        <div class="form-group">
            <label for="warehouse_name" class="form-label">Warehouse Name</label>
            <input type="text" class="form-control @error('warehouse_name') is-invalid @enderror" id="warehouse_name" name="warehouse_name" placeholder="Warehouse Name" value="{{ $warehouse->warehouse_name }}">

            @error('warehouse_name')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="warehouse_phone" class="form-label">Warehouse Phone</label>
            <input type="text" class="form-control @error('warehouse_phone') is-invalid @enderror" id="warehouse_phone" name="warehouse_phone" placeholder="Warehouse Phone" value="{{ $warehouse->warehouse_phone }}">

            @error('warehouse_phone')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="warehouse_address" class="form-label">Warehouse Address</label>
            <input type="text" class="form-control @error('warehouse_address') is-invalid @enderror" id="warehouse_address" name="warehouse_address" placeholder="Warehouse Address" value="{{ $warehouse->warehouse_address }}">

            @error('warehouse_address')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

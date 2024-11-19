<form action="{{ route('subcategory.update') }}" method="POST">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label for="category_id" class="form-label">Catrgory Name</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">----SELECT----</option>
                @foreach($category as $sub_data)
                <option value="{{ $sub_data->id }}" @if($sub_data->id == $subcategory->category_id) selected @endif>{{ $sub_data->category_name}}</option>
                @endforeach
              </select>
        </div>

        <div class="form-group">
            <label for="subcategory_name" class="form-label">Sub-Catrgory Name</label>
            <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" id="e_subcategory_name" name="subcategory_name" placeholder="sub Category Name" value="{{ $subcategory->subcategory_name }}">
            <input type="hidden" id="e_subcategory_id" name="id" value="{{ $subcategory->id }}" required>

            @error('subcategory_name')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

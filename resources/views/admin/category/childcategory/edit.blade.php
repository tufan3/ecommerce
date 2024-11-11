<form action="{{ route('childcategory.update') }}" method="POST">
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
                        <option value="{{ $row->id }}" @if($row->id == $childcategory->subcategory_id) selected @endif>----{{ $row->subcategory_name}}</option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="childcategory_name" class="form-label">Child Catrgory Name</label>
            <input type="text" class="form-control @error('childcategory_name') is-invalid @enderror" id="e_childcategory_name" name="childcategory_name" placeholder="Child Category Name" value="{{ $childcategory->childcategory_name }}">
            <input type="hidden" id="e_childcategory_id" name="id" value="{{ $childcategory->id }}">

            @error('childcategory_name')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

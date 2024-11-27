{{-- dropify ccs link --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

<form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name" class="form-label">Catrgory Name</label>
            <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="e_category_name" name="category_name" placeholder="Category Name" value="{{ $category->category_name }}">
            <input type="hidden" id="e_category_id" name="id" value="{{ $category->id }}">

            @error('category_name')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_name" class="form-label">Show Home Page</label>
            <select name="home_page" class="form-control" id="e_home_page">
                <option value="1" @if($category->home_page == 1) selected @endif>Yes</option>
                <option value="0" @if($category->home_page == 0) selected @endif>no</option>
            </select>
        </div>
        <div class="form-group">
            <label for="icon" class="form-label">Category Icon</label>
            {{-- <input type="file" class="form-control" name="brand_logo" id=""> --}}
            <input type="file" class="dropify" name="icon" data-height="140" data-width="140" required/>
            <input type="hidden" name="old_icon" value="{{ $category->icon }}">
        </div>
    </div>
    <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
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

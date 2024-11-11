 {{-- dropify ccs link --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

<form action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <input type="hidden" id="e_brand_id" name="id" value="{{ $brand->id }}">

        <div class="form-group">
            <label for="brand_name" class="form-label">Brand Name</label>
            <input type="text" class="form-control @error('brand_name') is-invalid @enderror"
                id="e_brand_name" name="brand_name" placeholder="Brand Name"
                value="{{ $brand->brand_name }}">

            @error('brand_name')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="brand_name" class="form-label">Brand Logo</label>
            <input type="file" class="dropify" name="brand_logo" data-height="140" data-width="140" value=""/>
            <input type="hidden" name="old_image" id="" value="{{ $brand->brand_logo }}">
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

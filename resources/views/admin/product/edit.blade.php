@extends('layouts.admin')

@section('admin_content')
    {{-- dropify ccs link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Toggle CSS -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    </head>

    <style>
        .custom-control-label {
            font-weight: bold;
            transition: color 0.3s;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background-color: #28a745;
        }

        .custom-control-input:not(:checked)~.custom-control-label::before {
            background-color: #dc3545;
        }

        .bootstrap-tagsinput .tag {
            background: #428bca;
            border: 1px solid white;
            padding: 2 6px;
            padding-left: 2px;
            margin-right: 2px;
            color: #fff;
            border-radius: 4px;

        }

        .bootstrap-toggle .toggle-on {
            color: white;
            background-color: green;
        }

        .bootstrap-toggle .toggle-off {
            color: white;
            background-color: red;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-5">
                        {{-- <div class="card-body"> --}}
                        <div class="row">
                            <!-- Left column -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h3 class="card-title">Edit Product</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- Product Name and Product Code -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Product Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="product_name" class="form-control" placeholder="Enter product name" required value="{{ old('product_name',$product->product_name) }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Category/Subcategory <span class="text-danger">*</span></label>
                                                    <select name="subcategory_id" class="form-control" required id="subcategory_id">
                                                        <option value="">----SELECT----</option>
                                                        @foreach ($category as $cat)
                                                            <option class="text-info" value="" disabled>
                                                                {{ $cat->category_name }}</option>
                                                            @php
                                                                $subcategory = DB::table('subcategories')
                                                                    ->where('category_id', $cat->id)
                                                                    ->get();
                                                            @endphp
                                                            @foreach ($subcategory as $sub_cat)
                                                                <option value="{{ $sub_cat->id }}" @if ($product->subcategory_id == $sub_cat->id) selected @endif>--- {{ $sub_cat->subcategory_name }}</option>
                                                            @endforeach
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Brand <span class="text-danger">*</span></label>
                                                    <select name="brand_id" class="form-control" required>
                                                        <option value="">----SELECT----</option>
                                                        @foreach ($brand as $row)
                                                            <option value="{{ $row->id }}" @if ($product->brand_id == $row->id) selected @endif>{{ $row->brand_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Unit <span class="text-danger">*</span></label>
                                                    <input type="text" name="product_unit" class="form-control" placeholder="Enter product unit" required value="{{ old('product_unit',$product->product_unit) }}">
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Product Code <span class="text-danger">*</span></label>
                                                    <input type="text" name="product_code" class="form-control"
                                                        placeholder="Enter product code" required value="{{ old('product_code',$product->product_code) }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Child Category <span class="text-danger"></span></label>
                                                    <select name="childcategory_id" class="form-control"
                                                        id="childcategory_id">
                                                        <option value="">----SELECT----</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Pickup Point</label>
                                                    <select name="pickup_point_id" class="form-control">
                                                        <option value="">----SELECT----</option>
                                                        @foreach ($pickup_point as $row)
                                                            <option value="{{ $row->id }}"  @if ($product->pickup_point_id == $row->id) selected @endif > {{ $row->pickup_point_name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Tags</label><br>
                                                    <input type="text" name="product_tags" class="form-control"
                                                        placeholder="Enter product Tags" data-role="tagsinput" value="{{ old('product_tags',$product->product_tags) }}">
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Purchase Price, Selling Price, Discount Price -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Purchase Price </label>
                                                    <input type="text" name="purchase_price" class="form-control" placeholder="Enter purchase price" value="{{ old('purchase_price',$product->purchase_price) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selling Price <span class="text-danger">*</span></label>
                                                    <input type="text" name="selling_price" class="form-control" placeholder="Enter selling price" required value="{{ old('selling_price',$product->selling_price) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Discount Price</label>
                                                    <input type="text" name="discount_price" class="form-control"
                                                        placeholder="Enter discount price" value="{{ old('discount_price', $product->discount_price) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Warehouse <span class="text-danger">*</span></label>
                                                    <select name="warehouse" class="form-control" required>
                                                        <option value="">----SELECT----</option>
                                                        @foreach ($warehouse as $row)
                                                            <option value="{{ $row->id }}" @if ($product->warehouse == $row->id) selected @endif >{{ $row->warehouse_name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Color</label><br>
                                                    <input type="text" name="color" class="form-control" placeholder="Enter color" data-role="tagsinput" value="{{ old('color' ,$product->color) }}">
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Stock</label>
                                                    <input type="text" name="stock_quantity" class="form-control" placeholder="Enter stock quantity" value="{{ old('stock_quantity',$product->stock_quantity) }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="size">Size</label><br>
                                                    <input type="text" id="size" name="size"
                                                        class="form-control" placeholder="Enter size"
                                                        data-role="tagsinput" value="{{ old('size', $product->size) }}">
                                                </div>


                                            </div>
                                        </div>

                                        <!-- Product Details -->
                                        <div class="form-group">
                                            <label>Product Details</label>
                                            <textarea name="description" class="form-control textarea summernote" cols="" placeholder="Enter product details">{{ $product->description }}</textarea>
                                        </div>

                                        <!-- Product video -->
                                        <div class="form-group">
                                            <label>Video Embed Code</label>
                                            <input name="product_video" class="form-control" placeholder="Only use embed code" value="{{ old('product_video',$product->product_video) }}">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Right column -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h3 class="card-title">Product Images & Options</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- Main Thumbnail -->
                                        <div class="form-group">
                                            <label>Main Thumbnail <span class="text-danger">*</span></label>
                                            <input type="file" class="dropify" name="product_thumbnail"
                                                data-height="140" data-width="140" value="" required/>
                                        </div>

                                        <!-- Additional Images -->
                                        <div class="form-group">
                                            <label>More Images (Click Add For More Image)</label>
                                            <div id="image-container">
                                                <div class="input-group mb-2">
                                                    <input type="file" name="product_image[]" class="form-control">
                                                    <button type="button"
                                                        class="btn btn-success add-image-btn">Add</button>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Featured Product, Today Deal, Status -->
                                        <div class="form-group">
                                            <label for="toggle-switch">Cash On Delivery</label><br>
                                            <input type="checkbox" @if($product->cash_on_delivery == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="cash_on_delivery" value="1">
                                        </div>

                                        <div class="form-group">
                                            <label for="toggle-switch">Featured Product</label><br>
                                            <input type="checkbox" @if($product->featured == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="featured" value="1">
                                        </div>

                                        <div class="form-group">
                                            <label for="toggle-switch">Today Deal</label><br>
                                            <input type="checkbox" @if($product->today_deal == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="today_deal" value="1">
                                        </div>

                                        <div class="form-group">
                                            <label for="toggle-switch">Slider Product</label><br>
                                            <input type="checkbox" @if($product->product_slider == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="product_slider" value="1">
                                        </div>

                                        <div class="form-group">
                                            <label for="toggle-switch">Status</label><br>
                                            <input type="checkbox" @if($product->status == 1) checked @endif data-toggle="toggle" data-on="ON" data-off="OFF" data-onstyle="success" data-offstyle="danger" id="toggle-switch" name="status" value="1">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- </div> --}}
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection


{{-- dropify --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap Toggle JS -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<script>
    $(document).ready(function() {
        $('#toggle-switch').change(function() {
            $(this).val(this.checked ? 1 : 0);
        });
    });
</script>

<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Click Here',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
</script>


<script>
    $(document).ready(function() {
        // Add image field
        $(document).on('click', '.add-image-btn', function() {
            $('#image-container').append(`
            <div class="input-group mb-2">
                <input type="file" name="product_image[]" class="form-control">
                <button type="button" class="btn btn-danger remove-image-btn">X</button>
            </div>
        `);
        });

        // Remove image field
        $(document).on('click', '.remove-image-btn', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#subcategory_id').change(function() {
            var subcategory_id = $(this).val();
            // alert(subcategory_id)
            if (subcategory_id) {
                $.ajax({
                    url: '{{ route('getChildCategories', ':subcategory_id') }}'.replace(
                        ':subcategory_id', subcategory_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#childcategory_id').empty();
                        $('#childcategory_id').append(
                            '<option value="">----SELECT----</option>');
                        $.each(data, function(key, value) {
                            $('#childcategory_id').append('<option value="' + value
                                .id + '">' + value.childcategory_name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#childcategory_id').empty();
            }
        });
    });
</script>

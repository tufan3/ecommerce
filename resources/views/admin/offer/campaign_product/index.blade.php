@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Products for Campaign</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('campaign.product.list', $campaign_id) }}" type="button" class="btn btn-primary" >
                                Product List
                            </a>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Products for Campaign List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Thumbnail</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $key => $row)
                                        @php
                                            $exist = DB::table('campaign_product')->where('campaign_id', $campaign_id)->where('product_id', $row->id)->first();
                                        @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td><img src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="{{ $row->product_name }}" style="width: 80%; height: 100%;"></td>
                                                <td>{{ $row->product_name }}</td>
                                                <td>{{ $row->product_code }}</td>
                                                <td>{{ $row->category_name }}</td>
                                                <td>{{ $row->brand_name }}</td>
                                                <td>{{ $row->selling_price }}</td>
                                                <td>
                                                    @if(!$exist)
                                                        <a href="{{ route('add.product.to.campaign', [$row->id,$campaign_id]) }}"  class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>

    {{-- category edit modal --}}
    <div class="modal fade" id="campaignProductModal" tabindex="-1" aria-labelledby="campaignProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="campaignProductModalLabel">Update Category</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="campaign_product_modal_body"></div>
            </div>
        </div>
    </div>
    {{-- category edit modal --}}

    {{-- ajax request form edit --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('body').on('click', '.campaign_product', function(){
            var campaign_id = $(this).data('id');
            // alert(id);
            $.ajax({
                type: 'GET',
                url: 'campaign-product/'+campaign_id,
                success: function(data){
                    $('#campaign_product_modal_body').html(data);
                    }
            })
        })
    </script>
@endsection

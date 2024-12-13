<div class="modal-body p-4">
    <div class="" style="text-align: center">
        <div style="text-align: center">
            <h5 class="text-info">User Information</h5>
        </div>
        <div class="">
            <div class="row mb-3">
                <div class="col-lg-4">Name: {{ $order->name }}</div>
                <div class="col-lg-4">Phone: {{ $order->phone }}</div>
                <div class="col-lg-4">Email: {{ $order->email }}</div>
            </div>
        </div>
    </div>
    <div class="" style="text-align: center">
        <div style="text-align: center">
            <h5 class="text-info">Shipping Details</h5>
        </div>
        <div class="">
            <div class="row">
                <div class="col-lg-4">Name: {{ $order->shipping_name }}</div>
                <div class="col-lg-4">Phone: {{ $order->shipping_phone }}</div>
                <div class="col-lg-4">Email: {{ $order->shipping_email }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4">Address: {{ $order->shipping_address }}</div>
                <div class="col-lg-4">City: {{ $order->shipping_city }}</div>
                <div class="col-lg-4">Country: {{ $order->shipping_country }}</div>
            </div>
        </div>
    </div>
    <div class="card mt-4" style="text-align: center">
        <div style="text-align: center">
            <h5 class="text-info">Order Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">Order Number: {{ $order->order_number }}</div>
                @php
                    $date = date("d, M Y", strtotime($order->date))
                    @endphp
                <div class="col-lg-4">Date: {{ $date }}
                </div>
                <div class="col-lg-4">Status:
                    @if ($order->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif ($order->status =='received')
                        <span class="badge badge-info">Received</span>
                    @elseif ($order->status =='shipped')
                        <span class="badge badge-primary">Shipped</span>
                    @elseif ($order->status =='completed')
                        <span class="badge badge-success">Completed</span>
                    @elseif ($order->status =='return')
                        <span class="badge badge-danger">Return</span>
                    @elseif ($order->status =='cancelled')
                        <span class="badge badge-danger">Cancelled</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">Sub-Total: {{ $setting->currency }}{{ $order->sub_total }}</div>
                <div class="col-lg-4">Total:
                    @if ($order->after_discount == null)
                        {{ $setting->currency }}{{ $order->total }}
                    @else
                    {{ $setting->currency }}{{ $order->after_discount }}
                    @endif
                </div>
                <div class="col-lg-4">Payment Type: {{ $order->payment_type }}</div>
            </div>

            <table id="" class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_details as $row)
                    <tr>
                        <td><img src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="Product Image" width="50"></td>
                        <td>{{ substr($row->product_name, 0, 15) }}</td>
                        <td>
                            @if($row->color != null)
                            {{ $row->color }}
                            @endif
                        </td>
                        <td>
                            @if($row->size != null)
                           {{ $row->size }}
                            @endif
                        </td>
                        <td>
                            {{ $row->quantity }}
                        </td>
                        <td>{{ $setting->currency }}{{ $row->single_price }}</td>
                        <td class="total-item">{{ $setting->currency }}{{ $row->subtotal_price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

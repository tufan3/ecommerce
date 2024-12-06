<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .order-details {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @php
        $shipping_details = DB::table('shippings')->where('id', $order['shipping_id'])->first();
    @endphp
    <div class="email-container">
        <div class="header">
            <h1>Order Place Successfully</h1>
        </div>
        <p>Dear <strong>{{ $shipping_details->shipping_name }}</strong>,</p>
        <p>Order ID: {{ $order['order_number'] }}</p>
        <p>Order Date: {{ $order['date'] }}</p>
        <hr>
        <p>Thank you for your order! Here are the details:</p>
        <div class="order-details">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_details as $item)
                        <tr>
                            <td>{{ $item['product_name'] }}</td>
                            <td>{{ $item['color'] }}</td>
                            <td>{{ $item['size'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ number_format($item['single_price'], 2) }}</td>
                            <td>${{ number_format($item['subtotal_price'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="footer">
            <p>Thank you for your order!</p>
        </div>
    </div>
</body>
</html>

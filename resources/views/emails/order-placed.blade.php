<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #0c0c0c; color: #ffffff; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background-color: #141414; border: 1px solid #333; border-radius: 12px; overflow: hidden; }
        .header { background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); padding: 40px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; font-weight: 900; letter-spacing: 2px; text-transform: uppercase; font-style: italic; }
        .content { padding: 40px; }
        .order-info { background: #1a1a1a; border-radius: 8px; padding: 20px; margin: 20px 0; border: 1px solid #222; }
        .order-info table { width: 100%; border-collapse: collapse; }
        .order-info td { padding: 8px 0; color: #999; font-size: 14px; }
        .order-info td.label { font-weight: bold; color: #fff; width: 120px; }
        .order-items { margin: 25px 0; }
        .order-items table { width: 100%; border-collapse: collapse; }
        .order-items th { text-align: left; border-bottom: 2px solid #333; padding-bottom: 10px; color: #ef4444; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }
        .order-items td { padding: 15px 0; border-bottom: 1px solid #222; font-size: 14px; color: #ddd; }
        .total-section { text-align: right; margin-top: 20px; }
        .total-section p { margin: 5px 0; font-size: 16px; font-weight: bold; }
        .total-section h2 { color: #ef4444; margin: 10px 0 0; }
        .footer { background: #0a0a0a; padding: 20px; text-align: center; font-size: 12px; color: #555; border-top: 1px solid #111; }
        .btn { display: inline-block; padding: 12px 30px; background-color: #ef4444; color: #fff; text-decoration: none; border-radius: 50px; font-weight: bold; text-transform: uppercase; font-size: 12px; margin-top: 20px; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>RENTAL<span style="color: #fff;">X</span></h1>
            <p style="margin: 10px 0 0; font-size: 14px; opacity: 0.9;">ORDER CONFIRMATION</p>
        </div>
        <div class="content">
            <h2 style="margin-top: 0; font-style: italic;">Thank you for your order, {{ $order->user->name }}!</h2>
            <p style="color: #999; line-height: 1.6;">We've received your order and we're getting it ready for delivery. Here's a summary of what you've purchased:</p>
            
            <div class="order-info">
                <table>
                    <tr>
                        <td class="label">Order Number:</td>
                        <td>#{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date:</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status:</td>
                        <td style="text-transform: uppercase; font-weight: bold; color: #f59e0b;">{{ $order->status }}</td>
                    </tr>
                    <tr>
                        <td class="label">Address:</td>
                        <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}</td>
                    </tr>
                </table>
            </div>

            <div class="order-items">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right;">Rs {{ number_format($item->price) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="total-section">
                <p style="color: #999;">Subtotal: Rs {{ number_format($order->subtotal) }}</p>
                @if($order->shipping_cost > 0)
                <p style="color: #999;">Shipping: Rs {{ number_format($order->shipping_cost) }}</p>
                @endif
                <h2>TOTAL: Rs {{ number_format($order->total_amount) }}</h2>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('profile.orders') }}" class="btn">View My Orders</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} RentalX Motors. All rights reserved.</p>
            <p>If you have any questions, contact us at support@rentalx.com</p>
        </div>
    </div>
</body>
</html>

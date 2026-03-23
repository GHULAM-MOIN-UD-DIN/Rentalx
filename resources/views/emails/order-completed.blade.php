<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #0c0c0c; color: #ffffff; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background-color: #141414; border: 1px solid #333; border-radius: 12px; overflow: hidden; }
        .header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 40px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; font-weight: 900; letter-spacing: 2px; text-transform: uppercase; font-style: italic; }
        .content { padding: 40px; }
        .order-info { background: #1a1a1a; border-radius: 8px; padding: 20px; margin: 20px 0; border: 1px solid #222; }
        .order-info table { width: 100%; border-collapse: collapse; }
        .order-info td { padding: 8px 0; color: #999; font-size: 14px; }
        .order-info td.label { font-weight: bold; color: #fff; width: 120px; }
        .order-items { margin: 25px 0; }
        .order-items table { width: 100%; border-collapse: collapse; }
        .order-items th { text-align: left; border-bottom: 2px solid #333; padding-bottom: 10px; color: #10b981; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }
        .order-items td { padding: 15px 0; border-bottom: 1px solid #222; font-size: 14px; color: #ddd; }
        .total-section { text-align: right; margin-top: 20px; }
        .total-section p { margin: 5px 0; font-size: 16px; font-weight: bold; }
        .total-section h2 { color: #10b981; margin: 10px 0 0; }
        .footer { background: #0a0a0a; padding: 20px; text-align: center; font-size: 12px; color: #555; border-top: 1px solid #111; }
        .btn { display: inline-block; padding: 12px 30px; background-color: #10b981; color: #fff; text-decoration: none; border-radius: 50px; font-weight: bold; text-transform: uppercase; font-size: 12px; margin-top: 20px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); }
        .success-seal { width: 80px; height: 80px; margin: 0 auto 20px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); border: 2px solid #10b981; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #10b981; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>RENTAL<span style="color: #fff;">X</span></h1>
            <p style="margin: 10px 0 0; font-size: 14px; opacity: 0.9;">ORDER COMPLETED</p>
        </div>
        <div class="content">
            <div class="success-seal">✓</div>
            <h2 style="margin-top: 0; font-style: italic; text-align: center;">Your Order is Complete!</h2>
            <p style="color: #999; line-height: 1.6; text-align: center;">We're happy to inform you that your order #{{ $order->order_number }} has been marked as complete. Thank you for choosing RentalX!</p>
            
            <div class="order-info">
                <table>
                    <tr>
                        <td class="label">Order ID:</td>
                        <td>#{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Total Paid:</td>
                        <td>Rs {{ number_format($order->total_amount) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status:</td>
                        <td style="text-transform: uppercase; font-weight: bold; color: #10b981;">COMPLETED</td>
                    </tr>
                </table>
            </div>

            <div class="order-items">
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th style="text-align: right;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td style="text-align: right;">Rs {{ number_format($item->price) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p style="text-align: center; color: #888; margin-top: 30px;">We hope you enjoy your purchase. We'd love to hear your feedback!</p>

            <div style="text-align: center;">
                <a href="{{ route('profile.orders') }}" class="btn">Rate your products</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} RentalX Motors. All rights reserved.</p>
            <p>You received this email because your order was completed on our platform.</p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Product Launched!</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 20px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #ef4444, #dc2626); padding: 30px; text-align: center; color: #fff; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 1px; }
        .content { padding: 30px; }
        .product-card { background: #fafafa; border: 1px solid #eee; border-radius: 12px; padding: 20px; text-align: center; margin: 20px 0; }
        .product-image { max-width: 100%; height: auto; border-radius: 8px; margin-bottom: 15px; }
        .product-name { font-size: 20px; font-weight: 700; color: #111; margin: 10px 0; }
        .product-price { font-size: 22px; font-weight: 900; color: #ef4444; margin: 10px 0; }
        .product-desc { font-size: 14px; color: #666; margin-bottom: 20px; }
        .btn { display: inline-block; background: #ef4444; color: #fff; text-decoration: none; padding: 12px 30px; border-radius: 50px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; }
        .footer { background: #f9f9f9; padding: 20px; text-align: center; color: #999; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>NEW ARRIVAL!</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>We are excited to announce that a brand new product has just arrived at our store!</p>
            
            <div class="product-card">
                @if($product->image)
                    <img src="{{ $message->embed(public_path('products/' . $product->image)) }}" alt="{{ $product->name }}" class="product-image">
                @endif
                <div class="product-name">{{ $product->name }}</div>
                <div class="product-price">Rs {{ number_format($product->price) }}</div>
                <p class="product-desc">{{ Str::limit($product->description, 150) }}</p>
                <a href="{{ route('product.details', $product->id) }}" class="btn">View Details</a>
            </div>
            
            <p>Check out our latest collection and find exactly what you're looking for.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} RentalX. All rights reserved.</p>
            <p>You are receiving this email because you registered on our platform.</p>
        </div>
    </div>
</body>
</html>

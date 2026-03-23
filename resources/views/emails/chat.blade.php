<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #075e54;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png');
            background-color: #e5ddd5;
        }
        .user-profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            background: rgba(255,255,255,0.9);
            padding: 10px;
            border-radius: 8px;
        }
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
            border: 2px solid #075e54;
        }
        .user-info h3 {
            margin: 0;
            color: #075e54;
        }
        .user-info p {
            margin: 0;
            font-size: 12px;
            color: #666;
        }
        .message-bubble {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 0 15px 15px 15px;
            max-width: 80%;
            position: relative;
            margin-bottom: 10px;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        }
        .message-bubble.mine {
            background-color: #dcf8c6;
            margin-left: auto;
            border-radius: 15px 15px 0 15px;
        }
        .message-text {
            color: #303030;
            font-size: 16px;
            line-height: 1.4;
        }
        .message-time {
            color: #999;
            font-size: 11px;
            text-align: right;
            margin-top: 5px;
        }
        .footer {
            background-color: #f0f0f0;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
        .btn-reply {
            display: inline-block;
            background-color: #25d366;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>New Chat Message Received</h2>
        </div>
        
        <div class="content">
            <div class="user-profile">
                @if($user->profile && $user->profile->profile_photo)
                    <img src="{{ $user->profile->profile_photo_url }}" class="avatar" alt="Avatar">
                @else
                    <div class="avatar" style="background-color: #075e54; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
                <div class="user-info">
                    <h3>{{ $user->name }}</h3>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            <div class="message-bubble">
                <div class="message-text">
                    @if($chatMessage->type == 'image')
                        <p>📷 Sent an image</p>
                    @elseif($chatMessage->type == 'file')
                        <p>📎 Sent a file: {{ $chatMessage->file_name }}</p>
                    @else
                        {{ $chatMessage->body }}
                    @endif
                </div>
                <div class="message-time">
                    {{ $chatMessage->created_at->format('h:i A') }}
                </div>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('admin.chat.index') }}" class="btn-reply">Reply in Dashboard</a>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated notification from RentalX Chat System.</p>
        </div>
    </div>
</body>
</html>

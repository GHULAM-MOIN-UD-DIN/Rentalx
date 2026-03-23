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
        .info-box { background: #1a1a1a; border-radius: 8px; padding: 20px; margin: 20px 0; border: 1px solid #222; }
        .info-box table { width: 100%; border-collapse: collapse; }
        .info-box td { padding: 8px 0; color: #999; font-size: 14px; }
        .info-box td.label { font-weight: bold; color: #fff; width: 140px; }
        .footer { background: #0a0a0a; padding: 20px; text-align: center; font-size: 12px; color: #555; border-top: 1px solid #111; }
        .btn { display: inline-block; padding: 12px 30px; background-color: #10b981; color: #fff; text-decoration: none; border-radius: 50px; font-weight: bold; text-transform: uppercase; font-size: 12px; margin-top: 20px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); }
        .success-seal { width: 80px; height: 80px; margin: 0 auto 20px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); border: 2px solid #10b981; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #10b981; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>RENTAL<span style="color: #fff;">X</span></h1>
            <p style="margin: 10px 0 0; font-size: 14px; opacity: 0.9;">APPOINTMENT CONFIRMED</p>
        </div>
        <div class="content">
            <div class="success-seal">✓</div>
            <h2 style="margin-top: 0; font-style: italic; text-align: center;">Great News!</h2>
            <p style="color: #999; line-height: 1.6; text-align: center;">Your appointment #{{ $appointment->id }} has been <strong>confirmed</strong>. We are excited to serve you!</p>
            
            <div class="info-box">
                <table>
                    <tr>
                        <td class="label">Appointment ID:</td>
                        <td>#{{ $appointment->id }}</td>
                    </tr>
                    <tr>
                        <td class="label">Car:</td>
                        <td>{{ $appointment->car_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status:</td>
                        <td style="color: #10b981; font-weight: bold; text-transform: uppercase;">CONFIRMED</td>
                    </tr>
                    <tr>
                        <td class="label">Pickup Date:</td>
                        <td>{{ $appointment->pickup_date->format('M d, Y') }} at {{ $appointment->pickup_time }}</td>
                    </tr>
                    <tr>
                        <td class="label">Return Date:</td>
                        <td>{{ $appointment->return_date->format('M d, Y') }} at {{ $appointment->return_time }}</td>
                    </tr>
                </table>
            </div>

            <p style="color: #888; text-align: center; margin-top: 30px;">We look forward to seeing you. If you have any questions, please contact our support.</p>

            <div style="text-align: center;">
                <a href="{{ route('profile.appointments') }}" class="btn">View Appointments</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} RentalX Motors. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

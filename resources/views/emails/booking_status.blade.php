@php
    // 🌟 Dynamic Colors
    $colors = [
        'Approved' => '#ea580c',   // Orange
        'Completed' => '#10b981',  // Emerald Green
        'Cancelled' => '#ef4444',  // Red
    ];
    $color = $colors[$booking->status] ?? '#ea580c';

    // 🌟 Dynamic Titles
    $titles = [
        'Approved' => 'Reservation Confirmed',
        'Completed' => 'Journey Completed',
        'Cancelled' => 'Reservation Cancelled',
    ];
    $title = $titles[$booking->status] ?? 'Status Updated';

    // 🌟 Dynamic Messages
    $messages = [
        'Approved' => 'Your premium reservation request has been formally approved by our executive team. Your vehicle is currently being prepped to meet the highest luxury standards.',
        'Completed' => 'Your vehicle has been successfully returned and your journey is marked as completed. Thank you for choosing Drive Elite. We hope to serve you again soon.',
        'Cancelled' => 'Your reservation has been cancelled. If this was a mistake or you have any questions, please contact our executive support team.',
    ];
    $messageText = $messages[$booking->status] ?? 'Your reservation status has been updated.';
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #0b1120; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #0b1120; padding: 40px 10px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #121b2f; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1); overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.5);">
                    
                    <tr>
                        <td align="center" style="padding: 40px 0 20px 0; border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 900; letter-spacing: 1px;">
                                Drive<span style="color: {{ $color }};">Elite.</span>
                            </h1>
                            <p style="margin: 10px 0 0 0; color: {{ $color }}; font-size: 10px; font-weight: bold; text-transform: uppercase; letter-spacing: 3px;">
                                {{ $title }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px 40px 20px 40px;">
                            <h2 style="margin: 0 0 15px 0; color: #ffffff; font-size: 22px;">Dear {{ $booking->user->name }},</h2>
                            <p style="margin: 0; color: #a1a1aa; font-size: 15px; line-height: 1.6;">
                                {{ $messageText }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 30px 40px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #0b1120; border-radius: 12px; border: 1px solid {{ $color }}; padding: 25px;">
                                <tr>
                                    <td colspan="2" style="padding-bottom: 15px;">
                                        <h3 style="margin: 0; color: #ffffff; font-size: 18px;">{{ $booking->car->brand }} <span style="color: {{ $color }}; font-size: 14px;">{{ $booking->car->model_name }}</span></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 8px 0; color: #a1a1aa; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">Start Date</td>
                                    <td width="50%" align="right" style="padding: 8px 0; color: #ffffff; font-size: 14px; font-weight: bold;">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 8px 0; color: #a1a1aa; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">End Date</td>
                                    <td width="50%" align="right" style="padding: 8px 0; color: #ffffff; font-size: 14px; font-weight: bold;">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 8px 0; color: #a1a1aa; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">Status</td>
                                    <td width="50%" align="right" style="padding: 8px 0; color: {{ $color }}; font-size: 14px; font-weight: bold; text-transform: uppercase;">{{ $booking->status }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.1);"></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 15px 0 0 0; color: {{ $color }}; font-size: 14px; text-transform: uppercase; font-weight: bold; letter-spacing: 1px;">Total Investment</td>
                                    <td width="50%" align="right" style="padding: 15px 0 0 0; color: {{ $color }}; font-size: 20px; font-weight: bold;">Rs. {{ number_format($booking->total_price) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 0 40px 40px 40px;">
                            <a href="{{ route('dashboard') }}" style="display: inline-block; background-color: {{ $color }}; color: #ffffff; text-decoration: none; padding: 14px 30px; font-size: 14px; font-weight: bold; border-radius: 8px; text-transform: uppercase; letter-spacing: 1px;">Access Dashboard</a>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #0b1120; padding: 20px; border-top: 1px solid rgba(255,255,255,0.05);">
                            <p style="margin: 0; color: #52525b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">
                                &copy; {{ date('Y') }} Drive Elite. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
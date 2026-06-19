<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; font-size: 14px; line-height: 1.6; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
        .header { width: 100%; margin-bottom: 40px; border-bottom: 2px solid #f1f1f1; padding-bottom: 20px; }
        .title { font-size: 32px; font-weight: bold; color: #111; text-transform: uppercase; letter-spacing: 1px; }
        .title span { color: #dc2626; } 
        .info { text-align: right; color: #555; line-height: 1.4; }
        .contact-section { width: 100%; margin-bottom: 30px; border-collapse: collapse; }
        .contact-section td { vertical-align: top; width: 50%; padding: 5px; }
        .details-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .details-table th, .details-table td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        .details-table th { background-color: #f8f8f8; font-weight: bold; color: #333; text-transform: uppercase; font-size: 12px; }
        .total-row td { font-weight: bold; font-size: 18px; color: #111; border-top: 2px solid #333; padding-top: 15px; }
        .footer { margin-top: 50px; text-align: center; color: #777; font-size: 11px; text-transform: uppercase; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table class="header">
            <tr>
                <td class="title">
                    {{ explode(' ', $settings['company_name'] ?? 'Drive Elite')[0] }}<span>{{ explode(' ', $settings['company_name'] ?? 'Elite')[1] ?? 'Elite' }}</span>
                </td>
                <td class="info">
                    <strong>Invoice #:</strong> {{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}<br>
                    <strong>Created:</strong> {{ now()->format('F d, Y') }}<br>
                    <strong>Status:</strong> <span style="color: {{ $booking->status == 'Approved' ? '#16a34a' : '#ea580c' }}">{{ strtoupper($booking->status) }}</span>
                </td>
            </tr>
        </table>

        <table class="contact-section">
            <tr>
                <td>
                    <strong style="color: #dc2626; text-transform: uppercase; font-size: 11px; tracking-widest: 1px;">Billed To:</strong><br>
                    <span style="font-size: 16px; font-weight: bold; color: #111;">{{ $booking->user->name ?? 'VIP Client' }}</span><br>
                    {{ $booking->user->email ?? 'N/A' }}<br>
                    {{-- 📱 Phone column missing in DB, so hiding this for now --}}
                </td>

                <td style="text-align: right;">
                    <strong style="text-transform: uppercase; font-size: 11px; tracking-widest: 1px;">Issued By:</strong><br>
                    <span style="font-weight: bold; font-size: 15px;">{{ $settings['company_name'] ?? 'Drive Elite Rentals' }}</span><br>
                    {{ $settings['company_address'] ?? 'Sargodha' }}<br>
                    {{ $settings['company_phone'] ?? '+923467369941' }}<br>
                    {{ $settings['company_email'] ?? 'huzaifakhokhar413@gmail.com' }} 
                </td>
            </tr>
        </table>

        <table class="details-table">
            <thead>
                <tr>
                    <th>Vehicle Details</th>
                    <th>Booking Period</th>
                    <th>Days</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong style="color: #111; font-size: 15px;">{{ $booking->car->brand ?? 'Luxury' }} {{ $booking->car->model_name ?? 'Vehicle' }}</strong><br>
                        <span style="font-size: 11px; color: #777;">{{ $booking->car->category->name ?? 'Premium Fleet' }}</span>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }} - <br>
                        {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                    </td>
                    <td>{{ $booking->total_days }} Days</td>
                    <td style="text-align: right; font-weight: bold;">Rs. {{ number_format($booking->total_price) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">Grand Total:</td>
                    <td style="text-align: right; color: #dc2626;">Rs. {{ number_format($booking->total_price) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            THANK YOU FOR CHOOSING {{ strtoupper($settings['company_name'] ?? 'DRIVE ELITE') }}.<br>
            FOR ANY QUERIES REGARDING THIS RESERVATION, PLEASE CONTACT OUR VIP SUPPORT.
        </div>
    </div>
</body>
</html>
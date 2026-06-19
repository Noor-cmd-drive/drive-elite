<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Your Password</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #09090b; color: #ffffff; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #18181b; border: 1px solid #27272a; border-radius: 12px; overflow: hidden; }
        .header { background-color: #09090b; padding: 30px; text-align: center; border-bottom: 2px solid #dc2626; }
        .header h1 { margin: 0; color: #ffffff; font-size: 28px; letter-spacing: 2px; text-transform: uppercase; }
        .header h1 span { color: #dc2626; }
        .content { padding: 40px 30px; text-align: center; }
        .content h2 { font-size: 22px; margin-top: 0; color: #f4f4f5; }
        .content p { color: #a1a1aa; font-size: 16px; line-height: 1.6; margin-bottom: 30px; }
        .btn-container { text-align: center; margin: 40px 0; }
        .btn { background-color: #dc2626; color: #ffffff; text-decoration: none; padding: 16px 32px; border-radius: 8px; font-weight: bold; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; display: inline-block; }
        .footer { background-color: #09090b; padding: 20px; text-align: center; border-top: 1px solid #27272a; }
        .footer p { color: #71717a; font-size: 12px; margin: 5px 0; text-transform: uppercase; letter-spacing: 1px; }
        .dev-badge { display: inline-block; background-color: #18181b; padding: 8px 16px; border-radius: 20px; font-size: 10px; margin-top: 10px; border: 1px solid #27272a; color: #a1a1aa; }
        .dev-badge span { color: #ffffff; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Drive<span>Elite</span></h1>
        </div>

        <div class="content">
            <h2>Authentication Security Alert</h2>
            <p>Hello <strong>{{ $user->name }}</strong>,<br><br>
            We received a request to reset the password for your exclusive DriveElite account. If you made this request, please click the secure button below to choose a new password.</p>
            
            <div class="btn-container">
                <a href="{{ $url }}" class="btn">Reset My Password</a>
            </div>

            <p style="font-size: 14px;">This secure link will expire in 60 minutes.<br>If you did not request a password reset, no further action is required and your vault remains secure.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} DriveElite. All Rights Reserved.</p>
            <div class="dev-badge">
                Developed by <span>NOOR NOSHAD</span>
            </div>
        </div>
    </div>
</body>
</html>
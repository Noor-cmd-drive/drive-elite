<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - DriveElite</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; max-width: 400px; width: 100%; }
        h2 { color: #f97316; margin-bottom: 10px; }
        p { color: #555; margin-bottom: 20px; }
        input[type="text"] { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; text-align: center; letter-spacing: 2px; }
        button { background-color: #f97316; color: white; border: none; padding: 12px 20px; border-radius: 5px; font-size: 16px; cursor: pointer; width: 100%; font-weight: bold; }
        button:hover { background-color: #ea580c; }
        .error { color: red; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Email Verification</h2>
        <p>We've sent a 6-digit OTP to your email. Please enter it below to complete registration.</p>

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('emergency_otp'))
            <div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 12px; border-radius: 5px; margin-bottom: 20px; font-weight: bold; text-align: center;">
                ⚠️ Server Delay Bypass - Your OTP is: <span style="font-size: 18px;">{{ session('emergency_otp') }}</span>
            </div>
        @endif

        <form action="{{ route('verify.otp.submit') }}" method="POST">
            @csrf
            <input type="text" name="otp" placeholder="Enter 6-digit OTP" required maxlength="6" pattern="\d{6}">
            <button type="submit">Verify & Register</button>
        </form>
    </div>

</body>
</html>
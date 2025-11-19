<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - OTP Verification</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color: #f9fafb;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="400" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 30px;">
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <h1 style="margin:0; font-size: 24px; color: #ea580c;">{{ config('app.name') }}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 20px; text-align: center; color: #4b5563; font-size: 16px;">
                            <p>Use the OTP below to verify your email. This code is valid for 5 minutes.</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <span
                                style="
                                display: inline-block;
                                background-color: #ffedd5;  /* primary-accent */
                                color: #ea580c;             /* primary-main */
                                font-size: 28px;
                                font-weight: bold;
                                padding: 15px 25px;
                                border-radius: 8px;
                                letter-spacing: 4px;
                                border: 2px solid #c2410c; /* primary-dark */
                            ">
                                {{ $otp }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; color: #9ca3af; font-size: 14px;">
                            <p>If you did not request this code, please ignore this email.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

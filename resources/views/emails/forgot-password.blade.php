<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">
    <table role="presentation" width="100%" bgcolor="#f4f4f4" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table role="presentation" width="600px" bgcolor="#ffffff" cellpadding="0" cellspacing="0" style="border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <img src="https://i.ibb.co/TBpX5Vd4/taskflowlogo.png" alt="TaskFlow Logo" style="max-width: 150px;">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 22px; font-weight: bold; color: #333;">
                            Password Reset Request
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 16px; color: #555; padding: 15px;">
                            You are receiving this email because we received a password reset request for your account.
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <a href="{{ route('reset', $token) }}" style="display: inline-block; padding: 12px 20px; font-size: 16px; font-weight: bold; color: #ffffff; background-color: #b41d18; text-decoration: none; border-radius: 5px;">
                                Reset Password
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 14px; color: #777; padding: 15px;">
                            If you did not request a password reset, no further action is required.
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 12px; color: #777; padding: 20px;">
                            &copy; {{ date('Y') }} TaskFlow. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Form Confirmation</title>
</head>
<body style="margin:0; padding:0; background:#f4f6f8; font-family:Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8; padding:20px;">
<tr>
<td align="center">
    <table width="600" cellpadding="0" cellspacing="0" style="background:#fff; border-radius:6px; overflow:hidden;">
        <!-- Header -->
        <tr>
            <td align="center" style="padding:15px; border-bottom:1px solid #e5e5e5;">
                <img src="https://henichemicals.com/public/frontend/img/logo/heni-logo.png" alt="Heni Chemicals" style="width:140px; display:block;">
            </td>
        </tr>


        <!-- Body -->
        <tr>
            <td style="padding:25px; color:#333; font-size:14px; line-height:22px;">
                <p><strong>Dear {{ $name }},</strong></p>
                <p>Thank you for contacting Heni Chemicals.</p>
                <p>We have received your enquiry regarding: <strong>{{ $subject_text }}</strong></p>
               
                <p>Our team will get back to you shortly.</p>
                <p>Best regards,<br>Team Heni Chemicals</p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background:#f1f1f1; padding:15px; text-align:center; font-size:12px; color:#666;">
                <p style="margin:0;">© {{ date('Y') }} Heni Chemicals. All rights reserved.</p>
                <p style="margin:5px 0 0;">This is an automated email. Please do not reply.</p>
            </td>
        </tr>
    </table>
</td>
</tr>
</table>
</body>
</html>

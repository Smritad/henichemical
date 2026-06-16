<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Brochure Enquiry - Heni Chemicals</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:20px;">
    <tr>
        <td align="center">

            <!-- Main Container -->
            <table width="600" cellpadding="0" cellspacing="0"
                   style="background-color:#ffffff; border-radius:6px; overflow:hidden;">

                <!-- Header -->
                <tr>
                    <td align="center" style="padding:15px; border-bottom:1px solid #e5e5e5;">
                        <img src="https://henichemicals.com/public/frontend/img/logo/heni-logo.png"
                             alt="Heni Chemicals"
                             style="max-width:140px; width:140px; height:auto; display:block;">
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:25px; color:#333333; font-size:14px; line-height:22px;">
                        <p style="margin-top:0;"><strong>New Brochure Enquiry Received</strong></p>

                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:15px;">
                            <tr>
                                <td style="padding:8px 0; width:35%;"><strong>Brochure Title:</strong></td>
                                <td style="padding:8px 0;">{{ $brochure_title }}</td>
                            </tr>
                            <tr>
                                <td style="padding:8px 0;"><strong>Email:</strong></td>
                                <td style="padding:8px 0;">{{ $email }}</td>
                            </tr>
                            <tr>
                                <td style="padding:8px 0;"><strong>Mobile No:</strong></td>
                                <td style="padding:8px 0;">{{ $mobile_no }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color:#f1f1f1; padding:15px; text-align:center; font-size:12px; color:#666666;">
                        <p style="margin:0;">
                            © {{ date('Y') }} Heni Chemicals. All rights reserved.
                        </p>
                        <p style="margin:5px 0 0;">
                            This is an automated email. Please do not reply.
                        </p>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>

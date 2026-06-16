<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Product Document Enquiry</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:20px 0;">
    <tr>
        <td align="center">

            <!-- Main Container -->
            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:6px; overflow:hidden;">

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
                    <td style="padding:30px; color:#333333;">
                        <h2 style="margin-top:0; color:#1a1a1a;">Product Document Enquiry Details</h2>

                        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
                            <tr>
                                <td style="font-weight:bold; width:40%;">Product Name:</td>
                                <td>{{ $product_name }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;">Document Name:</td>
                                <td>{{ $pdf_display_name }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;">Email:</td>
                                <td>{{ $email }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;">Mobile No:</td>
                                <td>{{ $mobile_no }}</td>
                            </tr>
                        </table>

                        <p style="margin-top:30px;">
                            Best regards,<br>
                            <strong>Team Heni Chemicals</strong>
                        </p>
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
            <!-- End Container -->

        </td>
    </tr>
</table>

</body>
</html>

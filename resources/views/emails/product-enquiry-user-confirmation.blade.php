<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enquiry Confirmation</title>
</head>
<body style="font-family:Arial,sans-serif; background:#f4f4f4; margin:0; padding:0;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:30px 0;">
  <tr>
    <td align="center">
      <table width="620" cellpadding="0" cellspacing="0" style="background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.08);">

        {{-- ── Logo Header ── --}}
        <tr>
          <td align="center" style="padding:15px; border-bottom:1px solid #e5e5e5;">
            <img src="https://henichemicals.com/public/frontend/img/logo/heni-logo.png"
                 alt="Heni Chemicals"
                 style="width:140px; display:block;">
          </td>
        </tr>

        {{-- ── Green Title Bar ── --}}
        <tr>
          <td align="center" style="background:#28a745; padding:28px 30px;">
            <h1 style="color:#fff; margin:0; font-size:22px; font-family:Arial,sans-serif;">
              Thank You for Your Enquiry!
            </h1>
            <p style="color:#d4edda; margin:6px 0 0; font-size:13px; font-family:Arial,sans-serif;">
              We have received your request successfully
            </p>
          </td>
        </tr>

        {{-- ── Body ── --}}
        <tr>
          <td style="padding:30px;">

            <p style="color:#444; font-size:15px; line-height:1.7; margin:0 0 14px; font-family:Arial,sans-serif;">
              Dear <strong>{{ $name }}</strong>,
            </p>

            <p style="color:#444; font-size:15px; line-height:1.7; margin:0 0 14px; font-family:Arial,sans-serif;">
              Thank you for contacting <strong>HENI Chemicals</strong>.
              We have received your enquiry and our team will get back to you shortly.
            </p>

            <p style="color:#444; font-size:15px; line-height:1.7; margin:0 0 14px; font-family:Arial,sans-serif;">
              Here is a summary of what you enquired about:
            </p>

            {{-- Summary Table --}}
            <table width="100%" cellpadding="0" cellspacing="0"
                   style="border-collapse:collapse; margin:10px 0 24px;">
              <tr>
                <td style="padding:12px 16px; font-size:14px; color:#555; font-weight:bold;
                           border-bottom:1px solid #eee; width:38%; white-space:nowrap;
                           font-family:Arial,sans-serif;">
                  Product Name
                </td>
                <td style="padding:12px 16px; font-size:14px; color:#333;
                           border-bottom:1px solid #eee; font-family:Arial,sans-serif;">
                  <span style="display:inline-block; background:#e3f2fd; color:#0d47a1;
                               padding:4px 14px; border-radius:20px; font-size:13px;
                               font-weight:bold;">
                    {{ $product_name }}
                  </span>
                </td>
              </tr>

              @if(!empty($industry_type))
              <tr style="background:#f9f9f9;">
                <td style="padding:12px 16px; font-size:14px; color:#555; font-weight:bold;
                           border-bottom:1px solid #eee; white-space:nowrap;
                           font-family:Arial,sans-serif;">
                  Industry / Application
                </td>
                <td style="padding:12px 16px; font-size:14px; color:#333;
                           border-bottom:1px solid #eee; font-family:Arial,sans-serif;">
                  <span style="display:inline-block; background:#e8f5e9; color:#1b5e20;
                               padding:4px 14px; border-radius:20px; font-size:13px;
                               font-weight:bold;">
                    {{ $industry_type }}
                  </span>
                </td>
              </tr>
              @endif
            </table>


          </td>
        </tr>

        {{-- ── Footer ── --}}
        <tr>
          <td style="background:#f1f1f1; padding:15px; text-align:center;
                     font-size:12px; color:#666; font-family:Arial,sans-serif;">
            <p style="margin:0;">
              &copy; {{ date('Y') }} Heni Chemicals. All rights reserved.
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
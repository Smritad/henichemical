<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Product Enquiry</title>
</head>
<body style="font-family:Arial,sans-serif; background:#f4f4f4; margin:0; padding:0;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:30px 0;">
  <tr>
    <td align="center">
      <table width="620" cellpadding="0" cellspacing="0"
             style="background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.08);">

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
            <h1 style="color:#fff; margin:0; font-size:22px; letter-spacing:.5px;
                       font-family:Arial,sans-serif;">
              New Product Enquiry
            </h1>
            @if(!empty($industry_type))
              <p style="color:#d4edda; margin:6px 0 0; font-size:13px;
                        font-family:Arial,sans-serif;">
                {{ $industry_type }} &rsaquo; {{ $product_name }}
              </p>
            @else
              <p style="color:#d4edda; margin:6px 0 0; font-size:13px;
                        font-family:Arial,sans-serif;">
                {{ $product_name }}
              </p>
            @endif
          </td>
        </tr>

        {{-- ── Body ── --}}
        <tr>
          <td style="padding:30px;">

            <p style="color:#444; font-size:15px; line-height:1.6; margin:0 0 8px;
                      font-family:Arial,sans-serif;">
              A new product enquiry has been submitted. Full details below:
            </p>

            {{-- Details Table --}}
            <table width="100%" cellpadding="0" cellspacing="0"
                   style="border-collapse:collapse; margin-top:20px;">

              {{-- Name --}}
              <tr>
                <td style="padding:12px 16px; font-size:14px; color:#555; font-weight:bold;
                           border-bottom:1px solid #eee; width:38%; white-space:nowrap;
                           font-family:Arial,sans-serif;">
                  Name
                </td>
                <td style="padding:12px 16px; font-size:14px; color:#333;
                           border-bottom:1px solid #eee; font-family:Arial,sans-serif;">
                  {{ $customer_name }}
                </td>
              </tr>

              {{-- Email --}}
              <tr style="background:#f9f9f9;">
                <td style="padding:12px 16px; font-size:14px; color:#555; font-weight:bold;
                           border-bottom:1px solid #eee; white-space:nowrap;
                           font-family:Arial,sans-serif;">
                  Email
                </td>
                <td style="padding:12px 16px; font-size:14px; color:#333;
                           border-bottom:1px solid #eee; font-family:Arial,sans-serif;">
                  <a href="mailto:{{ $customer_email }}"
                     style="color:#28a745; text-decoration:none;">
                    {{ $customer_email }}
                  </a>
                </td>
              </tr>

              {{-- Mobile --}}
              <tr>
                <td style="padding:12px 16px; font-size:14px; color:#555; font-weight:bold;
                           border-bottom:1px solid #eee; white-space:nowrap;
                           font-family:Arial,sans-serif;">
                  Mobile No.
                </td>
                <td style="padding:12px 16px; font-size:14px; color:#333;
                           border-bottom:1px solid #eee; font-family:Arial,sans-serif;">
                  {{ $customer_mobile }}
                </td>
              </tr>

              {{-- Industry --}}
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

              {{-- Brand --}}
              @if(!empty($brand_name))
              <tr>
                <td style="padding:12px 16px; font-size:14px; color:#555; font-weight:bold;
                           border-bottom:1px solid #eee; white-space:nowrap;
                           font-family:Arial,sans-serif;">
                  Brand
                </td>
                <td style="padding:12px 16px; font-size:14px; color:#333;
                           border-bottom:1px solid #eee; font-family:Arial,sans-serif;">
                  {{ $brand_name }}
                </td>
              </tr>
              @endif

              {{-- Product Name --}}
              <tr style="background:#f9f9f9;">
                <td style="padding:12px 16px; font-size:14px; color:#555; font-weight:bold;
                           border-bottom:1px solid #eee; white-space:nowrap;
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

              {{-- Message --}}
              @if(!empty($customer_message))
              <tr>
                <td style="padding:12px 16px; font-size:14px; color:#555; font-weight:bold;
                           border-bottom:1px solid #eee; white-space:nowrap;
                           font-family:Arial,sans-serif;">
                  Message
                </td>
                <td style="padding:12px 16px; font-size:14px; color:#333;
                           border-bottom:1px solid #eee; font-family:Arial,sans-serif;">
                  <div style="background:#f9f9f9; border-left:4px solid #28a745;
                              padding:12px 16px; border-radius:4px; font-size:14px;
                              color:#444; line-height:1.6; font-family:Arial,sans-serif;">
                    {{ $customer_message }}
                  </div>
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
              Enquiry submitted via
              <a href="https://henichemicals.com"
                 style="color:#28a745; text-decoration:none;">
                henichemicals.com
              </a>
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>
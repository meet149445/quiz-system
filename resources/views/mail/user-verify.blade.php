<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Quiz System - Verify Email</title>
</head>
<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fb;">
    <tr>
        <td align="center" style="padding:30px 15px;">

```
        <table width="100%" cellpadding="0" cellspacing="0"
               style="max-width:600px;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 8px 30px rgba(0,0,0,0.08);">

            <tr>
                <td style="background:#4f46e5;padding:35px;text-align:center;">
                    <h1 style="margin:0;color:#ffffff;font-size:28px;">
                        Quiz System
                    </h1>

                    <p style="margin-top:10px;color:#e0e7ff;font-size:14px;">
                        🎉 Email Verification Required
                    </p>
                </td>
            </tr>

            <tr>
                <td style="padding:40px 35px;">

                    <h2 style="margin-top:0;color:#111827;font-size:24px;">
                        Welcome!
                    </h2>

                    <p style="color:#6b7280;line-height:1.8;font-size:15px;">
                        Thank you for creating your account on
                        <strong>Quiz System</strong>.
                    </p>

                    <p style="color:#6b7280;line-height:1.8;font-size:15px;">
                        To activate your account and start taking quizzes,
                        please verify your email address by clicking the button below.
                    </p>

                    <div style="text-align:center;margin:35px 0;">
                        <a href="{{ $link }}"
                           style="background:#4f46e5;
                                  color:#ffffff;
                                  text-decoration:none;
                                  padding:16px 36px;
                                  border-radius:10px;
                                  display:inline-block;
                                  font-weight:bold;
                                  font-size:15px;">
                            Verify Email
                        </a>
                    </div>

                    <p style="color:#9ca3af;font-size:14px;line-height:1.7;">
                        If you didn't create an account, you can safely ignore this email.
                    </p>

                    <hr style="border:none;border-top:1px solid #e5e7eb;margin:30px 0;">

                    <p style="color:#9ca3af;font-size:12px;word-break:break-all;">
                        If the button doesn't work, copy and paste this link into your browser:
                        <br><br>
                        {{ $link }}
                    </p>

                </td>
            </tr>

            <tr>
                <td style="background:#f9fafb;padding:20px;text-align:center;">

                    <p style="margin:0;color:#6b7280;font-size:13px;">
                        © {{ date('Y') }} Quiz System. All rights reserved.
                    </p>

                </td>
            </tr>

        </table>

    </td>
</tr>
```

</table>

</body>
</html>

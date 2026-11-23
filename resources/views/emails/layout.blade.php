<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ setting('site.name') }}</title>
</head>
<body style="margin:0;padding:0;background:#EEF9FF;font-family:Arial,Helvetica,sans-serif;color:#091E3E;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#EEF9FF;padding:24px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:12px;overflow:hidden;">
                <tr>
                    <td style="background:#091E3E;padding:22px 28px;color:#ffffff;font-size:18px;font-weight:bold;">
                        {{ setting('site.name') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding:28px;font-size:15px;line-height:1.6;">
                        @yield('content')
                    </td>
                </tr>
                <tr>
                    <td style="background:#06A3DA;padding:16px 28px;color:#ffffff;font-size:13px;">
                        {{ setting('contact.phone') }} &nbsp;|&nbsp; {{ setting('contact.email') }}<br>
                        {{ setting('contact.address_full') }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>

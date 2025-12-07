@php
    $appName = config('app.name');
    $header = config('settings.mail_header');
    $footer = config('settings.mail_footer');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $appName }}</title>
    <style>
        :root {
            --brand-start: #2563eb; /* blue */
            --brand-end: #6b21a8;   /* purple */
            --surface: #0b1222;
            --card: #0f1a30;
            --muted: #9db4d7;
            --text: #e8edf7;
            --accent: #a5b4fc;
        }

        body {
            margin: 0;
            padding: 0;
            background: radial-gradient(80% 80% at 20% 20%, rgba(37, 99, 235, 0.12), transparent),
                        radial-gradient(70% 70% at 80% 0%, rgba(107, 33, 168, 0.14), transparent),
                        #050a18;
            color: var(--text);
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, 'Helvetica Neue', sans-serif;
        }

        .wrapper {
            width: 100%;
            padding: 32px 12px;
        }

        .container {
            max-width: 640px;
            margin: 0 auto;
            background: var(--card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 18px;
            box-shadow: 0 30px 120px rgba(0, 0, 0, 0.35);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, var(--brand-start), var(--brand-end));
            padding: 28px 32px;
            color: #ffffff;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.4px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .body {
            padding: 32px;
            line-height: 1.7;
            color: var(--text);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.01), rgba(255, 255, 255, 0.03));
        }

        .body h1,
        .body h2,
        .body h3,
        .body h4 {
            color: #ffffff;
            margin-top: 0;
            letter-spacing: -0.4px;
        }

        .body p {
            margin: 0 0 14px;
            color: var(--muted);
        }

        .body a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .body a:hover {
            text-decoration: underline;
        }

        .footer {
            padding: 22px 32px 28px;
            background: #0b1222;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .footer strong {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <div class="brand">
                    <span>✦</span>
                    <span>{{ $appName }}</span>
                </div>
                <div class="pill">إشعارات {{ $appName }}</div>
                @if($header)
                    <div style="margin-top:14px; font-size:14px; line-height:1.6; opacity:0.92;">
                        {!! Illuminate\View\Compilers\BladeCompiler::render($header) !!}
                    </div>
                @endif
            </div>

            <div class="body">
                {!! \Illuminate\Support\Str::markdown($slot) !!}
            </div>

            <div class="footer">
                @if($footer)
                    {!! Illuminate\View\Compilers\BladeCompiler::render($footer) !!}
                @else
                    <div><strong>{{ $appName }}</strong> — كل الحقوق محفوظة.</div>
                    <div>نُرسل لك هذه الرسائل لإبقائك على اطلاع بأحدث التحديثات والإشعارات.</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>

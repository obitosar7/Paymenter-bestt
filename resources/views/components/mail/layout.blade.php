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
            --brand-start: #2563eb; /* sapphire blue */
            --brand-end: #7c3aed;   /* royal purple */
            --brand-mid: #4f46e5;
            --canvas: #0b1021;
            --card: #0f172a;
            --surface: #101828;
            --ink: #0f172a;
            --muted: #4b5563;
            --text: #0f172a;
            --soft-text: #475467;
            --border: #e5e7eb;
            --glow: rgba(79, 70, 229, 0.16);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: radial-gradient(120% 120% at 20% 20%, rgba(37, 99, 235, 0.12), transparent),
                        radial-gradient(110% 110% at 80% 0%, rgba(124, 58, 237, 0.12), transparent),
                        linear-gradient(145deg, #0b1021 0%, #0c142b 100%);
            color: var(--ink);
            font-family: 'Inter', 'Segoe UI', -apple-system, BlinkMacSystemFont, 'Helvetica Neue', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .wrapper {
            width: 100%;
            padding: 36px 12px 42px;
        }

        .container {
            max-width: 680px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 40px 120px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.05);
            overflow: hidden;
            border: 1px solid #e8eaf0;
        }

        .top-bar {
            height: 5px;
            background: linear-gradient(120deg, var(--brand-start), var(--brand-mid), var(--brand-end));
        }

        .header {
            background: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.18), transparent 52%),
                        radial-gradient(circle at 80% 0%, rgba(124, 58, 237, 0.18), transparent 46%),
                        linear-gradient(135deg, rgba(37, 99, 235, 0.16), rgba(124, 58, 237, 0.22));
            padding: 26px 32px 20px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            inset: 12px 18px 10px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.12), rgba(124, 58, 237, 0.16));
            filter: blur(12px);
            z-index: 0;
        }

        .brand-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            position: relative;
            z-index: 1;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 20px;
            color: #0b1021;
            letter-spacing: -0.3px;
        }

        .brand .logo-slot {
            display: grid;
            place-items: center;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: radial-gradient(circle at 24% 24%, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.24)),
                        linear-gradient(135deg, rgba(37, 99, 235, 0.18), rgba(124, 58, 237, 0.28));
            box-shadow: 0 10px 28px rgba(79, 70, 229, 0.28);
            padding: 6px;
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .brand .logo-slot img,
        .footer .brandmark img {
            max-height: 44px;
            max-width: 100%;
            object-fit: contain;
            border-radius: 12px;
        }

        .brand .logo-slot p {
            margin: 0;
        }

        .brand .logo-slot svg {
            width: 100%;
            height: 100%;
        }

        .brand .logo-fallback {
            width: 100%;
            height: 100%;
            border-radius: 14px;
            background: linear-gradient(140deg, var(--brand-start), var(--brand-end));
            display: grid;
            place-items: center;
            color: #ffffff;
            font-size: 18px;
            letter-spacing: 0.5px;
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            color: #111827;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.2px;
        }

        .eyebrow {
            margin: 18px 0 6px;
            color: #111827;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            position: relative;
            z-index: 1;
        }

        .strapline {
            margin: 0;
            color: #1f2937;
            font-weight: 600;
            font-size: 24px;
            letter-spacing: -0.4px;
            position: relative;
            z-index: 1;
        }

        .content {
            padding: 30px 32px 34px;
            color: var(--text);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.8) 0%, rgba(245, 247, 252, 0.8) 100%);
            position: relative;
        }

        .content::before {
            content: '';
            position: absolute;
            inset: 14px 18px 10px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(124, 58, 237, 0.06));
            z-index: 0;
        }

        .content-inner {
            position: relative;
            z-index: 1;
        }

        .content h1,
        .content h2,
        .content h3,
        .content h4 {
            color: #0f172a;
            margin: 12px 0 12px;
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        .content p {
            margin: 0 0 16px;
            color: var(--soft-text);
            line-height: 1.7;
            font-size: 15px;
        }

        .content a {
            color: #ffffff;
            background: linear-gradient(135deg, var(--brand-start), var(--brand-end));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 18px 35px rgba(79, 70, 229, 0.32);
        }

        .content a:hover {
            transform: translateY(-1px);
            box-shadow: 0 22px 40px rgba(79, 70, 229, 0.38);
        }

        .content code {
            font-family: 'SFMono-Regular', Menlo, Consolas, 'Liberation Mono', monospace;
            background: #0f172a;
            color: #e0e7ff;
            padding: 2px 8px;
            border-radius: 8px;
        }

        .content blockquote {
            margin: 0 0 18px;
            padding: 14px 18px;
            border-left: 4px solid var(--brand-mid);
            background: #f5f7fb;
            color: #1f2937;
            border-radius: 12px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin: 18px 0;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.04);
        }

        .content thead {
            background: linear-gradient(120deg, rgba(37, 99, 235, 0.06), rgba(124, 58, 237, 0.08));
        }

        .content th,
        .content td {
            padding: 14px 16px;
            text-align: left;
            font-size: 14px;
            color: #111827;
            border-bottom: 1px solid #e5e7eb;
        }

        .content tr:last-child td {
            border-bottom: none;
        }

        .content hr {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 24px 0;
        }

        .footer {
            padding: 22px 32px 26px;
            background: #0f172a;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            color: #cbd5e1;
            font-size: 13px;
            line-height: 1.6;
            text-align: center;
        }

        .footer .brandmark {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #e0e7ff;
        }

        .footer a {
            color: #c7d2fe;
            font-weight: 600;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                border-radius: 16px;
            }

            .header,
            .content,
            .footer {
                padding: 24px;
            }

            .brand {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="top-bar"></div>
            <div class="header">
                <div class="brand-row">
                    <div class="brand">
                        <div class="logo-slot">
                            @if($header)
                                {!! Illuminate\View\Compilers\BladeCompiler::render($header) !!}
                            @else
                                <img src="https://i.ibb.co/kVgQNsXp/image.png" alt="{{ $appName }}" loading="lazy">
                            @endif
                        </div>
                        <span>{{ $appName }}</span>
                    </div>
                    <div class="meta-pill">Account updates · Secure &amp; reliable</div>
                </div>

                <div class="eyebrow">Stay in control</div>
                <h1 class="strapline">Beautifully crafted notifications for {{ $appName }}</h1>
            </div>

            <div class="content">
                <div class="content-inner">
                    {!! \Illuminate\Support\Str::markdown($slot) !!}
                </div>
            </div>

            <div class="footer">
                @if($footer)
                    {!! Illuminate\View\Compilers\BladeCompiler::render($footer) !!}
                @else
                    <div class="brandmark">
                        <img src="https://i.ibb.co/kVgQNsXp/image.png" alt="{{ $appName }}" loading="lazy">
                        <span>{{ $appName }}</span>
                    </div>
                    <div style="margin-top:6px;">© {{ date('Y') }} {{ $appName }}. All rights reserved.</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>

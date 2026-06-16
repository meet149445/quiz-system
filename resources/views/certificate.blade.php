<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate of Achievement</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=EB+Garamond:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

    <style>
        /* ── Print page: A4 landscape, zero margin so our cert fills exactly ── */
        @page {
            size: A4 landscape;
            margin: 0;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* ── Screen: dark stage, certificate centred, not full-viewport ── */
        body {
            background: #1a1a2e;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
            font-family: 'EB Garamond', Georgia, serif;
        }

        /* ── Certificate shell: fixed A4-landscape proportions ── */
        .certificate {
            /*
             * A4 landscape = 297 × 210 mm.
             * We use px equivalents at 96 dpi so the browser and PDF renderer
             * agree: 297mm ≈ 1122px, 210mm ≈ 794px.
             * We shrink to 940 × 664 so it fits comfortably on most screens
             * while keeping the exact aspect ratio (297:210 = 1.414).
             */
            width:  940px;
            height: 664px;
            max-width: 100%;

            background: #FAF7F0;
            background-image:
                radial-gradient(ellipse at 15% 15%, rgba(201,168,76,0.07) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 85%, rgba(201,168,76,0.07) 0%, transparent 55%);

            /* Layered gold border */
            box-shadow:
                inset 0  0  0  10px  #FAF7F0,
                inset 0  0  0  12px  #C9A84C,
                inset 0  0  0  16px  #FAF7F0,
                inset 0  0  0  18px  #8B6914,
                0 24px 64px rgba(0,0,0,0.55);

            padding: 34px 52px 28px;
            position: relative;
            overflow: hidden;           /* ← prevents any bleed to a 2nd page */
        }

        /* ── Corner L-brackets ── */
        .certificate::before, .certificate::after,
        .c-tr, .c-bl {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            border-color: #C9A84C;
            border-style: solid;
        }
        .certificate::before { top: 26px;  left: 26px;  border-width: 2px 0 0 2px; }
        .certificate::after  { bottom: 26px; right: 26px; border-width: 0 2px 2px 0; }
        .c-tr { top: 26px;  right: 26px; border-width: 2px 2px 0 0; }
        .c-bl { bottom: 26px; left: 26px;  border-width: 0 0 2px 2px; }

        /* ── Top emblem row ── */
        .cert-top {
            text-align: center;
            margin-bottom: 6px;
        }

        .cert-eyebrow {
            font-family: 'Cinzel', serif;
            font-size: 9px;
            letter-spacing: 0.5em;
            color: #8B6914;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .cert-title {
            font-family: 'Cinzel', serif;
            font-size: 30px;
            font-weight: 700;
            color: #0A1628;
            letter-spacing: 0.06em;
            line-height: 1.1;
        }

        /* ── Ornament rule ── */
        .rule {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
            color: #C9A84C;
            font-size: 14px;
        }
        .rule::before, .rule::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #C9A84C 30%, #C9A84C 70%, transparent);
        }

        /* ── Presented to ── */
        .cert-presented {
            text-align: center;
            font-size: 14px;
            font-style: italic;
            color: #5a4a2a;
            margin-bottom: 4px;
        }

        /* ── Name ── */
        .cert-name {
            text-align: center;
            font-family: 'Cinzel', serif;
            font-size: 30px;
            font-weight: 900;
            color: #0A1628;
            letter-spacing: 0.05em;
            line-height: 1.15;
            margin-bottom: 2px;
        }
        .name-underline {
            width: 100px;
            height: 2px;
            background: linear-gradient(to right, transparent, #C9A84C, transparent);
            margin: 6px auto 0;
        }

        /* ── Body copy ── */
        .cert-body {
            text-align: center;
            font-size: 14px;
            font-style: italic;
            color: #3a2e1a;
            line-height: 1.6;
            margin: 10px 0 0;
        }

        /* ── Score row ── */
        .score-row {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin: 14px 0 0;
        }

        .score-badge {
            text-align: center;
            background: linear-gradient(145deg, #0A1628 0%, #162240 100%);
            border: 1px solid #C9A84C;
            border-radius: 3px;
            padding: 10px 36px;
            position: relative;
            min-width: 120px;
        }
        .score-badge::before {
            content: '';
            position: absolute;
            inset: 3px;
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 1px;
        }
        .badge-value {
            display: block;
            font-family: 'Cinzel', serif;
            font-size: 22px;
            font-weight: 700;
            color: #E8D5A3;
            line-height: 1;
        }
        .badge-label {
            display: block;
            font-family: 'Cinzel', serif;
            font-size: 8px;
            letter-spacing: 0.35em;
            color: #8B6914;
            text-transform: uppercase;
            margin-top: 4px;
        }

        /* ── Thin divider ── */
        .cert-divider {
            border: none;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(201,168,76,0.35), transparent);
            margin: 16px 0 12px;
        }

        /* ── Footer ── */
        .cert-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cert-meta {
            font-family: 'Cinzel', serif;
            font-size: 9px;
            letter-spacing: 0.1em;
            color: #8B6914;
            text-transform: uppercase;
        }
        .cert-meta span {
            display: block;
            font-family: 'EB Garamond', serif;
            font-size: 13px;
            color: #3a2e1a;
            letter-spacing: 0.02em;
            margin-top: 2px;
            text-transform: none;
        }

        /* Wax seal */
        .cert-seal svg {
            width: 60px;
            height: 60px;
            filter: drop-shadow(0 2px 5px rgba(201,168,76,0.4));
        }

        /* ── Download button (screen only) ── */
        .download-wrap {
            text-align: center;
            margin-top: 20px;
        }
        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 28px;
            background: #C9A84C;
            color: #0A1628;
            font-family: 'Cinzel', serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 2px;
            transition: background 0.2s;
        }
        .btn-download:hover { background: #e0bc60; }

        /* ── Print: remove body chrome, certificate fills the page exactly ── */
        @media print {
            body {
                background: white;
                min-height: unset;
                padding: 0;
                display: block;
            }

            .certificate {
                width:  297mm;
                height: 210mm;
                max-width: none;
                box-shadow: none;
                /* Keep inset borders for print */
                box-shadow:
                    inset 0  0  0  10px  #FAF7F0,
                    inset 0  0  0  12px  #C9A84C,
                    inset 0  0  0  16px  #FAF7F0,
                    inset 0  0  0  18px  #8B6914;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            /* Scale font sizes up proportionally for full A4 */
            .cert-title   { font-size: 36px; }
            .cert-name    { font-size: 36px; }
            .badge-value  { font-size: 26px; }
            .cert-body    { font-size: 16px; }
            .cert-presented { font-size: 16px; }
            .score-badge  { padding: 12px 42px; }

            .download-wrap { display: none; }
        }
    </style>
</head>
<body>

<div class="certificate">

    <!-- Corner brackets -->
    <div class="c-tr"></div>
    <div class="c-bl"></div>

    <!-- Header -->
    <div class="cert-top">
        <p class="cert-eyebrow">Academic Excellence</p>
        <h1 class="cert-title">Certificate of Achievement</h1>
    </div>

    <div class="rule">✦</div>

    <!-- Recipient -->
    <p class="cert-presented">This certificate is proudly presented to</p>

    <div class="cert-name">
        {{ \App\Models\User::find($result->user_id)->name }}
    </div>
    <div class="name-underline"></div>

    <p class="cert-body">
        For successfully completing the quiz and demonstrating<br>
        outstanding knowledge and performance under Meet Prajapatii.
    </p>

    <!-- Score badges -->
    <div class="score-row">
        <div class="score-badge">
            <span class="badge-value">{{ $result->score }}/{{ $result->total }}</span>
            <span class="badge-label">Score</span>
        </div>
        <div class="score-badge">
            <span class="badge-value">{{ $percentage }}%</span>
            <span class="badge-label">Percentage</span>
        </div>
    </div>

    <hr class="cert-divider">

    <!-- Footer -->
    <div class="cert-footer">

        <div class="cert-meta">
            Date of Issue
            <span>{{ date('d F Y') }}</span>
        </div>

        <!-- Wax seal -->
        <div class="cert-seal">
            <svg viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="35" cy="35" r="34" fill="#0A1628"/>
                <circle cx="35" cy="35" r="30" fill="none" stroke="#C9A84C" stroke-width="1"/>
                <circle cx="35" cy="35" r="26" fill="none" stroke="#C9A84C" stroke-width="0.5" stroke-dasharray="2 2"/>
                <text x="35" y="26" text-anchor="middle" font-family="serif" font-size="7" fill="#C9A84C" letter-spacing="2">CERTIFIED</text>
                <polygon points="35,30 37.2,37 44,37 38.4,41.2 40.6,48 35,44 29.4,48 31.6,41.2 26,37 32.8,37" fill="#C9A84C"/>
                <text x="35" y="57" text-anchor="middle" font-family="serif" font-size="7" fill="#8B6914" letter-spacing="1">OFFICIAL</text>
            </svg>
        </div>

        <div class="cert-meta" style="text-align:right;">
            Certificate ID
            <span>CERT-{{ $result->id }}</span>
        </div>

    </div>

</div>

<!-- Download button (hidden on print) -->
<div class="download-wrap">
    <button class="btn-download" onclick="window.print()">
        ↓ Download Certificate
    </button>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Exknot') }} — Verified Expertise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-base:     #0A0D12;
            --bg-surface:  #0F1318;
            --bg-elevated: #161B23;
            --border:      rgba(255,255,255,0.07);
            --teal:        #00C896;
            --teal-dim:    rgba(0,200,150,0.08);
            --teal-glow:   rgba(0,200,150,0.15);
            --red:         #FF4D4F;
            --text-1:      #F0F4F8;
            --text-2:      #8892A0;
            --text-3:      #4A5568;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-base);
            color: var(--text-1);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image:
                radial-gradient(ellipse 70% 60% at 50% 0%, rgba(0,200,150,0.07), transparent 70%),
                radial-gradient(rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 100% 100%, 32px 32px;
        }
        .input-dark {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.09);
            color: var(--text-1); border-radius: 10px;
            padding: 12px 16px; width: 100%;
            transition: border-color 200ms ease, box-shadow 200ms ease;
            font-family: 'DM Sans', sans-serif; font-size: 14px;
        }
        .input-dark:focus { outline: none; border-color: var(--teal); box-shadow: 0 0 0 3px rgba(0,200,150,0.1); }
        .input-dark::placeholder { color: var(--text-3); }
        .btn-primary {
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #00C896, #00A878);
            color: #fff; padding: 12px 24px; border-radius: 10px;
            font-weight: 500; font-size: 14px; border: none; cursor: pointer;
            transition: all 150ms cubic-bezier(0.16,1,0.3,1); width: 100%;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-primary:hover { filter: brightness(1.1); transform: translateY(-1px); box-shadow: 0 4px 20px rgba(0,200,150,0.3); }
        .btn-primary:active { transform: scale(0.98); }
        .input-error { color: #FF4D4F; font-size: 12px; margin-top: 5px; }
        label { font-size: 12px; font-weight: 500; color: var(--text-2); display: block; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.06em; }
    </style>
</head>
<body>
    <div style="width:100%;max-width:440px;padding:24px;">

        {{-- Logo --}}
        <div style="text-align:center;margin-bottom:36px;">
            <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;margin-bottom:16px;">
                <svg width="26" height="26" viewBox="0 0 60 60" fill="none">
                    <line x1="6" y1="6" x2="54" y2="54" stroke="#00C896" stroke-width="5" stroke-linecap="round"/>
                    <line x1="54" y1="6" x2="6" y2="54" stroke="#F0F4F8" stroke-width="5" stroke-linecap="round"/>
                    <circle cx="30" cy="30" r="5" fill="#00C896"/>
                </svg>
                <span style="font-size:18px;font-weight:300;letter-spacing:0.1em;color:var(--text-1);">Exknot</span>
            </a>
            <div style="display:inline-flex;align-items:center;gap:7px;padding:7px 16px;border-radius:20px;border:1px solid rgba(0,200,150,0.2);background:rgba(0,200,150,0.06);font-size:12px;color:var(--teal);">
                <span style="width:5px;height:5px;border-radius:50%;background:var(--teal);display:inline-block;animation:pulse 2s ease-in-out infinite;"></span>
                2,400+ verified firms trust Exknot
            </div>
        </div>

        {{-- Card --}}
        <div style="background:rgba(255,255,255,0.03);backdrop-filter:blur(12px) saturate(180%);-webkit-backdrop-filter:blur(12px) saturate(180%);border:1px solid rgba(255,255,255,0.08);border-radius:20px;padding:36px;box-shadow:0 24px 60px rgba(0,0,0,0.5),0 1px 0 rgba(255,255,255,0.06) inset;">
            {{ $slot }}
        </div>

        <p style="text-align:center;font-size:12px;color:var(--text-3);margin-top:24px;">
            © 2026 Exknot — <a href="#" style="color:var(--text-3);text-decoration:none;" onmouseover="this.style.color='var(--text-2)'" onmouseout="this.style.color='var(--text-3)'">Privacy</a> · <a href="#" style="color:var(--text-3);text-decoration:none;" onmouseover="this.style.color='var(--text-2)'" onmouseout="this.style.color='var(--text-3)'">Terms</a>
        </p>
    </div>

    <style>
        @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }
    </style>
</body>
</html>

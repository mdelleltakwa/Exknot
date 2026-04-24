<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Exknot') }} — Verified Expertise</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@200;300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/premium.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="/js/premium.js"></script>
    <style>
        :root {
            --bg-base: #07090D; --bg-surface: #0D1117; --border: rgba(255,255,255,0.07);
            --teal: #00E5A0; --teal-dim: rgba(0,229,160,0.08); --red: #FF4D4F;
            --text-1: #F0F4F8; --text-2: #8892A0; --text-3: #4A5568;
            --radius-md: 12px; --radius-lg: 18px; --radius-xl: 24px;
            --ease-out: cubic-bezier(0.16,1,0.3,1);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', 'DM Sans', sans-serif;
            background: var(--bg-base); color: var(--text-1);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            overflow: hidden; position: relative;
            -webkit-font-smoothing: antialiased;
        }
        /* Premium Background overrides since we link premium.css */
        body { background: transparent; }

        .input-dark {
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.09);
            color: var(--text-1); border-radius: var(--radius-md);
            padding: 14px 18px; width: 100%;
            transition: all 0.3s var(--ease-out);
            font-family: 'Inter', sans-serif; font-size: 14px;
        }
        .input-dark:focus { outline: none; border-color: var(--teal); box-shadow: 0 0 0 3px rgba(0,229,160,0.1), 0 0 20px rgba(0,229,160,0.05); }
        .input-dark::placeholder { color: var(--text-3); }
        .btn-primary {
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #00F0AA, #00C896);
            color: #07090D; padding: 14px 24px; border-radius: var(--radius-md);
            font-weight: 600; font-size: 14px; border: none; cursor: pointer;
            transition: all 0.3s var(--ease-out); width: 100%;
            font-family: 'Inter', sans-serif;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.2), 0 4px 15px rgba(0,229,160,0.25);
        }
        .btn-primary:hover { filter: brightness(1.08); transform: translateY(-1px); box-shadow: inset 0 1px 0 rgba(255,255,255,0.2), 0 8px 25px rgba(0,229,160,0.35); }
        .btn-primary:active { transform: scale(0.98); }
        .btn-primary:focus-visible { outline: 2px solid var(--teal); outline-offset: 3px; }
        .input-error { color: #FF4D4F; font-size: 12px; margin-top: 5px; }
        label { font-size: 12px; font-weight: 600; color: var(--text-2); display: block; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.06em; }
        .gradient-text { background: linear-gradient(135deg, #00E5A0, #D4A853); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.4;transform:scale(0.7)} }
        @keyframes card-in { from { opacity:0; transform:translateY(20px) scale(0.97); } to { opacity:1; transform:translateY(0) scale(1); } }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
            .orb { display: none; }
        }
    </style>
</head>
<body>
    {{-- Premium Background System --}}
    <div class="bg-system" aria-hidden="true"></div>
    <div class="bg-glow glow-teal" aria-hidden="true"></div>
    <div class="bg-glow glow-gold" aria-hidden="true"></div>
    <canvas id="networkCanvas" aria-hidden="true"></canvas>
    <div class="bg-vignette" aria-hidden="true"></div>
    <div style="width:100%;max-width:460px;padding:24px;position:relative;z-index:1;">

        {{-- Logo --}}
        <div style="text-align:center;margin-bottom:40px;">
            <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;margin-bottom:18px;">
                <svg width="28" height="28" viewBox="0 0 60 60" fill="none" style="filter:drop-shadow(0 0 6px rgba(0,229,160,0.3));">
                    <line x1="6" y1="6" x2="54" y2="54" stroke="#00E5A0" stroke-width="5" stroke-linecap="round"/>
                    <line x1="54" y1="6" x2="6" y2="54" stroke="#F0F4F8" stroke-width="5" stroke-linecap="round"/>
                    <circle cx="30" cy="30" r="5" fill="#00E5A0"/>
                </svg>
                <span style="font-family:'Outfit',sans-serif;font-size:20px;font-weight:300;letter-spacing:0.12em;color:var(--text-1);">Exknot</span>
            </a>

        </div>

        {{-- Card --}}
        <div style="background:rgba(255,255,255,0.025);backdrop-filter:blur(24px) saturate(180%);-webkit-backdrop-filter:blur(24px) saturate(180%);border:1px solid rgba(255,255,255,0.08);border-radius:var(--radius-xl);padding:40px;box-shadow:0 24px 60px rgba(0,0,0,0.5),0 0 0 1px rgba(0,229,160,0.04),inset 0 1px 0 rgba(255,255,255,0.06);animation:card-in 0.6s var(--ease-out);">
            {{ $slot }}
        </div>

        <p style="text-align:center;font-size:12px;color:var(--text-3);margin-top:28px;">
            © 2026 Exknot —
            <a href="{{ route('pages.privacy') }}" style="color:var(--text-3);text-decoration:none;transition:color 0.2s ease;" onmouseover="this.style.color='var(--text-2)'" onmouseout="this.style.color='var(--text-3)'">Privacy</a> ·
            <a href="{{ route('pages.terms') }}" style="color:var(--text-3);text-decoration:none;transition:color 0.2s ease;" onmouseover="this.style.color='var(--text-2)'" onmouseout="this.style.color='var(--text-3)'">Terms</a>
        </p>
    </div>
</body>
</html>

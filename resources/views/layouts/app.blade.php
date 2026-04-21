<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Exknot') — Verified Expertise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            --amber:       #F5A623;
            --red:         #FF4D4F;
            --text-1:      #F0F4F8;
            --text-2:      #8892A0;
            --text-3:      #4A5568;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-base);
            color: var(--text-1);
            min-height: 100vh;
            /* Dot grid ambient */
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(0,200,150,0.06), transparent),
                radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 100% 100%, 32px 32px;
        }

        /* ── TYPOGRAPHY ── */
        h1,h2,h3,h4 { letter-spacing: -0.03em; font-weight: 300; line-height: 1.15; }
        .label { font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.08em; color: var(--teal); }
        .mono { font-family: 'JetBrains Mono', monospace; color: var(--teal); }

        /* ── GLASSMORPHISM CARD ── */
        .glass {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 1px 0 rgba(255,255,255,0.05) inset;
        }
        .glass:hover {
            border-color: rgba(0,200,150,0.2);
            transform: translateY(-2px);
            transition: border-color 200ms ease, transform 200ms ease;
        }
        .card-dark {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 1px 0 rgba(255,255,255,0.04) inset;
            transition: border-color 200ms ease, transform 200ms ease;
        }
        .card-dark:hover { border-color: rgba(0,200,150,0.15); }

        /* ── BUTTONS ── */
        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #00C896, #00A878);
            color: #fff; padding: 11px 24px; border-radius: 10px;
            font-weight: 500; font-size: 14px; border: none; cursor: pointer;
            transition: all 150ms cubic-bezier(0.16,1,0.3,1);
            text-decoration: none; white-space: nowrap;
        }
        .btn-primary:hover { filter: brightness(1.1); transform: translateY(-1px); box-shadow: 0 4px 20px rgba(0,200,150,0.3); }
        .btn-primary:active { transform: scale(0.98); }
        .btn-primary.pulse { animation: btn-pulse 2.5s ease-in-out infinite; }
        @keyframes btn-pulse { 0%,100%{box-shadow:0 0 0 0 rgba(0,200,150,0.4)} 50%{box-shadow:0 0 0 8px rgba(0,200,150,0)} }

        .btn-ghost {
            display: inline-flex; align-items: center; justify-content: center;
            border: 1px solid rgba(255,255,255,0.1); color: var(--text-2);
            padding: 11px 24px; border-radius: 10px; font-size: 14px;
            background: transparent; cursor: pointer;
            transition: all 150ms cubic-bezier(0.16,1,0.3,1); text-decoration: none; white-space: nowrap;
        }
        .btn-ghost:hover { border-color: rgba(255,255,255,0.22); color: var(--text-1); transform: translateY(-1px); box-shadow: 0 4px 20px rgba(0,200,150,0.1); }
        .btn-ghost:active { transform: scale(0.98); }

        .btn-danger {
            display: inline-flex; align-items: center; justify-content: center;
            background: rgba(255,77,79,0.1); color: #FF4D4F;
            border: 1px solid rgba(255,77,79,0.25); padding: 8px 16px;
            border-radius: 8px; font-size: 13px; cursor: pointer;
            transition: all 150ms cubic-bezier(0.16,1,0.3,1); text-decoration: none;
        }
        .btn-danger:hover { background: rgba(255,77,79,0.18); transform: translateY(-1px); }

        /* ── STATUS BADGES ── */
        .badge {
            display: inline-flex; align-items: center;
            padding: 3px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 500; border: 1px solid; white-space: nowrap;
        }
        .badge-teal    { background: rgba(0,200,150,0.1);   color: var(--teal);  border-color: rgba(0,200,150,0.2); }
        .badge-amber   { background: rgba(245,166,35,0.1);  color: var(--amber); border-color: rgba(245,166,35,0.2); }
        .badge-red     { background: rgba(255,77,79,0.1);   color: var(--red);   border-color: rgba(255,77,79,0.2); }
        .badge-blue    { background: rgba(55,138,221,0.12); color: #85B7EB;      border-color: rgba(55,138,221,0.2); }
        .badge-purple  { background: rgba(127,119,221,0.12);color: #AFA9EC;      border-color: rgba(127,119,221,0.2); }

        /* ── FORM INPUTS ── */
        .input-dark {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--text-1); border-radius: 10px;
            padding: 12px 16px; width: 100%;
            transition: border-color 200ms ease, box-shadow 200ms ease;
            font-family: 'DM Sans', sans-serif; font-size: 14px;
        }
        .input-dark:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(0,200,150,0.1);
        }
        .input-dark::placeholder { color: var(--text-3); }
        select.input-dark option { background: var(--bg-surface); }
        textarea.input-dark { resize: vertical; min-height: 80px; }

        /* ── NAV ── */
        .nav-pill {
            font-size: 13px; color: var(--text-2); padding: 6px 12px;
            border-radius: 8px; transition: all 200ms ease;
            text-decoration: none; display: inline-flex; align-items: center;
        }
        .nav-pill:hover, .nav-pill.active { background: rgba(255,255,255,0.05); color: var(--text-1); }
        .nav-pill.active-teal { color: var(--teal); }

        /* ── SIDEBAR ── */
        .sidebar { width: 220px; flex-shrink: 0; }
        .sidebar-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 14px; border-radius: 8px; font-size: 13px;
            color: var(--text-2); transition: all 200ms ease;
            text-decoration: none; position: relative;
        }
        .sidebar-item:hover { background: rgba(255,255,255,0.04); color: var(--text-1); }
        .sidebar-item.active {
            background: rgba(0,200,150,0.06);
            color: var(--text-1);
            border-left: 2px solid var(--teal);
            border-radius: 0 8px 8px 0;
            padding-left: 12px;
        }
        .sidebar-item svg { width: 16px; height: 16px; flex-shrink: 0; }

        /* ── METRIC CARDS ── */
        .metric-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 14px; padding: 22px 24px;
            transition: border-color 200ms ease, transform 200ms ease;
        }
        .metric-card:hover { border-color: rgba(0,200,150,0.2); transform: translateY(-1px); }
        .metric-val { font-size: 28px; font-weight: 300; color: var(--text-1); margin-top: 8px; }
        .metric-lbl { font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-2); }
        .metric-sub { font-size: 11px; color: var(--text-3); margin-top: 4px; }

        /* ── FLASH MESSAGES ── */
        .flash-success {
            background: rgba(0,200,150,0.08); border: 1px solid rgba(0,200,150,0.2);
            color: var(--teal); padding: 13px 18px; border-radius: 10px;
            font-size: 14px; display: flex; align-items: center; gap: 10px;
            animation: slideDown 300ms cubic-bezier(0.16,1,0.3,1);
        }
        .flash-error {
            background: rgba(255,77,79,0.08); border: 1px solid rgba(255,77,79,0.2);
            color: var(--red); padding: 13px 18px; border-radius: 10px;
            font-size: 14px; display: flex; align-items: center; gap: 10px;
            animation: slideDown 300ms cubic-bezier(0.16,1,0.3,1);
        }
        @keyframes slideDown { from { opacity:0; transform: translateY(-12px); } to { opacity:1; transform: translateY(0); } }

        /* ── SCROLL REVEAL ── */
        .reveal { opacity: 0; transform: translateY(24px); transition: opacity 600ms cubic-bezier(0.16,1,0.3,1), transform 600ms cubic-bezier(0.16,1,0.3,1); }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ── PULSE DOT ── */
        @keyframes pulse-dot { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }
        .pulse-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--teal); animation: pulse-dot 2s ease-in-out infinite; display: inline-block; flex-shrink: 0; }

        /* ── SKELETON SHIMMER ── */
        @keyframes shimmer { 0%{background-position:-200% 0} 100%{background-position:200% 0} }
        .skeleton {
            background: linear-gradient(90deg, rgba(255,255,255,0.04) 25%, rgba(255,255,255,0.07) 50%, rgba(255,255,255,0.04) 75%);
            background-size: 200% 100%; animation: shimmer 1.5s infinite; border-radius: 6px;
        }

        /* ── FOOTER LINKS ── */
        .footer-link { color: var(--text-2); text-decoration: none; font-size: 13px; padding: 5px 8px; border-radius: 6px; transition: color 200ms ease; }
        .footer-link:hover { color: var(--text-1); }

        /* ── PAGE LAYOUT ── */
        .page-header { padding: 36px 44px 0; }
        .page-body    { padding: 28px 44px 48px; }

        /* ── TABLE STYLES ── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-3); padding: 10px 16px; text-align: left; border-bottom: 1px solid var(--border); background: rgba(255,255,255,0.01); }
        .data-table td { padding: 13px 16px; font-size: 13px; border-bottom: 1px solid rgba(255,255,255,0.04); }
        .data-table tr:hover td { background: rgba(255,255,255,0.02); }
        .data-table tr:last-child td { border-bottom: none; }
    </style>
</head>
<body>

{{-- ═══════════════════════ TOP NAV ═══════════════════════ --}}
<nav style="border-bottom:1px solid rgba(255,255,255,0.06);background:rgba(10,13,18,0.85);position:sticky;top:0;z-index:50;backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);">
    <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 32px;max-width:1400px;margin:0 auto;">

        {{-- Logo --}}
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;flex-shrink:0;">
            <svg width="22" height="22" viewBox="0 0 60 60" fill="none">
                <line x1="6" y1="6" x2="54" y2="54" stroke="#00C896" stroke-width="5" stroke-linecap="round"/>
                <line x1="54" y1="6" x2="6" y2="54" stroke="#F0F4F8" stroke-width="5" stroke-linecap="round"/>
                <circle cx="30" cy="30" r="5" fill="#00C896"/>
            </svg>
            <span style="font-size:16px;font-weight:300;letter-spacing:0.1em;color:var(--text-1);">Exknot</span>
            <span class="pulse-dot" style="margin-left:2px;"></span>
        </a>

        {{-- Center nav --}}
        <div style="display:flex;align-items:center;gap:2px;">
            <a href="{{ route('services.index') }}" class="nav-pill {{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-pill {{ request()->routeIs('admin.*') ? 'active' : '' }}">Admin</a>
                @elseif(auth()->user()->isFirm())
                    <a href="{{ route('firm.dashboard') }}" class="nav-pill {{ request()->routeIs('firm.*') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('firm.services.create') }}" class="nav-pill">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="margin-right:4px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Publish
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="nav-pill {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                @endif
            @endauth
        </div>

        {{-- Right side --}}
        <div style="display:flex;align-items:center;gap:10px;flex-shrink:0;">
            @auth
            {{-- Chat --}}
                @php $msgCount = auth()->user()->unreadMessagesCount(); @endphp
                <a href="{{ route('chat.index') }}" id="nav-chat-btn" style="position:relative;display:flex;align-items:center;padding:7px;border-radius:8px;color:var(--text-2);transition:all 200ms ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)';this.style.color='var(--text-1)'" onmouseout="this.style.background='transparent';this.style.color='var(--text-2)'">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    @if($msgCount > 0)
                    <span style="position:absolute;top:-2px;right:-2px;background:var(--teal);color:#0A0D12;font-size:9px;width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600;">{{ $msgCount }}</span>
                    @endif
                </a>

                {{-- Cart --}}
                @php $cartCount = count(session('cart', [])); @endphp
                <a href="{{ route('cart.index') }}" style="position:relative;display:flex;align-items:center;padding:7px;border-radius:8px;color:var(--text-2);transition:all 200ms ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)';this.style.color='var(--text-1)'" onmouseout="this.style.background='transparent';this.style.color='var(--text-2)'">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 001.83 1.61H19a2 2 0 001.83-1.61l1.5-8.39H5.17"/>
                    </svg>
                    @if($cartCount > 0)
                    <span style="position:absolute;top:-2px;right:-2px;background:var(--teal);color:#0A0D12;font-size:9px;width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600;">{{ $cartCount }}</span>
                    @endif
                </a>

                {{-- User dropdown --}}
                <div x-data="{ open: false }" style="position:relative;">
                    <button @click="open = !open" style="display:flex;align-items:center;gap:8px;background:transparent;border:1px solid rgba(255,255,255,0.08);cursor:pointer;padding:6px 10px;border-radius:10px;transition:all 200ms ease;" :style="open ? 'border-color:rgba(0,200,150,0.3);background:rgba(0,200,150,0.06)' : ''">
                        <div style="width:26px;height:26px;border-radius:50%;background:linear-gradient(135deg,rgba(0,200,150,0.25),rgba(0,200,150,0.1));display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:600;color:var(--teal);font-family:'JetBrains Mono',monospace;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <span style="font-size:13px;color:var(--text-2);">{{ Str::limit(auth()->user()->name, 14) }}</span>
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="var(--text-3)" stroke-width="2.5" style="transition:transform 200ms ease;" :style="open ? 'transform:rotate(180deg)' : ''"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95 -translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @click.away="open = false"
                        style="position:absolute;right:0;top:46px;background:rgba(15,19,24,0.95);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:6px;min-width:176px;z-index:100;box-shadow:0 16px 40px rgba(0,0,0,0.6),0 0 0 1px rgba(0,200,150,0.05);">

                        <div style="padding:10px 14px 8px;border-bottom:1px solid rgba(255,255,255,0.06);margin-bottom:4px;">
                            <div style="font-size:12px;font-weight:500;color:var(--text-1);">{{ Str::limit(auth()->user()->name, 22) }}</div>
                            <div style="font-size:11px;color:var(--text-3);margin-top:1px;">{{ auth()->user()->email }}</div>
                        </div>

                        <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:8px;padding:8px 12px;font-size:13px;color:var(--text-2);border-radius:7px;text-decoration:none;transition:all 150ms ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)';this.style.color='var(--text-1)'" onmouseout="this.style.background='transparent';this.style.color='var(--text-2)'">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            My profile
                        </a>
                        @if(auth()->user()->isFirm())
                        <a href="{{ route('firm.dashboard') }}" style="display:flex;align-items:center;gap:8px;padding:8px 12px;font-size:13px;color:var(--text-2);border-radius:7px;text-decoration:none;transition:all 150ms ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)';this.style.color='var(--text-1)'" onmouseout="this.style.background='transparent';this.style.color='var(--text-2)'">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                            Dashboard
                        </a>
                        @endif
                        <a href="{{ route('orders.index') }}" style="display:flex;align-items:center;gap:8px;padding:8px 12px;font-size:13px;color:var(--text-2);border-radius:7px;text-decoration:none;transition:all 150ms ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)';this.style.color='var(--text-1)'" onmouseout="this.style.background='transparent';this.style.color='var(--text-2)'">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            My orders
                        </a>

                        <div style="border-top:1px solid rgba(255,255,255,0.06);margin:4px 0;"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="width:100%;display:flex;align-items:center;gap:8px;text-align:left;padding:8px 12px;font-size:13px;color:#FF4D4F;border:none;background:transparent;cursor:pointer;border-radius:7px;transition:background 150ms ease;font-family:'DM Sans',sans-serif;" onmouseover="this.style.background='rgba(255,77,79,0.08)'" onmouseout="this.style.background='transparent'">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-ghost" style="padding:8px 18px;font-size:13px;">Sign in</a>
                <a href="{{ route('register') }}" class="btn-primary" style="padding:8px 18px;font-size:13px;">Get started</a>
            @endauth
        </div>
    </div>
</nav>

{{-- ═══════════════════════ FLASH MESSAGES ═══════════════════════ --}}
@if(session('success'))
<div style="padding:14px 32px 0;max-width:1400px;margin:0 auto;">
    <div class="flash-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
    </div>
</div>
@endif
@if(session('error'))
<div style="padding:14px 32px 0;max-width:1400px;margin:0 auto;">
    <div class="flash-error">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ session('error') }}
    </div>
</div>
@endif

<main>@yield('content')</main>

<footer style="border-top:1px solid rgba(255,255,255,0.06);padding:24px 32px;margin-top:48px;">
    <div style="max-width:1400px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;">
        <div style="display:flex;align-items:center;gap:10px;">
            <svg width="13" height="13" viewBox="0 0 60 60" fill="none">
                <line x1="6" y1="6" x2="54" y2="54" stroke="#00C896" stroke-width="5" stroke-linecap="round"/>
                <line x1="54" y1="6" x2="6" y2="54" stroke="#F0F4F8" stroke-width="5" stroke-linecap="round"/>
                <circle cx="30" cy="30" r="5" fill="#00C896"/>
            </svg>
            <span style="font-size:12px;color:var(--text-3);">© 2026 Exknot — Tie the right knot.</span>
        </div>
        <div style="display:flex;gap:4px;">
            <a href="#" class="footer-link">Privacy</a>
            <a href="#" class="footer-link">Terms</a>
            <a href="#" class="footer-link">Contact</a>
        </div>
    </div>
</footer>

<script>
// ── Scroll Reveal ──
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), i * 80);
            revealObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ── Animated counter ──
function animateCounter(el) {
    const target = parseInt(el.dataset.target);
    const duration = 1500;
    const start = performance.now();
    const update = (time) => {
        const progress = Math.min((time - start) / duration, 1);
        const ease = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(ease * target).toLocaleString();
        if (progress < 1) requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
}
document.querySelectorAll('[data-counter]').forEach(el => {
    new IntersectionObserver(([entry]) => {
        if (entry.isIntersecting) animateCounter(el);
    }).observe(el);
});
</script>
</body>
</html>

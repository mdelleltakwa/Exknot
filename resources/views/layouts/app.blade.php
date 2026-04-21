<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Exknot') — Verified Expertise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@200;300;400;500&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:#0A0D12;color:#E8EDF2;margin:0;}
        .logo-ex{color:#1D9E75;font-style:italic;}
        .btn-primary{background:#1D9E75;color:white;padding:10px 22px;border-radius:8px;font-weight:500;font-size:14px;transition:background .2s;display:inline-block;cursor:pointer;border:none;}
        .btn-primary:hover{background:#22b585;}
        .btn-ghost{border:1px solid rgba(255,255,255,.12);color:#C8D0DB;padding:10px 22px;border-radius:8px;font-size:14px;transition:all .2s;display:inline-block;cursor:pointer;background:transparent;}
        .btn-ghost:hover{border-color:rgba(255,255,255,.28);color:#E8EDF2;}
        .btn-danger{background:rgba(226,75,74,.15);color:#F09595;border:1px solid rgba(226,75,74,.25);padding:8px 16px;border-radius:8px;font-size:13px;cursor:pointer;}
        .card-dark{background:#111620;border:1px solid rgba(255,255,255,.06);border-radius:12px;}
        .badge-teal{background:rgba(29,158,117,.12);color:#5DCAA5;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:500;}
        .badge-amber{background:rgba(239,159,39,.12);color:#FAC775;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:500;}
        .badge-red{background:rgba(226,75,74,.12);color:#F09595;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:500;}
        .badge-blue{background:rgba(55,138,221,.12);color:#85B7EB;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:500;}
        .badge-purple{background:rgba(127,119,221,.12);color:#AFA9EC;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:500;}
        .input-dark{background:#111620;border:1px solid rgba(255,255,255,.1);color:#E8EDF2;border-radius:8px;padding:10px 14px;width:100%;transition:border-color .2s;font-family:'DM Sans',sans-serif;font-size:14px;}
        .input-dark:focus{outline:none;border-color:#1D9E75;}
        .input-dark::placeholder{color:#8B95A3;}
        select.input-dark option{background:#111620;}
        .flash-success{background:rgba(29,158,117,.1);border:1px solid rgba(29,158,117,.2);color:#5DCAA5;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;}
        .flash-error{background:rgba(226,75,74,.1);border:1px solid rgba(226,75,74,.2);color:#F09595;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;}
        .nav-pill{font-size:13px;color:#8B95A3;padding:6px 12px;border-radius:8px;transition:all .2s;cursor:pointer;}
        .nav-pill:hover,.nav-pill.active{background:rgba(255,255,255,.05);color:#E8EDF2;}
        .sidebar{width:220px;flex-shrink:0;}
        .sidebar-item{display:flex;align-items:center;gap:10px;padding:8px 12px;border-radius:8px;font-size:14px;color:#8B95A3;transition:all .2s;cursor:pointer;text-decoration:none;}
        .sidebar-item:hover,.sidebar-item.active{background:rgba(255,255,255,.05);color:#E8EDF2;}
        .sidebar-item.active{border-left:2px solid #1D9E75;border-radius:0 8px 8px 0;padding-left:10px;}
        .sidebar-item svg{width:16px;height:16px;flex-shrink:0;}
        .metric-card{background:#111620;border-radius:10px;padding:20px 22px;}
        .metric-val{font-size:26px;font-weight:300;color:#E8EDF2;margin-top:6px;}
        .metric-lbl{font-size:12px;color:#8B95A3;}
        .metric-sub{font-size:11px;color:#8B95A3;margin-top:3px;}
        .page-header{padding:32px 40px 0;}
        .page-body{padding:24px 40px 40px;}
        .footer-link{color:#8B95A3;text-decoration:none;font-size:13px;padding:6px 10px;border-radius:6px;transition:color .2s;}
        .footer-link:hover{color:#E8EDF2;}
        @keyframes pulse{0%,100%{opacity:1}50%{opacity:.5}}
        .pulse-dot{width:7px;height:7px;border-radius:50%;background:#1D9E75;animation:pulse 2s infinite;display:inline-block;}
    </style>
</head>
<body>

{{-- TOP NAV --}}
<nav style="border-bottom:1px solid rgba(255,255,255,.06);background:#0A0D12;position:sticky;top:0;z-index:50;">
    <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 32px;">

        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
            <svg width="24" height="24" viewBox="0 0 60 60" fill="none">
                <line x1="6" y1="6" x2="54" y2="54" stroke="#1D9E75" stroke-width="5" stroke-linecap="round"/>
                <line x1="54" y1="6" x2="6" y2="54" stroke="#E8EDF2" stroke-width="5" stroke-linecap="round"/>
                <circle cx="30" cy="30" r="5" fill="#1D9E75"/>
            </svg>
            <span style="font-size:17px;font-weight:300;letter-spacing:.06em;color:#E8EDF2;">
                <span class="logo-ex">Ex</span><span>knot</span>
            </span>
            <span class="pulse-dot" style="margin-left:2px;"></span>
        </a>

        <div style="display:flex;align-items:center;gap:4px;">
            <a href="{{ route('services.index') }}" class="nav-pill">Services</a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-pill">Admin</a>
                @elseif(auth()->user()->isFirm())
                    <a href="{{ route('firm.dashboard') }}" class="nav-pill">Dashboard</a>
                    <a href="{{ route('firm.services.create') }}" class="nav-pill">+ Publish</a>
                @else
                    <a href="{{ route('dashboard') }}" class="nav-pill">Dashboard</a>
                @endif
            @endauth
        </div>

        <div style="display:flex;align-items:center;gap:12px;">
            @auth
                {{-- Cart --}}
                @php $cartCount = count(session('cart', [])); @endphp
                <a href="{{ route('cart.index') }}" style="position:relative;color:#8B95A3;transition:color .2s;" class="nav-pill">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" style="display:block;">
                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 001.83 1.61H19a2 2 0 001.83-1.61l1.5-8.39H5.17"/>
                    </svg>
                    @if($cartCount > 0)
                    <span style="position:absolute;top:-4px;right:-4px;background:#1D9E75;color:white;font-size:9px;width:15px;height:15px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:500;">{{ $cartCount }}</span>
                    @endif
                </a>

                {{-- User menu --}}
                <div x-data="{ open: false }" style="position:relative;">
                    <button @click="open = !open" style="display:flex;align-items:center;gap:8px;background:transparent;border:none;cursor:pointer;padding:4px 8px;border-radius:8px;" class="nav-pill">
                        <div style="width:28px;height:28px;border-radius:50%;background:rgba(29,158,117,.15);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:500;color:#1D9E75;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <span style="font-size:13px;color:#C8D0DB;">{{ Str::limit(auth()->user()->name, 16) }}</span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#8B95A3" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        style="position:absolute;right:0;top:44px;background:#111620;border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:6px;min-width:160px;z-index:100;">
                        <a href="{{ route('profile.edit') }}" style="display:block;padding:8px 12px;font-size:13px;color:#C8D0DB;border-radius:6px;text-decoration:none;" class="nav-pill">My profile</a>
                        @if(auth()->user()->isFirm())
                        <a href="{{ route('firm.dashboard') }}" style="display:block;padding:8px 12px;font-size:13px;color:#C8D0DB;border-radius:6px;text-decoration:none;" class="nav-pill">Dashboard</a>
                        @endif
                        <a href="{{ route('orders.index') }}" style="display:block;padding:8px 12px;font-size:13px;color:#C8D0DB;border-radius:6px;text-decoration:none;" class="nav-pill">My orders</a>
                        <div style="border-top:1px solid rgba(255,255,255,.06);margin:4px 0;"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="width:100%;text-align:left;padding:8px 12px;font-size:13px;color:#F09595;border:none;background:transparent;cursor:pointer;border-radius:6px;">Sign out</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-ghost" style="padding:8px 18px;">Sign in</a>
                <a href="{{ route('register') }}" class="btn-primary" style="padding:8px 18px;">Get started</a>
            @endauth
        </div>
    </div>
</nav>

{{-- FLASH --}}
@if(session('success'))
<div style="margin:16px 32px 0;"><div class="flash-success">✓ {{ session('success') }}</div></div>
@endif
@if(session('error'))
<div style="margin:16px 32px 0;"><div class="flash-error">{{ session('error') }}</div></div>
@endif

<main>@yield('content')</main>

<footer style="border-top:1px solid rgba(255,255,255,.06);padding:24px 32px;display:flex;align-items:center;justify-content:space-between;margin-top:40px;">
    <div style="display:flex;align-items:center;gap:8px;">
        <svg width="14" height="14" viewBox="0 0 60 60" fill="none">
            <line x1="6" y1="6" x2="54" y2="54" stroke="#1D9E75" stroke-width="5" stroke-linecap="round"/>
            <line x1="54" y1="6" x2="6" y2="54" stroke="#E8EDF2" stroke-width="5" stroke-linecap="round"/>
            <circle cx="30" cy="30" r="5" fill="#1D9E75"/>
        </svg>
        <span style="font-size:13px;color:#8B95A3;">© 2026 Exknot — Tie the right knot.</span>
    </div>
    <div style="display:flex;gap:8px;">
        <a href="#" class="footer-link">Privacy</a>
        <a href="#" class="footer-link">Terms</a>
        <a href="#" class="footer-link">Contact</a>
    </div>
</footer>
</body>
</html>

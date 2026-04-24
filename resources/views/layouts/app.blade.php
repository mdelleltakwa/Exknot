<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Exknot — The B2B marketplace where serious companies find verified consulting and audit firms. Get proposals in 48 hours.">
    <title>@yield('title', 'Exknot') — Verified Expertise</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@200;300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="/css/premium.css">
</head>
<body>

{{-- Premium Background System --}}
<div class="bg-system" aria-hidden="true"></div>
<div class="bg-glow glow-teal" aria-hidden="true"></div>
<div class="bg-glow glow-gold" aria-hidden="true"></div>
<canvas id="networkCanvas" aria-hidden="true"></canvas>
<div class="bg-vignette" aria-hidden="true"></div>

{{-- Scroll progress --}}
<div class="scroll-progress" aria-hidden="true"></div>

{{-- ═══════════════════════ TOP NAV ═══════════════════════ --}}
<nav id="topNav" class="nav-premium" role="navigation" aria-label="Main navigation">
    <div class="nav-inner">
        {{-- Logo --}}
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;flex-shrink:0;" aria-label="Exknot home">
            <svg width="24" height="24" viewBox="0 0 60 60" fill="none" style="transition:filter 0.3s ease;" onmouseover="this.style.filter='drop-shadow(0 0 8px rgba(0,229,160,0.5))'" onmouseout="this.style.filter='none'">
                <line x1="6" y1="6" x2="54" y2="54" stroke="#00E5A0" stroke-width="5" stroke-linecap="round"/>
                <line x1="54" y1="6" x2="6" y2="54" stroke="#F0F4F8" stroke-width="5" stroke-linecap="round"/>
                <circle cx="30" cy="30" r="5" fill="#00E5A0"/>
            </svg>
            <span style="font-family:'Outfit',sans-serif;font-size:17px;font-weight:300;letter-spacing:0.12em;color:var(--text-1);">Exknot</span>
            <span class="pulse-dot" style="margin-left:2px;"></span>
        </a>

        {{-- Center nav --}}
        <div class="nav-center" style="display:flex;align-items:center;gap:6px;">
            @auth
            <a href="{{ route('services.index') }}" class="nav-pill {{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>
            @endauth
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-pill {{ request()->routeIs('admin.*') ? 'active' : '' }}">Admin</a>
                @elseif(auth()->user()->isFirm())
                    <a href="{{ route('firm.dashboard') }}" class="nav-pill {{ request()->routeIs('firm.*') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('firm.services.create') }}" class="nav-pill" style="gap:4px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Publish
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="nav-pill {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                @endif
            @endauth
        </div>

        {{-- Right side --}}
        <div style="display:flex;align-items:center;gap:10px;flex-shrink:0;">
            {{-- Desktop links --}}
            <div class="nav-right-links" style="display:flex;align-items:center;gap:10px;">
                @auth
                    {{-- Chat --}}
                    @php $msgCount = auth()->user()->unreadMessagesCount(); @endphp
                    <a href="{{ route('chat.index') }}" id="nav-chat-btn" class="nav-pill" style="position:relative;padding:8px;" aria-label="Messages{{ $msgCount > 0 ? ' ('.$msgCount.' unread)' : '' }}">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                        @if($msgCount > 0)
                        <span style="position:absolute;top:-2px;right:-2px;background:var(--teal);color:#07090D;font-size:9px;width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;">{{ $msgCount }}</span>
                        @endif
                    </a>

                    {{-- Cart --}}
                    @php $cartCount = count(session('cart', [])); @endphp
                    <a href="{{ route('cart.index') }}" class="nav-pill" style="position:relative;padding:8px;" aria-label="Cart{{ $cartCount > 0 ? ' ('.$cartCount.' items)' : '' }}">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                            <path d="M1 1h4l2.68 13.39a2 2 0 001.83 1.61H19a2 2 0 001.83-1.61l1.5-8.39H5.17"/>
                        </svg>
                        @if($cartCount > 0)
                        <span style="position:absolute;top:-2px;right:-2px;background:var(--teal);color:#07090D;font-size:9px;width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;">{{ $cartCount }}</span>
                        @endif
                    </a>

                    {{-- User dropdown --}}
                    <div x-data="{ open: false }" style="position:relative;">
                        <button @click="open = !open" style="display:flex;align-items:center;gap:8px;background:transparent;border:1px solid rgba(255,255,255,0.08);cursor:pointer;padding:6px 12px;border-radius:var(--radius-md);transition:all 0.3s ease;" :style="open ? 'border-color:rgba(0,229,160,0.3);background:rgba(0,229,160,0.06)' : ''" aria-haspopup="true" :aria-expanded="open">
                            <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,rgba(0,229,160,0.3),rgba(0,229,160,0.1));display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:var(--teal);font-family:'JetBrains Mono',monospace;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <span style="font-size:13px;color:var(--text-2);">{{ Str::limit(auth()->user()->name, 14) }}</span>
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="var(--text-3)" stroke-width="2.5" style="transition:transform 0.3s var(--ease-out);" :style="open ? 'transform:rotate(180deg)' : ''"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 -translate-y-2" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 scale-95" @click.away="open = false"
                            style="position:absolute;right:0;top:50px;background:rgba(13,17,23,0.95);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border:1px solid rgba(255,255,255,0.1);border-radius:var(--radius-lg);padding:6px;min-width:200px;z-index:100;box-shadow:0 20px 50px rgba(0,0,0,0.6),0 0 0 1px rgba(0,229,160,0.05);">

                            <div style="padding:12px 16px 10px;border-bottom:1px solid var(--border);margin-bottom:4px;">
                                <div style="font-size:13px;font-weight:500;color:var(--text-1);">{{ Str::limit(auth()->user()->name, 22) }}</div>
                                <div style="font-size:11px;color:var(--text-3);margin-top:2px;">{{ auth()->user()->email }}</div>
                            </div>

                            <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:10px;padding:10px 14px;font-size:13px;color:var(--text-2);border-radius:var(--radius-sm);text-decoration:none;transition:all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)';this.style.color='var(--text-1)'" onmouseout="this.style.background='transparent';this.style.color='var(--text-2)'">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                My profile
                            </a>
                            @if(auth()->user()->isFirm())
                            <a href="{{ route('firm.dashboard') }}" style="display:flex;align-items:center;gap:10px;padding:10px 14px;font-size:13px;color:var(--text-2);border-radius:var(--radius-sm);text-decoration:none;transition:all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)';this.style.color='var(--text-1)'" onmouseout="this.style.background='transparent';this.style.color='var(--text-2)'">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                                Dashboard
                            </a>
                            @endif
                            <a href="{{ route('orders.index') }}" style="display:flex;align-items:center;gap:10px;padding:10px 14px;font-size:13px;color:var(--text-2);border-radius:var(--radius-sm);text-decoration:none;transition:all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)';this.style.color='var(--text-1)'" onmouseout="this.style.background='transparent';this.style.color='var(--text-2)'">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                My orders
                            </a>

                            <div style="border-top:1px solid var(--border);margin:4px 0;"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="width:100%;display:flex;align-items:center;gap:10px;text-align:left;padding:10px 14px;font-size:13px;color:#FF4560;border:none;background:transparent;cursor:pointer;border-radius:var(--radius-sm);transition:background 0.2s ease;font-family:'Inter','DM Sans',sans-serif;" onmouseover="this.style.background='rgba(255,69,96,0.08)'" onmouseout="this.style.background='transparent'">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost" style="padding:10px 20px;font-size:13px;">Sign in</a>
                    <a href="{{ route('register') }}" class="btn-primary magnetic" style="padding:10px 20px;font-size:13px;">Get started</a>
                @endauth
            </div>

            {{-- Mobile toggle --}}
            <button id="mobileToggle" class="mobile-toggle" aria-label="Open menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Drawer --}}
<div id="mobileDrawer" class="mobile-drawer" role="dialog" aria-modal="true" aria-label="Mobile menu">
    <div class="mobile-drawer-backdrop"></div>
    <div class="mobile-drawer-panel">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid var(--border);">
            <span style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:300;letter-spacing:0.1em;color:var(--text-1);">Menu</span>
            <button id="drawerClose" style="background:none;border:1px solid var(--border);border-radius:var(--radius-sm);padding:6px;cursor:pointer;color:var(--text-2);" aria-label="Close menu">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        @auth
            <a href="{{ route('services.index') }}" class="mobile-drawer-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                Services
            </a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="mobile-drawer-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    Admin
                </a>
            @elseif(auth()->user()->isFirm())
                <a href="{{ route('firm.dashboard') }}" class="mobile-drawer-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="mobile-drawer-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
            @endif
            <a href="{{ route('chat.index') }}" class="mobile-drawer-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Messages
            </a>
            <a href="{{ route('cart.index') }}" class="mobile-drawer-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.83 1.61H19a2 2 0 001.83-1.61l1.5-8.39H5.17"/></svg>
                Cart
            </a>
            <a href="{{ route('orders.index') }}" class="mobile-drawer-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                Orders
            </a>
            <a href="{{ route('profile.edit') }}" class="mobile-drawer-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Profile
            </a>
            <div style="border-top:1px solid var(--border);margin:8px 0;"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mobile-drawer-link" style="width:100%;color:#FF4560;border:none;background:none;cursor:pointer;font-family:'Inter',sans-serif;font-size:15px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Sign out
                </button>
            </form>
        @else
            <a href="{{ route('services.index') }}" class="mobile-drawer-link">Services</a>
            <a href="{{ route('pages.contact') }}" class="mobile-drawer-link">Contact</a>
            <div style="border-top:1px solid var(--border);margin:12px 0;"></div>
            <a href="{{ route('login') }}" class="btn-ghost" style="width:100%;justify-content:center;margin-bottom:8px;">Sign in</a>
            <a href="{{ route('register') }}" class="btn-primary" style="width:100%;justify-content:center;">Get started — free</a>
        @endauth
    </div>
</div>

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

{{-- ═══════════════════════ FOOTER ═══════════════════════ --}}
<footer class="footer-premium" role="contentinfo">
    <div class="footer-inner">
        <div class="footer-grid">
            {{-- Brand --}}
            <div class="reveal">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;">
                    <svg width="18" height="18" viewBox="0 0 60 60" fill="none">
                        <line x1="6" y1="6" x2="54" y2="54" stroke="#00E5A0" stroke-width="5" stroke-linecap="round"/>
                        <line x1="54" y1="6" x2="6" y2="54" stroke="#F0F4F8" stroke-width="5" stroke-linecap="round"/>
                        <circle cx="30" cy="30" r="5" fill="#00E5A0"/>
                    </svg>
                    <span style="font-family:'Outfit',sans-serif;font-size:15px;font-weight:300;letter-spacing:0.1em;color:var(--text-1);">Exknot</span>
                </div>
                <p style="font-size:13px;color:var(--text-3);line-height:1.7;max-width:260px;">The B2B marketplace where serious companies find verified consulting & audit firms. Est. 2026, Paris.</p>
                <div style="display:flex;gap:8px;margin-top:20px;">
                    @foreach(['🇫🇷','🇩🇪','🇬🇧','🇺🇸','🇯🇵','🇸🇬'] as $flag)
                    <span style="font-size:16px;">{{ $flag }}</span>
                    @endforeach
                </div>
            </div>
            {{-- Platform --}}
            <div class="reveal reveal-delay-1">
                <div class="footer-heading">Platform</div>
                <a href="{{ route('services.index') }}" class="footer-link">Browse services</a>
                <a href="{{ route('register') }}" class="footer-link">Join as a firm</a>
                <a href="{{ route('pages.contact') }}" class="footer-link">Contact us</a>
            </div>
            {{-- Company --}}
            <div class="reveal reveal-delay-2">
                <div class="footer-heading">Company</div>
                <a href="{{ route('pages.privacy') }}" class="footer-link">Privacy policy</a>
                <a href="{{ route('pages.terms') }}" class="footer-link">Terms of service</a>
                <a href="{{ route('pages.contact') }}" class="footer-link">Support</a>
            </div>
            {{-- Trust --}}
            <div class="reveal reveal-delay-3">
                <div class="footer-heading">Trust & security</div>
                <div style="display:flex;flex-direction:column;gap:10px;">
                    @foreach(['Verified firms only','Escrow-protected payments','48h response SLA','GDPR compliant'] as $trust)
                    <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:var(--text-2);">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ $trust }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span style="font-size:12px;color:var(--text-3);">© 2026 Exknot SAS — Tie the right knot.</span>
            <div style="display:flex;gap:16px;">
                <a href="{{ route('pages.privacy') }}" class="footer-link">Privacy</a>
                <a href="{{ route('pages.terms') }}" class="footer-link">Terms</a>
                <a href="{{ route('pages.contact') }}" class="footer-link">Contact</a>
            </div>
        </div>
    </div>
</footer>

<script src="/js/premium.js"></script>
</body>
</html>

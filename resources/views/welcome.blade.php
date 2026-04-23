@extends('layouts.app')
@section('title', 'Exknot — Verified Expertise')

@section('content')

    {{-- ═══════════════════════ HERO ═══════════════════════ --}}
    <section style="padding:96px 32px 0;max-width:1200px;margin:0 auto;position:relative;">

        {{-- Ticker badge --}}
        <div class="reveal"
            style="display:inline-flex;align-items:center;gap:8px;padding:6px 16px;border-radius:30px;border:1px solid rgba(0,200,150,0.2);background:rgba(0,200,150,0.06);font-size:12px;color:var(--teal);margin-bottom:40px;">
            <span
                style="width:5px;height:5px;border-radius:50%;background:var(--teal);display:inline-block;animation:pulse-dot 2s ease-in-out infinite;flex-shrink:0;"></span>
            ↗ 2,400 firms joined last month
        </div>

        {{-- Main headline --}}
        <h1 class="reveal"
            style="font-size:clamp(40px,5.5vw,64px);font-weight:300;line-height:1.05;letter-spacing:-0.04em;max-width:720px;margin-bottom:24px;">
            The only marketplace where serious companies find <span style="color:#00C896;">serious</span> experts.
        </h1>

        <p class="reveal" style="font-size:18px;color:#8892A0;line-height:1.7;max-width:480px;margin-bottom:44px;">
            Stop spending weeks on LinkedIn. Get proposals from vetted consulting and audit firms in 48 hours.
        </p>

        {{-- CTAs --}}
        <div class="reveal" style="display:flex;align-items:center;gap:16px;margin-bottom:32px;flex-wrap:wrap;">
            <a href="{{ route('services.index') }}"
                style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(180deg,#00D4A0 0%,#00B884 100%);color:#0A0D12;padding:12px 24px;border-radius:10px;font-weight:500;font-size:15px;border:none;cursor:pointer;text-decoration:none;box-shadow:inset 0 1px 0 rgba(255,255,255,0.2),0 4px 12px rgba(0,200,150,0.25);transition:all 150ms ease;">
                Find your expert
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.35-4.35" />
                </svg>
            </a>
            <a href="{{ route('register') }}"
                style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);color:var(--text-2);padding:12px 24px;border-radius:10px;font-size:15px;text-decoration:none;transition:all 150ms ease;">
                Are you a firm? Join free →
            </a>
        </div>

        {{-- Trust indicator --}}
        <div class="reveal"
            style="font-size:13px;color:var(--text-3);display:flex;align-items:center;gap:10px;padding-bottom:96px;">
            <span>Trusted by firms in 47 countries</span>
            <span style="font-size:16px;letter-spacing:3px;">🇫🇷🇩🇪🇬🇧🇺🇸🇯🇵</span>
        </div>
    </section>

    {{-- ═══════════════════════ STATS ROW ═══════════════════════ --}}
    <section style="max-width:1200px;margin:0 auto;padding:0 32px 96px;">
        <div class="reveal"
            style="display:flex;align-items:center;border-top:1px solid rgba(255,255,255,0.06);border-bottom:1px solid rgba(255,255,255,0.06);">
            @foreach([
                    ['100', '%', '100+', 'Trusted firms'],
                    ['48', 'h', '48h', 'Avg. proposal time'],
                    ['100%', '%', '100%', 'Focus on quality'],
                    ['0', '', '0', 'Hidden fees'],
                ] as [$target, $suffix, $display, $lbl])
                <div style="flex:1;text-align:center;padding:32px 24px;">
                    <div style="font-size:32px;font-weight:300;color:#00C896;letter-spacing:-0.02em;" data-counter data-target="{{ $target }}" data-suffix="{{ $suffix }}">{{ $display }}</div>
                    <div style="font-size:11px;color:#8892A0;margin-top:6px;text-transform:uppercase;letter-spacing:0.08em;">{{ $lbl }}</div>
                </div>
                @if(!$loop->last)
                    <div style="width:1px;height:56px;background:rgba(255,255,255,0.06);flex-shrink:0;"></div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- ═══════════════════════ HOW IT WORKS ═══════════════════════ --}}
    <section style="padding:0 32px 96px;max-width:1200px;margin:0 auto;">
        <div style="margin-bottom:52px;">
            <div class="label reveal" style="margin-bottom:12px;">Process</div>
            <h2 class="reveal" style="font-size:clamp(28px,4vw,40px);max-width:400px;">Three steps. No ambiguity.</h2>
        </div>




        {{-- Asymmetric grid: Step 1 (60%) + Step 2 (40% offset) --}}
        <div style="disp
    l                   ay:flex;flex-wrap:wrap;gap:16px;margin-bottom:16px;">





                                                       {{-- Step 1: large card, 60% --}}
            <div class="reveal" style="flex:0 0 calc(60% - 8px);min-width:280px;background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:12px;padding:40px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);transition:border-color 200ms ease,box-shadow 200ms ease;" onmouseover="this.style.borderColor='rgba(0,200,150,0.2)';this.style.boxShadow='0 8px 32px rgba(0,200,150,0.08),inset 0 1px 0 rgba(255,255,255,0.1)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.boxShadow='inset 0 1px 0 rgba(255,255,255,0.08)'">
                <div style="display:flex;align-items:flex-start;gap:24px;">
                    <div sty
    l                       e="width:48px;height:48px;border-radius:12px;background:rgba(0,200,150,0.1);border:1px solid rgba(0,20
                            0,150,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5"
                            stroke-linecap="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><pat
    h                        d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <div>
                        <div class="label" style="color:var(--text-3);margin-bottom:10px;">01</div>
                        <div style="font-size:20px;font-weight:400;color:var(--text-1);margin-bottom:12px;letter-spacing:-0.02em;">Post your need</div>
                        <div style="font-size:14px;color:var(--text-2);line-height:1.75;max-width:340px;">Describe your project scope, sector, budget range, and timeline. Our intake form takes under 3 minutes. No sales calls. No account managers. Just your brief, reviewed by real firms.</div>
                    </div>



                           </di
    v               >
            </div>







            {{-- Step 2: small card, 40%, offset down 24px --}}
            <div class="reveal" style="flex:0 0 calc(40% - 8px);min-width:240px;background:var(--bg-surface);border:1px sol
                    id rgba(255,255,255,0.06);border-radius:12px;padding:32px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);transition:border-color 200ms ease,box-shadow 200ms ease;margin-top:24px;" onmouseover="this.style.borderColor='rgba(0,200,150,0.2)';this.style.boxShadow='0 8px 32px rgba(0,200,150,0.08),inset 0 1px 0 rgba(255,255,255,0.1)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.boxShadow='inset 0 1px 0 rgba(255,255,255,0.08)'">
                <div style="width:44px;height:44px;border-radius:12px;background:rgba(0,200,150,0.1);border:1px solid rgba(0
                   ,200,150,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                </div>
                <div class="label" style="color:var(--text-3);margin-bottom:10px;">02</div>
                <div style="font-size:18px;font-weight:400;color:var(--text-1);margin-bottom:10px;letter-spacing:-0.02em;">Proposals in 48h</div>
                <div style=
           "font-size:13px;color:var(--text-2);line-height:1.65;">Verified firms matching your brief respond with tailored proposals. Not auto-generated quotes — real responses from real people.</div>


                   </div>
        </div>






                         {{-- Step 3: medium card, 50%, centered --}}
        <div class="reveal" style="width:50%;margin:0 auto;min-width:280px;background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:12px;padding:36px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);transition:border-color 200ms ease,box-shadow 200ms ease;" onmouseover="this.style.borderColor='rgba(0,200,150,0.2)';this.style.boxShadow='0 8px 32px rgba(0,200,150,0.08),inset 0 1px 0 rgba(255,255,255,0.1)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.boxShadow='inset 0 1px 0 rgba(255,255,255,0.08)'">
            <div style="display:flex;align-items:flex-start;gap:20px;">
                <div sty
                       le="width:44px;height:44px;border-radius:12px;background:rgba(0,200,150,0.1);border:1px solid rgba(0,20
                        0,150,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" s
                       troke-linecap="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-
                       2-2V5a2 2 0 012-2h11"/></svg>
                </div>
                <div>
                    <div class="label" style="color:var(--text-3);margin-bottom:10px;">03</div>
                    <div style="font-size:19px;font-weight:400;color:var(--text-1);margin-bottom:10px;letter-spacing:-0.02em;">Contract with confidence</div>
                    <div style="font-size:13px;color:var(--text-2);line-height:1.65;">Sign digitally, pay via escrow, deliver milestones, leave verified reviews. The entire engagement lifecycle — in one place. No side invoices, no off-platform transfers.</div>
                </div>
            </div>
        </div>
    </section>




               {{-- ═══════════
                   ════════════ TRUST / SOCIAL PROOF ═══════════════════════ --}}
    <section style="padding:0 32px 96px;max-width:1200px;margin:0 auto;">

                           <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;">
            @foreach([
                    ['Verified firms only', 'Every firm passes a 3-step check: legal status, financial health, and expertise audit. No freelancers. No unvetted agencies.', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>'],
                    ['Escrow-protected', 'Funds are held until both parties confirm delivery. No wire transfers to strangers.', '<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>'],
                    ['48h response SLA', 'Firms commit to responding within 48 hours or risk suspension. No proposal requests lost to silence.', '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>'],
                    ['47 countries', '28 industries. 40+ service verticals. From Paris to Singapore to São Paulo.', '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>'],
                ] as [$title, $desc, $icon])
                <div class="reveal" style="padding:24px;background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);transition:border-color 200ms ease,box-shadow 200ms ease;" onmouseover="this.style.borderColor='rgba(0,200,150,0.2)';this.style.boxShadow='0 8px 32px rgba(0,200,150,0.08),inset 0 1px 0 rgba(255,255,255,0.1)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.boxShadow='inset 0 1px 0 rgba(255,255,255,0.08)'">
                    <div style="width:36px;height:36px;border-radius:10px;background:rgba(0,200,150,0.08);border:1px solid rgba(0,200,150,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:16px;">

                   <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round">{!! $icon !!}</svg>

                   </div>

                        <div style="font-size:14px;font-weight:500;color:var(--text-1);margin-bottom:8px;letter-spacing:-0.01em;">{{ $title }}</div>
                    <div style="font-size:13px;color:var(--text-2);line-height:1.65;">{{ $desc }}</div>
                </div>

               @endforeach

                    </div>
    </section>


    {{-- ═══════════════════════ CTA BAND ═══════════════════════ --}}
    <section style="padding:96px 32px;text-align:center
                   ;border-top:1px solid rgba(255,255,255,0.06);position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 50% 100%,rgba(0,200,150,0.04),transparent);pointer-events:none;"></div>
        <div class="reveal" style="position:relative;max-width:580px;margin:0 auto;">
            <div class="label" style="margin-bottom:20px;">Start today</div>
            <h2 style="font-size:clamp(28px,4vw,44px);margin-bottom:16px;letter-spacing:-0.03em;">Ready to work with the<br>right firms?</h2>
            <p style="color:#8892A0;font-size:16px;margin-bottom:40px;line-height:1.65;max-width:420px;margin-left:auto;margin-right:auto;">Join 2,400+ verified firms and 14,000+ companies. No setup fee. No subscription.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('register') }}" style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(180deg,#00D4A0 0%,#00B884 100%);color:#0A0D12;padding:14px 32px;border-radius:10px;font-weight:500;font-size:15px;text-decoration:none;box-shadow:inset 0 1px 0 rgba(255,255,255,0.2),0 4px 12px rgba(0,200,150,0.25);transition:all 150ms ease;">
                    Get started — it's free
                </a>
                <a href="{{ route('services.index') }}" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);color:var(--text-2);padding:14px 28px;border-radius:10px;font-size:15px;text-decoration:none;transition:all 150ms ease;">
                    Browse services
                </a>
            </div>
        </div>
    </section>

@endsection

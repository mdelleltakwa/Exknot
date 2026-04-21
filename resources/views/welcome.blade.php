@extends('layouts.app')
@section('title', 'Exknot — Verified Expertise')

@section('content')

{{-- ═══════════════════════ HERO ═══════════════════════ --}}
<section style="text-align:center;padding:96px 32px 80px;max-width:860px;margin:0 auto;position:relative;">

    {{-- Pill badge --}}
    <div class="reveal" style="display:inline-flex;align-items:center;gap:8px;padding:8px 18px;border-radius:30px;border:1px solid rgba(0,200,150,0.25);background:rgba(0,200,150,0.07);font-size:12px;color:var(--teal);margin-bottom:32px;">
        <span style="width:6px;height:6px;border-radius:50%;background:var(--teal);display:inline-block;animation:pulse-dot 2s ease-in-out infinite;"></span>
        2,400+ verified expert firms — 94 countries
    </div>

    {{-- Headline --}}
    <h1 class="reveal" style="font-size:clamp(42px,6vw,72px);font-weight:300;line-height:1.08;letter-spacing:-0.04em;margin-bottom:24px;">
        Tie the right knot<br>with <span style="background:linear-gradient(135deg,#00C896,#00E5B0);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-style:italic;">verified expertise</span>
    </h1>

    <p class="reveal" style="font-size:18px;color:var(--text-2);line-height:1.65;max-width:520px;margin:0 auto 44px;">
        The global B2B marketplace connecting companies with certified consulting, audit and inspection firms. In 48 hours, not 3 weeks.
    </p>

    {{-- CTAs --}}
    <div class="reveal" style="display:flex;align-items:center;justify-content:center;gap:14px;margin-bottom:72px;flex-wrap:wrap;">
        <a href="{{ route('services.index') }}" class="btn-primary pulse" style="font-size:15px;padding:14px 32px;gap:8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Find an expert firm
        </a>
        <a href="{{ route('register') }}" class="btn-ghost" style="font-size:15px;padding:14px 32px;gap:8px;">
            List your firm
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
    </div>

    {{-- Stats row --}}
    <div class="reveal" style="display:flex;align-items:center;justify-content:center;gap:0;flex-wrap:wrap;">
        @foreach([['2400','2,400+','Verified firms'],['48','48h','Avg. proposal time'],['94','94','Countries'],['340','$340M+','Contracts facilitated']] as [$target,$display,$lbl])
        <div style="text-align:center;padding:16px 36px;position:relative;">
            <div style="font-size:30px;font-weight:300;color:var(--text-1);font-family:'DM Sans',sans-serif;" data-counter data-target="{{ $target }}">{{ $display }}</div>
            <div style="font-size:12px;color:var(--text-2);margin-top:4px;letter-spacing:0.02em;">{{ $lbl }}</div>
        </div>
        @if(!$loop->last)
        <div style="width:1px;height:40px;background:rgba(255,255,255,0.07);"></div>
        @endif
        @endforeach
    </div>
</section>

{{-- ═══════════════════════ HOW IT WORKS ═══════════════════════ --}}
<section style="padding:80px 32px;max-width:1100px;margin:0 auto;">
    <div style="margin-bottom:52px;">
        <div class="label reveal" style="margin-bottom:12px;">How it works</div>
        <h2 class="reveal" style="font-size:clamp(28px,4vw,40px);">Three steps to the perfect engagement</h2>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:2px;border-radius:18px;overflow:hidden;">
        @foreach([
            ['01','Post your need','Describe your project, sector, budget and timeline. Takes under 3 minutes.','<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>'],
            ['02','Get matched in 48h','Top verified firms matching your criteria respond with tailored proposals.','<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>'],
            ['03','Contract with confidence','Sign, pay via escrow, deliver, review. Everything in one place.','<polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>'],
        ] as [$num,$title,$desc,$icon])
        <div class="reveal glass" style="padding:40px 32px;border-radius:0;background:rgba(255,255,255,0.025);">
            <div style="width:42px;height:42px;border-radius:12px;background:rgba(0,200,150,0.1);border:1px solid rgba(0,200,150,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round">{!! $icon !!}</svg>
            </div>
            <div class="label" style="color:var(--text-3);margin-bottom:10px;">{{ $num }}</div>
            <div style="font-size:16px;font-weight:500;color:var(--text-1);margin-bottom:10px;letter-spacing:-0.01em;">{{ $title }}</div>
            <div style="font-size:13px;color:var(--text-2);line-height:1.65;">{{ $desc }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- ═══════════════════════ SOCIAL PROOF / TRUST ═══════════════════════ --}}
<section style="padding:60px 32px;max-width:1100px;margin:0 auto;">
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;">
        @foreach([
            ['Verified firms only','Every firm on Exknot passes a 3-step verification: legal, financial and expertise audit.','<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>'],
            ['Escrow payment','Funds are held securely until both parties confirm delivery.','<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>'],
            ['48h response SLA','Firms commit to responding to qualified requests within 48 hours.','<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>'],
            ['Global coverage','94 countries, 28 industries, 40+ service categories.','<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>'],
        ] as [$title,$desc,$icon])
        <div class="reveal card-dark" style="padding:28px;transition:border-color 200ms ease,transform 200ms ease;">
            <div style="width:36px;height:36px;border-radius:10px;background:var(--teal-dim);border:1px solid rgba(0,200,150,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round">{!! $icon !!}</svg>
            </div>
            <div style="font-size:14px;font-weight:500;color:var(--text-1);margin-bottom:8px;letter-spacing:-0.01em;">{{ $title }}</div>
            <div style="font-size:13px;color:var(--text-2);line-height:1.6;">{{ $desc }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- ═══════════════════════ CTA BAND ═══════════════════════ --}}
<section style="padding:80px 32px;text-align:center;border-top:1px solid rgba(255,255,255,0.06);position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 50% 100%,rgba(0,200,150,0.05),transparent);pointer-events:none;"></div>
    <div class="reveal" style="position:relative;">
        <div class="label" style="margin-bottom:16px;">Get started today</div>
        <h2 style="font-size:clamp(28px,4vw,44px);margin-bottom:16px;">Ready to tie the right knot?</h2>
        <p style="color:var(--text-2);font-size:16px;margin-bottom:36px;max-width:440px;margin-left:auto;margin-right:auto;">Join 2,400+ verified firms and 14,000+ companies already on Exknot.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('register') }}" class="btn-primary pulse" style="font-size:15px;padding:14px 36px;">Get started — it's free</a>
            <a href="{{ route('services.index') }}" class="btn-ghost" style="font-size:15px;padding:14px 28px;">Browse services</a>
        </div>
    </div>
</section>

@endsection

@extends('layouts.app')
@section('title', 'Exknot')

@section('content')

{{-- HERO --}}
<div class="text-center px-8 py-28 max-w-3xl mx-auto">
    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-8" style="border:1px solid rgba(29,158,117,.25);background:rgba(29,158,117,.07);font-size:12px;color:#5DCAA5;">
        <span style="width:6px;height:6px;border-radius:50%;background:#1D9E75;animation:pulse 2s infinite;" class="inline-block"></span>
        2,400+ verified expert firms — 94 countries
    </div>

    <h1 style="font-size:52px;font-weight:300;line-height:1.12;letter-spacing:-0.03em;margin-bottom:20px;">
        Tie the right knot<br>with <span style="color:#1D9E75;font-style:italic;">verified expertise</span>
    </h1>

    <p style="font-size:17px;color:#8B95A3;line-height:1.65;max-width:520px;margin:0 auto 40px;">
        The global B2B marketplace connecting companies with certified consulting, audit and inspection firms. In 48 hours, not 3 weeks.
    </p>

    <div class="flex items-center justify-center gap-4 mb-16">
        <a href="{{ route('services.index') }}" class="btn-primary" style="font-size:15px;padding:13px 28px;">Find an expert firm</a>
        <a href="{{ route('register') }}" class="btn-ghost" style="font-size:15px;padding:13px 28px;">List your firm</a>
    </div>

    <div class="flex items-center justify-center gap-12">
        @foreach([['2,400+','Verified firms'],['48h','Avg. proposal time'],['94','Countries'],['$340M+','Contracts facilitated']] as [$val,$lbl])
        <div class="text-center">
            <div style="font-size:26px;font-weight:300;color:#E8EDF2;">{{ $val }}</div>
            <div style="font-size:12px;color:#8B95A3;margin-top:3px;">{{ $lbl }}</div>
        </div>
        @if(!$loop->last)<div style="width:1px;height:36px;background:rgba(255,255,255,.07);"></div>@endif
        @endforeach
    </div>
</div>

{{-- HOW IT WORKS --}}
<div class="px-8 py-20 max-w-5xl mx-auto">
    <div style="font-size:11px;font-weight:500;color:#1D9E75;text-transform:uppercase;letter-spacing:.1em;margin-bottom:12px;">How it works</div>
    <h2 style="font-size:34px;font-weight:300;letter-spacing:-0.02em;margin-bottom:48px;">Three steps to the perfect engagement</h2>

    <div class="grid grid-cols-3 gap-px rounded-xl overflow-hidden">
        @foreach([
            ['01','Post your need','Describe your project, sector, budget and timeline. Takes under 3 minutes.'],
            ['02','Get matched in 48h','Top verified firms matching your criteria respond with tailored proposals.'],
            ['03','Contract with confidence','Sign, pay via escrow, deliver, review. Everything in one place.'],
        ] as [$num,$title,$desc])
        <div style="background:#111620;padding:36px 28px;">
            <div style="font-size:11px;color:#1D9E75;font-weight:500;letter-spacing:.08em;margin-bottom:16px;">{{ $num }}</div>
            <div style="font-size:15px;font-weight:500;color:#E8EDF2;margin-bottom:8px;">{{ $title }}</div>
            <div style="font-size:13px;color:#8B95A3;line-height:1.6;">{{ $desc }}</div>
        </div>
        @endforeach
    </div>
</div>

{{-- CTA BAND --}}
<div class="text-center px-8 py-20" style="border-top:1px solid rgba(255,255,255,.06);">
    <h2 style="font-size:36px;font-weight:300;letter-spacing:-0.02em;margin-bottom:12px;">Ready to tie the right knot?</h2>
    <p style="color:#8B95A3;font-size:16px;margin-bottom:32px;">Join 2,400+ verified firms and 14,000+ companies already on Exknot.</p>
    <a href="{{ route('register') }}" class="btn-primary" style="font-size:15px;padding:13px 32px;">Get started — it's free</a>
</div>

<style>
@keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(.8)} }
</style>

@endsection

@extends('layouts.app')
@section('title', 'Terms of Service')

@section('content')
<div style="max-width:768px;margin:0 auto;padding:80px 32px;">

    {{-- Hero --}}
    <div style="margin-bottom:64px;">
        <div class="label reveal" style="margin-bottom:16px;">Legal</div>
        <h1 class="reveal" style="font-size:clamp(32px,5vw,48px);margin-bottom:16px;">Terms of Service</h1>
        <p class="reveal" style="font-size:14px;color:var(--text-3);font-style:italic;">Last updated: April 2026 — Governed by French law</p>
    </div>

    <div class="reveal" style="background:rgba(0,200,150,0.05);border:1px solid rgba(0,200,150,0.15);border-radius:12px;padding:20px 24px;margin-bottom:48px;">
        <p style="font-size:14px;color:var(--text-2);line-height:1.75;">These terms govern your use of Exknot, a B2B marketplace operated by Exknot SAS (Paris, France). By creating an account you agree to these terms. If you represent a company, you confirm you have authority to bind that company to this agreement.</p>
    </div>

    {{-- Platform usage --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">Platform usage rules</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;">Exknot is a <strong style="color:var(--text-1);">B2B-only platform</strong>. All users must represent a legitimate legal entity. Personal freelance profiles are not permitted under any account type.</p>
            <p style="margin-bottom:14px;">You may not use Exknot to: solicit contacts off-platform to avoid commission, post false credentials or fabricated reviews, circumvent escrow for payments, or engage in any form of market manipulation or bid manipulation.</p>
            <p>Violations result in immediate account suspension. Egregious violations (fraud, identity falsification, escrow manipulation) are reported to relevant authorities under applicable French and EU law.</p>
        </div>
    </div>

    {{-- Client responsibilities --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">Client responsibilities</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;">As a client company, you are responsible for: providing accurate and complete project briefs, funding escrow before work begins, releasing milestone payments within 5 business days of confirmed delivery, and maintaining confidentiality of all firm proposals received.</p>
            <p>You agree not to directly hire or engage firm personnel encountered through Exknot for 24 months following any engagement, without paying a placement fee of 15% of the first year's total compensation to Exknot.</p>
        </div>
    </div>

    {{-- Firm responsibilities --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">Expert firm responsibilities</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;">Firms must maintain accurate, current credentials throughout their time on the platform. Annual re-verification is required for all registered firms. Firms must respond to qualified requests within 48 hours, or update their availability status accordingly.</p>
            <p style="margin-bottom:14px;">Deliverables must match the scope described in accepted proposals. Quality disputes are handled via Exknot's mediation process before any escrow release decision is made.</p>
            <p>Firms may not simultaneously hold more than 20 active bids at once. This cap exists to protect the quality of responses received by clients.</p>
        </div>
    </div>

    {{-- Commission --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">Commission structure</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;">Exknot charges an <strong style="color:var(--text-1);">8% platform commission</strong> on all contracts facilitated through the platform. This is deducted automatically from escrow at each milestone release.</p>
            <p style="margin-bottom:14px;">Commission applies to: initial contract value, approved scope extensions, and milestone top-ups. It does not apply to: continuation contracts signed directly between parties more than 24 months after their last active Exknot engagement.</p>
            <p>VAT is applied per applicable EU rules. French clients receive invoices from Exknot SAS. Non-EU clients receive invoices exempt from French VAT under reverse charge rules.</p>
        </div>
    </div>

    {{-- Dispute resolution --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">Dispute resolution</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;">Disputes are handled in three stages: (1) direct negotiation with a 10-day window, (2) Exknot mediation with a neutral reviewer assigned from our team, (3) binding arbitration under ICC rules in Paris if mediation fails.</p>
            <p>Exknot's decision on escrow release during mediation is final. Both parties must submit evidence within 5 business days of mediation opening. The reviewer issues a written decision within 15 business days.</p>
        </div>
    </div>

    {{-- Account termination --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:48px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">Account termination</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;">You may close your account at any time from your profile settings. All active contracts must be resolved or mutually cancelled before closure. Escrowed funds are returned to the funding party within 10 business days of account closure.</p>
            <p>Exknot may suspend or terminate accounts for: verified Terms violations, sustained low response rates (firms only), failed re-verification, or court/regulatory order. We provide 14 days written notice for non-urgent terminations.</p>
        </div>
    </div>

    <div class="reveal" style="border-top:1px solid rgba(255,255,255,0.06);padding-top:40px;">
        <p style="font-size:14px;color:var(--text-2);line-height:1.75;">Questions about these terms: <a href="mailto:legal@exknot.com" style="color:var(--teal);">legal@exknot.com</a><br><br>Exknot SAS · RCS Paris · SIRET 123 456 789 00012</p>
    </div>

</div>
@endsection

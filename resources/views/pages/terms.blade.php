@extends('layouts.app')
@section('title', 'Terms of Service')

@section('content')
<div style="max-width:800px;margin:0 auto;padding:80px 32px;">

    <div style="margin-bottom:64px;">
        <div class="label reveal" style="margin-bottom:16px;">Legal</div>
        <h1 class="reveal reveal-delay-1">Terms of <span class="gradient-text">Service</span></h1>
        <p class="reveal reveal-delay-2" style="font-size:14px;color:var(--text-3);font-style:italic;margin-top:16px;">Last updated: April 2026 — Governed by French law</p>
    </div>

    <div class="reveal glass" style="padding:24px 28px;margin-bottom:52px;border-color:rgba(0,229,160,0.15);">
        <p style="font-size:14px;color:var(--text-2);line-height:1.8;">These terms govern your use of Exknot, a B2B marketplace operated by Exknot SAS (Paris, France). By creating an account you agree to these terms. If you represent a company, you confirm you have authority to bind that company to this agreement.</p>
    </div>

    @foreach([
        ['Platform usage rules', [
            ['B2B-only platform', 'All users must represent a legitimate legal entity. Personal freelance profiles are not permitted under any account type.'],
            ['Prohibited activities', 'You may not: solicit contacts off-platform to avoid commission, post false credentials or fabricated reviews, circumvent escrow for payments, or engage in market manipulation.'],
            ['Enforcement', 'Violations result in immediate account suspension. Egregious violations (fraud, identity falsification, escrow manipulation) are reported to relevant authorities under applicable French and EU law.'],
        ]],
        ['Client responsibilities', [
            ['Project briefs', 'You are responsible for providing accurate and complete project briefs, funding escrow before work begins, releasing milestone payments within 5 business days of confirmed delivery, and maintaining confidentiality of all firm proposals.'],
            ['Non-solicitation', 'You agree not to directly hire or engage firm personnel encountered through Exknot for 24 months following any engagement, without paying a placement fee of 15% to Exknot.'],
        ]],
        ['Expert firm responsibilities', [
            ['Credential maintenance', 'Firms must maintain accurate, current credentials. Annual re-verification is required. Firms must respond to qualified requests within 48 hours, or update availability status.'],
            ['Deliverables', 'Must match the scope described in accepted proposals. Quality disputes are handled via Exknot\'s mediation process before any escrow release decision.'],
            ['Active bid limit', 'Firms may not hold more than 20 active bids at once. This cap protects the quality of responses received by clients.'],
        ]],
        ['Commission structure', [
            ['Platform commission', 'Exknot charges an 8% platform commission on all contracts facilitated through the platform, deducted automatically from escrow at each milestone release.'],
            ['Commission scope', 'Applies to: initial contract value, approved scope extensions, and milestone top-ups. Does not apply to continuation contracts signed directly between parties more than 24 months after their last active Exknot engagement.'],
            ['Tax handling', 'VAT is applied per applicable EU rules. French clients receive invoices from Exknot SAS. Non-EU clients receive invoices exempt from French VAT under reverse charge rules.'],
        ]],
        ['Dispute resolution', [
            ['Three-stage process', 'Disputes are handled in three stages: (1) direct negotiation with a 10-day window, (2) Exknot mediation with a neutral reviewer, (3) binding arbitration under ICC rules in Paris if mediation fails.'],
            ['Escrow decisions', 'Exknot\'s decision on escrow release during mediation is final. Both parties must submit evidence within 5 business days. The reviewer issues a written decision within 15 business days.'],
        ]],
        ['Account termination', [
            ['Voluntary closure', 'You may close your account at any time from your profile settings. All active contracts must be resolved or mutually cancelled before closure. Escrowed funds are returned within 10 business days.'],
            ['Platform-initiated', 'Exknot may suspend or terminate accounts for: verified Terms violations, sustained low response rates (firms only), failed re-verification, or court/regulatory order. We provide 14 days written notice for non-urgent terminations.'],
        ]],
    ] as $si => [$sectionTitle, $items])
    <div class="reveal glass" style="padding:36px;margin-bottom:16px;">
        <h2 style="font-family:'Outfit',sans-serif;font-size:22px;font-weight:400;color:var(--teal);margin-bottom:20px;">{{ $sectionTitle }}</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.85;">
            @foreach($items as [$itemTitle, $itemDesc])
            <p style="margin-bottom:16px;"><strong style="color:var(--text-1);">{{ $itemTitle }}</strong> — {{ $itemDesc }}</p>
            @endforeach
        </div>
    </div>
    @endforeach

    <div class="reveal" style="border-top:1px solid var(--border);padding-top:44px;margin-top:44px;">
        <p style="font-size:14px;color:var(--text-2);line-height:1.8;">Questions about these terms: <a href="mailto:legal@exknot.com" style="color:var(--teal);text-decoration:none;">legal@exknot.com</a><br><br>Exknot SAS · RCS Paris · SIRET 123 456 789 00012</p>
    </div>
</div>
@endsection

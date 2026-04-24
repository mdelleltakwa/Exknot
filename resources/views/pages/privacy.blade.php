@extends('layouts.app')
@section('title', 'Privacy Policy')

@section('content')
<div style="max-width:800px;margin:0 auto;padding:80px 32px;">

    <div style="margin-bottom:64px;">
        <div class="label reveal" style="margin-bottom:16px;">Legal</div>
        <h1 class="reveal reveal-delay-1">Privacy <span class="gradient-text">Policy</span></h1>
        <p class="reveal reveal-delay-2" style="font-size:14px;color:var(--text-3);font-style:italic;margin-top:16px;">Last updated: April 2026</p>
    </div>

    <div class="reveal glass" style="padding:24px 28px;margin-bottom:52px;border-color:rgba(0,229,160,0.15);">
        <p style="font-size:14px;color:var(--text-2);line-height:1.8;">Exknot is a B2B expertise marketplace. This policy explains how we handle data from companies seeking expert firms, and from firms listing their services. We've kept it readable — if something is unclear, contact us at <a href="mailto:privacy@exknot.com" style="color:var(--teal);text-decoration:none;">privacy@exknot.com</a>.</p>
    </div>

    @foreach([
        ['Data we collect', [
            ['Account information', 'Your name, professional email address, company name, and VAT number (for firms). We collect what\'s necessary to verify identity and facilitate contracts.'],
            ['Usage data', 'Pages visited, search queries, proposals viewed, messages sent. We use this to improve matching quality, not to build advertising profiles.'],
            ['Transaction data', 'Order values, payment status, contract milestones. Stored for 7 years as required by EU financial regulations.'],
            ['Cookies', 'Session cookies (required), preference cookies (optional), and anonymous analytics via a self-hosted instance. No third-party advertising cookies.'],
        ]],
        ['How we use your data', [
            ['Service delivery', 'To match your project brief with qualified firms, process payments via escrow, and facilitate contracts through their full lifecycle.'],
            ['Security and fraud prevention', 'To detect irregular activity, verify firm credentials on an ongoing basis, and protect escrow funds from unauthorized release.'],
            ['Platform improvements', 'Anonymized, aggregated data helps us improve matching algorithms and response-time SLAs. We never use individual profiles for model training without explicit consent.'],
        ]],
        ['Data sharing', [
            ['We do not sell your data.', 'Full stop. Exknot\'s business model is commission-based, not advertising-based. Your data is not a product line.'],
            ['Third-party processors', 'We share limited data with: payment processing (Stripe), identity verification, and cloud infrastructure (AWS — European regions only). Each processor is bound under GDPR agreements.'],
            ['Firm engagement', 'When you engage a firm, your project brief and contact details are shared only with that specific firm, only after you initiate contact.'],
        ]],
        ['Your rights', [
            ['Access', 'Request a full export of your personal data at any time directly from your profile settings. No form required.'],
            ['Deletion', 'Request account deletion and data erasure. Transaction records required by EU law are retained for 7 years in anonymized form.'],
            ['Portability', 'Receive your data in a machine-readable format (JSON or CSV) within 30 days of request.'],
            ['Correction', 'Update incorrect data directly in your profile, or contact us for records you cannot edit yourself. We action corrections within 5 business days.'],
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
        <h2 style="font-family:'Outfit',sans-serif;font-size:18px;font-weight:400;color:var(--text-1);margin-bottom:14px;">Questions about this policy</h2>
        <p style="font-size:14px;color:var(--text-2);line-height:1.8;">Contact our data protection team: <a href="mailto:privacy@exknot.com" style="color:var(--teal);text-decoration:none;">privacy@exknot.com</a>. We respond within 5 business days.<br><br>Exknot SAS · 10 Rue du Faubourg Saint-Honoré · 75008 Paris, France</p>
    </div>
</div>
@endsection

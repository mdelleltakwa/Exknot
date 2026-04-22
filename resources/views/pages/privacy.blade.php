@extends('layouts.app')
@section('title', 'Privacy Policy')

@section('content')
<div style="max-width:768px;margin:0 auto;padding:80px 32px;">

    {{-- Hero --}}
    <div style="margin-bottom:64px;">
        <div class="label reveal" style="margin-bottom:16px;">Legal</div>
        <h1 class="reveal" style="font-size:clamp(32px,5vw,48px);margin-bottom:16px;">Privacy Policy</h1>
        <p class="reveal" style="font-size:14px;color:var(--text-3);font-style:italic;">Last updated: April 2026</p>
    </div>

    <div class="reveal" style="background:rgba(0,200,150,0.05);border:1px solid rgba(0,200,150,0.15);border-radius:12px;padding:20px 24px;margin-bottom:48px;">
        <p style="font-size:14px;color:var(--text-2);line-height:1.75;">Exknot is a B2B expertise marketplace. This policy explains how we handle data from companies seeking expert firms, and from firms listing their services on the platform. We've kept it readable on purpose — if something is unclear, contact us at <a href="mailto:privacy@exknot.com" style="color:var(--teal);">privacy@exknot.com</a>.</p>
    </div>

    {{-- Data we collect --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">Data we collect</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;"><strong style="color:var(--text-1);">Account information</strong> — your name, professional email address, company name, and VAT number (for firms). We collect what's necessary to verify identity and facilitate contracts.</p>
            <p style="margin-bottom:14px;"><strong style="color:var(--text-1);">Usage data</strong> — pages visited, search queries, proposals viewed, messages sent. We use this to improve matching quality, not to build advertising profiles.</p>
            <p style="margin-bottom:14px;"><strong style="color:var(--text-1);">Transaction data</strong> — order values, payment status, contract milestones. Stored for 7 years as required by EU financial regulations.</p>
            <p><strong style="color:var(--text-1);">Cookies</strong> — session cookies (required), preference cookies (optional), and anonymous analytics via a self-hosted instance. No third-party advertising cookies.</p>
        </div>
    </div>

    {{-- How we use your data --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">How we use your data</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;"><strong style="color:var(--text-1);">Service delivery</strong> — to match your project brief with qualified firms, process payments via escrow, and facilitate contracts through their full lifecycle.</p>
            <p style="margin-bottom:14px;"><strong style="color:var(--text-1);">Security and fraud prevention</strong> — to detect irregular activity, verify firm credentials on an ongoing basis, and protect escrow funds from unauthorized release.</p>
            <p><strong style="color:var(--text-1);">Platform improvements</strong> — anonymized, aggregated data helps us improve matching algorithms and response-time SLAs. We never use individual profiles for model training without explicit, informed consent.</p>
        </div>
    </div>

    {{-- Data sharing --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">Data sharing</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;"><strong style="color:var(--text-1);">We do not sell your data.</strong> Full stop. Exknot's business model is commission-based, not advertising-based. Your data is not a product line.</p>
            <p style="margin-bottom:14px;">We share limited data with verified third-party processors for: payment processing (Stripe), identity verification, and cloud infrastructure (AWS — European regions only). Each processor is contractually bound under GDPR data processing agreements.</p>
            <p>When you engage a firm through Exknot, your project brief and contact details are shared only with that specific firm, only after you initiate contact. Firms cannot access your data speculatively.</p>
        </div>
    </div>

    {{-- Your rights --}}
    <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
        <h2 style="font-size:20px;font-weight:400;color:#00C896;margin-bottom:16px;letter-spacing:-0.02em;">Your rights</h2>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;">
            <p style="margin-bottom:14px;"><strong style="color:var(--text-1);">Access</strong> — request a full export of your personal data at any time directly from your profile settings. No form required.</p>
            <p style="margin-bottom:14px;"><strong style="color:var(--text-1);">Deletion</strong> — request account deletion and data erasure. Transaction records required by EU law are retained for 7 years in anonymized form.</p>
            <p style="margin-bottom:14px;"><strong style="color:var(--text-1);">Portability</strong> — receive your data in a machine-readable format (JSON or CSV) within 30 days of request.</p>
            <p><strong style="color:var(--text-1);">Correction</strong> — update incorrect data directly in your profile, or contact us for records you cannot edit yourself. We action corrections within 5 business days.</p>
        </div>
    </div>

    {{-- Contact --}}
    <div class="reveal" style="border-top:1px solid rgba(255,255,255,0.06);padding-top:40px;margin-top:40px;">
        <h2 style="font-size:18px;font-weight:400;color:var(--text-1);margin-bottom:12px;letter-spacing:-0.02em;">Questions about this policy</h2>
        <p style="font-size:14px;color:var(--text-2);line-height:1.75;">Contact our data protection team: <a href="mailto:privacy@exknot.com" style="color:var(--teal);">privacy@exknot.com</a>. We respond within 5 business days.<br><br>Exknot SAS · 10 Rue du Faubourg Saint-Honoré · 75008 Paris, France</p>
    </div>

</div>
@endsection

@extends('layouts.app')
@section('title', 'Exknot — The Private Network for Serious Expertise')

@section('content')

    {{-- ═══════════════════════ HERO SECTION ═══════════════════════ --}}
    <section style="padding:120px 32px 60px;max-width:1300px;margin:0 auto;position:relative;overflow:visible;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;">
            
            {{-- Left: The Promise --}}
            <div style="position:relative;z-index:2;">


                <h1 class="reveal reveal-delay-1 text-balance" style="margin-bottom:28px;">
                    The private network where serious companies find <span class="gradient-text">verified expertise</span>.
                </h1>

                <p class="reveal reveal-delay-2" style="font-size:18px;color:var(--text-2);line-height:1.75;max-width:520px;margin-bottom:48px;">
                    Bypass the noise of freelance boards and cold outreach. Connect directly with vetted consulting, engineering, and audit firms ready to execute complex B2B engagements.
                </p>

                <div class="reveal reveal-delay-3" style="display:flex;align-items:center;gap:16px;margin-bottom:40px;flex-wrap:wrap;">
                    <a href="{{ route('services.index') }}" class="btn-primary magnetic" style="padding:16px 32px;font-size:15px;">
                        Submit a Project Brief
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('register') }}" class="btn-ghost" style="padding:16px 28px;font-size:15px;">
                        Apply for Firm Verification
                    </a>
                </div>

                <div class="reveal reveal-delay-4" style="font-family:'JetBrains Mono',monospace;font-size:11px;color:var(--text-3);display:flex;align-items:center;gap:20px;letter-spacing:0.02em;">
                    <span style="display:flex;align-items:center;gap:6px;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg> 3-Stage Vetting</span>
                    <span style="display:flex;align-items:center;gap:6px;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg> Secure Escrow</span>
                    <span style="display:flex;align-items:center;gap:6px;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg> 48h SLA</span>
                </div>
            </div>

            {{-- Right: Platform Mockup --}}
            <div class="reveal reveal-delay-2" style="position:relative;perspective:1000px;display:none;@media(min-width:1024px){display:block;}">
                <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:120%;height:120%;background:radial-gradient(circle,rgba(0,229,160,0.08),transparent 70%);filter:blur(60px);z-index:0;"></div>
                
                {{-- Mockup UI Card --}}
                <div class="tilt-card glass" style="position:relative;z-index:1;padding:24px;border:1px solid rgba(255,255,255,0.08);background:rgba(13,17,23,0.8);box-shadow:0 30px 60px rgba(0,0,0,0.6), inset 0 1px 0 rgba(255,255,255,0.1);transform:rotateY(-8deg) rotateX(4deg);">
                    
                    {{-- Fake Header --}}
                    <div style="display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid var(--border);padding-bottom:16px;margin-bottom:20px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,#1A202C,#2D3748);display:flex;align-items:center;justify-content:center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            </div>
                            <div>
                                <div style="font-size:14px;font-weight:500;color:var(--text-1);">Helios Cybernetics GmbH</div>
                                <div style="font-size:11px;color:var(--teal);font-family:'JetBrains Mono',monospace;">VERIFIED FIRM #A892</div>
                            </div>
                        </div>
                        <span class="badge badge-teal">Matched</span>
                    </div>

                    {{-- Fake Content --}}
                    <div style="margin-bottom:24px;">
                        <div style="font-size:11px;text-transform:uppercase;color:var(--text-3);margin-bottom:8px;letter-spacing:0.06em;">Active Proposal</div>
                        <div style="font-size:16px;color:var(--text-1);font-weight:500;margin-bottom:6px;">GDPR Compliance Audit & Architecture Review</div>
                        <p style="font-size:12px;color:var(--text-2);line-height:1.6;">Comprehensive assessment of current data workflows, identifying non-compliant data silos, and providing a remediated architecture blueprint within 4 weeks.</p>
                    </div>

                    {{-- Fake Escrow Block --}}
                    <div style="background:rgba(0,0,0,0.3);border:1px solid var(--border);border-radius:8px;padding:16px;display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <div style="font-size:11px;color:var(--text-3);margin-bottom:4px;">Engagement Value</div>
                            <div style="font-family:'Outfit',sans-serif;font-size:24px;color:var(--text-1);">€24,500</div>
                        </div>
                        <div style="text-align:right;">
                            <div style="font-size:11px;color:var(--text-3);margin-bottom:4px;">Escrow Status</div>
                            <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--gold);">
                                <span class="pulse-dot" style="background:var(--gold);"></span> Funds Secured
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ═══════════════════════ TRUST STRIP ═══════════════════════ --}}
    <section style="padding:40px 0 80px;border-bottom:1px solid var(--border);position:relative;">
        <div style="text-align:center;font-family:'JetBrains Mono',monospace;font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-3);margin-bottom:20px;">Engineered for complex requirements across</div>
        <div class="reveal" style="display:flex;overflow:hidden;position:relative;width:100%;">
            <div style="display:flex;animation:marquee 40s linear infinite;width:max-content;opacity:0.8;">
                @for($i = 0; $i < 3; $i++)
                @foreach(['Financial Audit','Cybersecurity','Supply Chain Optimization','Legal Advisory','Enterprise IT','Compliance & Regulatory','Cloud Architecture','Mergers & Acquisitions','ESG Strategy'] as $cat)
                <span style="padding:0 32px;font-family:'Outfit',sans-serif;font-size:18px;color:var(--text-2);white-space:nowrap;display:flex;align-items:center;gap:32px;">
                    {{ $cat }}
                    <span style="width:4px;height:4px;border-radius:50%;background:rgba(255,255,255,0.1);"></span>
                </span>
                @endforeach
                @endfor
            </div>
            <div style="position:absolute;inset:0;background:linear-gradient(90deg, var(--bg-base) 0%, transparent 15%, transparent 85%, var(--bg-base) 100%);pointer-events:none;"></div>
        </div>
    </section>

    {{-- ═══════════════════════ HOW IT WORKS ═══════════════════════ --}}
    <section style="padding:100px 32px;max-width:1300px;margin:0 auto;">
        <div style="margin-bottom:60px;text-align:center;">
            <div class="label reveal" style="margin-bottom:14px;justify-content:center;display:flex;">Sourcing Workflow</div>
            <h2 class="reveal reveal-delay-1" style="max-width:600px;margin:0 auto;">Clarity over complexity.<br><span class="gradient-text">Execute with precision.</span></h2>
        </div>

        <div class="timeline-grid">
            {{-- Step 1 --}}
            <div class="reveal glass tilt-card" style="padding:40px;position:relative;overflow:hidden;">
                <div style="font-family:'JetBrains Mono',monospace;font-size:64px;font-weight:100;color:rgba(255,255,255,0.03);position:absolute;top:20px;right:20px;line-height:1;">01</div>
                <div style="width:40px;height:40px;border-radius:10px;background:rgba(0,229,160,0.1);border:1px solid rgba(0,229,160,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="1.5" stroke-linecap="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <h3 style="font-size:18px;color:var(--text-1);margin-bottom:12px;">Define the Scope</h3>
                <p style="font-size:14px;color:var(--text-2);line-height:1.7;">Submit a structured project brief detailing requirements, budget, and timeline. No sales calls. Just your technical parameters, securely routed to matching firms.</p>
            </div>
            
            {{-- Step 2 --}}
            <div class="reveal reveal-delay-1 glass tilt-card" style="padding:40px;position:relative;overflow:hidden;">
                <div style="font-family:'JetBrains Mono',monospace;font-size:64px;font-weight:100;color:rgba(255,255,255,0.03);position:absolute;top:20px;right:20px;line-height:1;">02</div>
                <div style="width:40px;height:40px;border-radius:10px;background:rgba(212,168,83,0.1);border:1px solid rgba(212,168,83,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <h3 style="font-size:18px;color:var(--text-1);margin-bottom:12px;">Proposals in 48h</h3>
                <p style="font-size:14px;color:var(--text-2);line-height:1.7;">Receive tailored, actionable proposals within 48 hours. Every response comes from a firm that has already passed our strict legal and financial vetting protocol.</p>
            </div>

            {{-- Step 3 --}}
            <div class="reveal reveal-delay-2 glass tilt-card" style="padding:40px;position:relative;overflow:hidden;">
                <div style="font-family:'JetBrains Mono',monospace;font-size:64px;font-weight:100;color:rgba(255,255,255,0.03);position:absolute;top:20px;right:20px;line-height:1;">03</div>
                <div style="width:40px;height:40px;border-radius:10px;background:rgba(0,229,160,0.1);border:1px solid rgba(0,229,160,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
                <h3 style="font-size:18px;color:var(--text-1);margin-bottom:12px;">Execute Securely</h3>
                <p style="font-size:14px;color:var(--text-2);line-height:1.7;">Contract digitally and hold funds in escrow directly through Exknot. Funds are only released when mutually agreed milestones are verifiably delivered.</p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════ USE CASES (BENTO GRID) ═══════════════════════ --}}
    <section style="padding:100px 32px;max-width:1300px;margin:0 auto;">
        <div style="margin-bottom:60px;">
            <div class="label reveal" style="margin-bottom:14px;">B2B Scenarios</div>
            <h2 class="reveal reveal-delay-1" style="max-width:500px;">Built for the demands of<br><span class="gradient-text">modern enterprise.</span></h2>
        </div>

        <div class="bento-grid">
            
            {{-- Big Box 1 --}}
            <div class="bento-item bento-col-7 glass reveal" style="padding:48px;display:flex;flex-direction:column;justify-content:space-between;background:linear-gradient(135deg, rgba(13,17,23,0.8), rgba(7,9,13,0.9));">
                <div>
                    <span class="badge badge-teal" style="margin-bottom:20px;">Compliance & Legal</span>
                    <h3 style="font-size:24px;color:var(--text-1);margin-bottom:16px;">"We need a GDPR compliance audit before our Series B."</h3>
                    <p style="font-size:15px;color:var(--text-2);line-height:1.7;max-width:400px;">Source specialized legal and data architecture firms capable of performing deep-dive compliance audits with certified documentation.</p>
                </div>
            </div>

            {{-- Small Box 1 --}}
            <div class="bento-item bento-col-5 glass reveal reveal-delay-1" style="padding:40px;">
                <div style="width:36px;height:36px;border-radius:8px;background:rgba(212,168,83,0.1);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2" stroke-linecap="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                </div>
                <h3 style="font-size:18px;color:var(--text-1);margin-bottom:12px;">Offshore Engineering</h3>
                <p style="font-size:14px;color:var(--text-2);line-height:1.6;">Engage vetted agency teams for a 6-month React Native migration without the overhead of internal hiring.</p>
            </div>

            {{-- Small Box 2 --}}
            <div class="bento-item bento-col-5 glass reveal reveal-delay-2" style="padding:40px;">
                <div style="width:36px;height:36px;border-radius:8px;background:rgba(0,229,160,0.1);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2" stroke-linecap="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                </div>
                <h3 style="font-size:18px;color:var(--text-1);margin-bottom:12px;">Supply Chain Audit</h3>
                <p style="font-size:14px;color:var(--text-2);line-height:1.6;">Verify international supplier compliance through independent, locally stationed inspection firms.</p>
            </div>

            {{-- Big Box 2 --}}
            <div class="bento-item bento-col-7 glass reveal reveal-delay-3" style="padding:48px;display:flex;flex-direction:column;justify-content:space-between;background:linear-gradient(135deg, rgba(13,17,23,0.8), rgba(7,9,13,0.9));">
                <div>
                    <span class="badge badge-amber" style="margin-bottom:20px;">Financial Services</span>
                    <h3 style="font-size:24px;color:var(--text-1);margin-bottom:16px;">"We require M&A technical due diligence in 14 days."</h3>
                    <p style="font-size:15px;color:var(--text-2);line-height:1.7;max-width:400px;">Deploy expert technical and financial auditors rapidly. Exknot's escrow system securely handles 6-figure consulting engagements.</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ═══════════════════════ WHY EXKNOT (DIFFERENTIATION) ═══════════════════════ --}}
    <section style="padding:100px 32px;max-width:1300px;margin:0 auto;">
        <div style="margin-bottom:60px;text-align:center;">
            <div class="label reveal" style="margin-bottom:14px;justify-content:center;display:flex;">Differentiation</div>
            <h2 class="reveal reveal-delay-1" style="max-width:600px;margin:0 auto;">Not a freelance board.<br><span class="gradient-text">A professional network.</span></h2>
        </div>

        <div class="reveal glass" style="overflow-x:auto;">
            <table class="data-table" style="min-width:700px;">
                <thead>
                    <tr>
                        <th style="width:30%;">Feature</th>
                        <th style="width:35%;color:var(--text-1);font-weight:700;font-size:14px;">Exknot</th>
                        <th style="width:35%;">Traditional Freelance Platforms</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Entity Type</strong></td>
                        <td style="color:var(--teal);">Registered Firms & Agencies Only</td>
                        <td style="color:var(--text-3);">Solo freelancers & unverified individuals</td>
                    </tr>
                    <tr>
                        <td><strong>Vetting Standard</strong></td>
                        <td style="color:var(--teal);">Manual legal & financial verification</td>
                        <td style="color:var(--text-3);">Automated email verification</td>
                    </tr>
                    <tr>
                        <td><strong>Financial Security</strong></td>
                        <td style="color:var(--teal);">B2B Escrow up to €500k</td>
                        <td style="color:var(--text-3);">Basic credit card processing</td>
                    </tr>
                    <tr>
                        <td><strong>Response Time</strong></td>
                        <td style="color:var(--teal);">Strict 48-hour SLA</td>
                        <td style="color:var(--text-3);">Variable (days or weeks)</td>
                    </tr>
                    <tr>
                        <td><strong>Project Scope</strong></td>
                        <td style="color:var(--teal);">Complex, multi-disciplinary engagements</td>
                        <td style="color:var(--text-3);">Small, isolated tasks</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- ═══════════════════════ FINAL CTA ═══════════════════════ --}}
    <section style="padding:140px 32px 160px;text-align:center;position:relative;">
        <div style="position:relative;max-width:620px;margin:0 auto;z-index:1;">
            <div class="label reveal" style="margin-bottom:24px;justify-content:center;display:flex;">Initiate Project</div>
            <h2 class="reveal reveal-delay-1" style="margin-bottom:20px;">Ready to source with<br><span class="gradient-text">absolute certainty?</span></h2>
            <p class="reveal reveal-delay-2" style="color:var(--text-2);font-size:16px;margin-bottom:48px;line-height:1.7;max-width:440px;margin-left:auto;margin-right:auto;">Join the curated network of decision-makers and top-tier firms. No subscription required.</p>
            <div class="reveal reveal-delay-3" style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('services.index') }}" class="btn-primary magnetic" style="padding:16px 36px;font-size:15px;">
                    Post a Requirement
                </a>
                <a href="{{ route('register') }}" class="btn-ghost" style="padding:16px 32px;font-size:15px;">
                    Join as an Expert Firm
                </a>
            </div>
        </div>
    </section>

@endsection

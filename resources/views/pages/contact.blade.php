@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
<div style="max-width:1100px;margin:0 auto;padding:80px 32px;">

    {{-- Hero --}}
    <div style="margin-bottom:64px;">
        <div class="label reveal" style="margin-bottom:16px;">Get in touch</div>
        <h1 class="reveal" style="font-size:clamp(32px,5vw,48px);margin-bottom:16px;">Contact Exknot</h1>
        <p class="reveal" style="font-size:16px;color:var(--text-2);max-width:440px;line-height:1.7;">The right people will read this. We don't use support bots for business inquiries.</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1.6fr;gap:48px;align-items:start;">

        {{-- Left: contact info --}}
        <div>
            <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:32px;margin-bottom:12px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
                <h3 style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);margin-bottom:24px;">Contact channels</h3>
                @foreach([
                    ['General','hello@exknot.com','Partnerships, press, and general inquiries.'],
                    ['Support','support@exknot.com','Platform issues, account help, escrow questions.'],
                    ['For firms','firms@exknot.com','Onboarding, verification, listing your services.'],
                ] as [$label,$email,$note])
                <div style="margin-bottom:24px;">
                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);margin-bottom:5px;">{{ $label }}</div>
                    <a href="mailto:{{ $email }}" style="font-size:13px;color:var(--teal);text-decoration:none;font-family:'JetBrains Mono',monospace;">{{ $email }}</a>
                    <div style="font-size:12px;color:var(--text-3);margin-top:4px;line-height:1.5;">{{ $note }}</div>
                </div>
                @endforeach
            </div>

            <div class="reveal" style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:24px 32px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
                <h3 style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);margin-bottom:16px;">Headquarters</h3>
                <p style="font-size:14px;color:var(--text-2);line-height:1.75;">Exknot SAS<br>10 Rue du Faubourg Saint-Honoré<br>75008 Paris, France</p>
                <p style="font-size:12px;color:var(--text-3);margin-top:12px;line-height:1.6;">European headquarters. All legal notices and data requests should be sent to the Paris address.</p>
            </div>
        </div>

        {{-- Right: contact form --}}
        <div class="reveal">
            <div style="background:var(--bg-surface);border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:40px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.08);">
                <h2 style="font-size:20px;font-weight:400;color:var(--text-1);margin-bottom:8px;letter-spacing:-0.02em;">Send us a message</h2>
                <p style="font-size:13px;color:var(--text-3);margin-bottom:28px;">We respond to all business inquiries within one business day.</p>

                <form method="POST" action="{{ route('contact.send') }}" style="display:flex;flex-direction:column;gap:20px;">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label style="display:block;font-size:11px;color:var(--text-3);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.06em;">Your name</label>
                            <input type="text" name="name" class="input-dark" placeholder="Jean Dupont" value="{{ old('name') }}" required>
                            @error('name')<p style="font-size:12px;color:#FF4560;margin-top:5px;">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label style="display:block;font-size:11px;color:var(--text-3);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.06em;">Work email</label>
                            <input type="email" name="email" class="input-dark" placeholder="you@company.com" value="{{ old('email') }}" required>
                            @error('email')<p style="font-size:12px;color:#FF4560;margin-top:5px;">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label style="display:block;font-size:11px;color:var(--text-3);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.06em;">Subject</label>
                        <select name="subject" class="input-dark" required>
                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a topic</option>
                            <option value="General inquiry" {{ old('subject') === 'General inquiry' ? 'selected' : '' }}>General inquiry</option>
                            <option value="Firm onboarding" {{ old('subject') === 'Firm onboarding' ? 'selected' : '' }}>Firm onboarding</option>
                            <option value="Platform support" {{ old('subject') === 'Platform support' ? 'selected' : '' }}>Platform support</option>
                            <option value="Partnership" {{ old('subject') === 'Partnership' ? 'selected' : '' }}>Partnership</option>
                            <option value="Press & media" {{ old('subject') === 'Press & media' ? 'selected' : '' }}>Press & media</option>
                            <option value="Legal & compliance" {{ old('subject') === 'Legal & compliance' ? 'selected' : '' }}>Legal & compliance</option>
                        </select>
                        @error('subject')<p style="font-size:12px;color:#FF4560;margin-top:5px;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:11px;color:var(--text-3);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.06em;">Message</label>
                        <textarea name="message" class="input-dark" rows="6" placeholder="Tell us what's on your mind. Be specific — the more context you give, the faster we can help." required style="min-height:148px;resize:vertical;">{{ old('message') }}</textarea>
                        @error('message')<p style="font-size:12px;color:#FF4560;margin-top:5px;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <button type="submit" style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(180deg,#00D4A0 0%,#00B884 100%);color:#0A0D12;padding:12px 28px;border-radius:10px;font-weight:500;font-size:14px;border:none;cursor:pointer;box-shadow:inset 0 1px 0 rgba(255,255,255,0.2),0 4px 12px rgba(0,200,150,0.25);font-family:'DM Sans',sans-serif;transition:all 150ms ease;">
                            Send message
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
<div style="max-width:1100px;margin:0 auto;padding:80px 32px;">

    {{-- Hero --}}
    <div style="margin-bottom:72px;">
        <div class="label reveal" style="margin-bottom:16px;">Get in touch</div>
        <h1 class="reveal reveal-delay-1" style="margin-bottom:16px;">Contact <span class="gradient-text">Exknot</span></h1>
        <p class="reveal reveal-delay-2" style="font-size:16px;color:var(--text-2);max-width:460px;line-height:1.75;">The right people will read this. We don't use support bots for business inquiries.</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1.6fr;gap:48px;align-items:start;">

        {{-- Left: contact info --}}
        <div>
            <div class="reveal glass" style="padding:32px;margin-bottom:16px;">
                <h3 style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-3);margin-bottom:28px;">Contact channels</h3>
                @foreach([
                    ['General','hello@exknot.com','Partnerships, press, and general inquiries.'],
                    ['Support','support@exknot.com','Platform issues, account help, escrow questions.'],
                    ['For firms','firms@exknot.com','Onboarding, verification, listing your services.'],
                ] as [$label,$email,$note])
                <div style="margin-bottom:26px;">
                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);margin-bottom:6px;">{{ $label }}</div>
                    <a href="mailto:{{ $email }}" class="btn-text" style="font-family:'JetBrains Mono',monospace;font-size:13px;">{{ $email }}</a>
                    <div style="font-size:12px;color:var(--text-3);margin-top:6px;line-height:1.6;">{{ $note }}</div>
                </div>
                @endforeach
            </div>

            <div class="reveal reveal-delay-1 glass" style="padding:28px 32px;">
                <h3 style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-3);margin-bottom:18px;">Headquarters</h3>
                <p style="font-size:14px;color:var(--text-2);line-height:1.8;">Exknot SAS<br>10 Rue du Faubourg Saint-Honoré<br>75008 Paris, France</p>
                <p style="font-size:12px;color:var(--text-3);margin-top:14px;line-height:1.65;">European headquarters. All legal notices and data requests should be sent to the Paris address.</p>
            </div>
        </div>

        {{-- Right: contact form --}}
        <div class="reveal reveal-delay-2">
            <div class="glass" style="padding:44px;">
                <h2 style="font-family:'Outfit',sans-serif;font-size:22px;font-weight:400;color:var(--text-1);margin-bottom:8px;">Send us a message</h2>
                <p style="font-size:13px;color:var(--text-3);margin-bottom:32px;">We respond to all business inquiries within one business day.</p>

                <form method="POST" action="{{ route('contact.send') }}" style="display:flex;flex-direction:column;gap:22px;">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label style="display:block;font-size:11px;font-weight:600;color:var(--text-3);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.06em;">Your name</label>
                            <input type="text" name="name" class="input-dark" placeholder="Jean Dupont" value="{{ old('name') }}" required>
                            @error('name')<p style="font-size:12px;color:var(--red);margin-top:5px;">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label style="display:block;font-size:11px;font-weight:600;color:var(--text-3);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.06em;">Work email</label>
                            <input type="email" name="email" class="input-dark" placeholder="you@company.com" value="{{ old('email') }}" required>
                            @error('email')<p style="font-size:12px;color:var(--red);margin-top:5px;">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label style="display:block;font-size:11px;font-weight:600;color:var(--text-3);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.06em;">Subject</label>
                        <select name="subject" class="input-dark" required>
                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a topic</option>
                            @foreach(['General inquiry','Firm onboarding','Platform support','Partnership','Press & media','Legal & compliance'] as $opt)
                            <option value="{{ $opt }}" {{ old('subject') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                        @error('subject')<p style="font-size:12px;color:var(--red);margin-top:5px;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:11px;font-weight:600;color:var(--text-3);margin-bottom:8px;text-transform:uppercase;letter-spacing:0.06em;">Message</label>
                        <textarea name="message" class="input-dark" rows="6" placeholder="Tell us what's on your mind..." required style="min-height:160px;">{{ old('message') }}</textarea>
                        @error('message')<p style="font-size:12px;color:var(--red);margin-top:5px;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <button type="submit" class="btn-primary magnetic" style="padding:14px 32px;gap:8px;">
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

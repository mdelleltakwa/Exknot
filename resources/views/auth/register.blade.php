<x-guest-layout>
    <div style="margin-bottom:28px;">
        <h1 style="font-size:22px;font-weight:300;letter-spacing:-0.02em;color:#F0F4F8;margin-bottom:6px;">Create your account</h1>
        <p style="font-size:13px;color:#8892A0;">Join 14,000+ companies already on Exknot</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div style="margin-bottom:16px;">
            <label for="name">Full name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                class="input-dark" required autofocus autocomplete="name"
                placeholder="Jane Smith">
            @error('name')
                <p style="color:#FF4D4F;font-size:12px;margin-top:5px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:16px;">
            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="input-dark" required autocomplete="username"
                placeholder="you@company.com">
            @error('email')
                <p style="color:#FF4D4F;font-size:12px;margin-top:5px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:22px;">
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password"
                    class="input-dark" required autocomplete="new-password"
                    placeholder="Min. 8 chars">
                @error('password')
                    <p style="color:#FF4D4F;font-size:12px;margin-top:5px;">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation">Confirm</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="input-dark" required autocomplete="new-password"
                    placeholder="Repeat password">
                @error('password_confirmation')
                    <p style="color:#FF4D4F;font-size:12px;margin-top:5px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn-primary" style="width:100%;font-size:14px;padding:13px;">Create account</button>

        <p style="font-size:12px;color:#4A5568;text-align:center;margin-top:14px;">
            By creating an account you agree to our <a href="#" style="color:#8892A0;text-decoration:none;" onmouseover="this.style.color='#00C896'" onmouseout="this.style.color='#8892A0'">Terms</a> and <a href="#" style="color:#8892A0;text-decoration:none;" onmouseover="this.style.color='#00C896'" onmouseout="this.style.color='#8892A0'">Privacy policy</a>.
        </p>
    </form>

    <div style="text-align:center;margin-top:20px;padding-top:20px;border-top:1px solid rgba(255,255,255,0.07);">
        <span style="font-size:13px;color:#8892A0;">Already have an account?</span>
        <a href="{{ route('login') }}" style="font-size:13px;color:#00C896;text-decoration:none;margin-left:6px;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Sign in →</a>
    </div>
</x-guest-layout>

<x-guest-layout>
    <div style="margin-bottom:28px;">
        <h1 style="font-size:22px;font-weight:300;letter-spacing:-0.02em;color:#F0F4F8;margin-bottom:6px;">Welcome back</h1>
        <p style="font-size:13px;color:#8892A0;">Sign in to your Exknot account</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
    <div style="background:rgba(0,200,150,0.08);border:1px solid rgba(0,200,150,0.2);color:#00C896;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:20px;">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="margin-bottom:16px;">
            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="input-dark" required autofocus autocomplete="username"
                placeholder="you@company.com">
            @error('email')
                <p style="color:#FF4D4F;font-size:12px;margin-top:5px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <label for="password" style="margin-bottom:0;">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size:12px;color:#8892A0;text-decoration:none;" onmouseover="this.style.color='#00C896'" onmouseout="this.style.color='#8892A0'">Forgot password?</a>
                @endif
            </div>
            <input id="password" type="password" name="password"
                class="input-dark" required autocomplete="current-password"
                placeholder="••••••••">
            @error('password')
                <p style="color:#FF4D4F;font-size:12px;margin-top:5px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;">
            <label for="remember_me" style="display:flex;align-items:center;gap:8px;cursor:pointer;margin-bottom:0;text-transform:none;letter-spacing:normal;font-size:13px;color:#8892A0;">
                <input id="remember_me" type="checkbox" name="remember"
                    style="width:16px;height:16px;accent-color:#00C896;cursor:pointer;">
                Remember me
            </label>
        </div>

        <button type="submit" class="btn-primary" style="width:100%;font-size:14px;padding:13px;">Sign in</button>
    </form>

    <div style="text-align:center;margin-top:22px;padding-top:20px;border-top:1px solid rgba(255,255,255,0.07);">
        <span style="font-size:13px;color:#8892A0;">Don't have an account?</span>
        <a href="{{ route('register') }}" style="font-size:13px;color:#00C896;text-decoration:none;margin-left:6px;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Create one →</a>
    </div>
</x-guest-layout>

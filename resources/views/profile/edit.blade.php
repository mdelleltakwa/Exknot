@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div style="max-width:720px;margin:0 auto;padding:44px 32px 60px;">

    {{-- Profile header --}}
    <div class="reveal" style="display:flex;align-items:center;gap:20px;margin-bottom:36px;padding:28px;background:rgba(255,255,255,0.025);border:1px solid var(--border);border-radius:18px;">
        <div style="width:64px;height:64px;border-radius:18px;background:linear-gradient(135deg,rgba(0,200,150,0.2),rgba(0,200,150,0.07));border:1px solid rgba(0,200,150,0.2);display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:600;color:var(--teal);font-family:'JetBrains Mono',monospace;flex-shrink:0;">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>
        <div style="flex:1;min-width:0;">
            <h1 style="font-size:22px;margin-bottom:6px;">{{ $user->name }}</h1>
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                @if($user->isAdmin())
                    <span class="badge badge-purple">Admin</span>
                @elseif($user->isFirm())
                    <span class="badge badge-teal">Expert Firm</span>
                @else
                    <span class="badge badge-blue">Client</span>
                @endif
                <span style="font-size:13px;color:var(--text-3);">{{ $user->email }}</span>
                @if($user->country)
                    <span style="font-size:13px;color:var(--text-3);">· {{ $user->country }}</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Profile information --}}
    <div class="reveal card-dark" style="padding:28px;margin-bottom:16px;">
        <h2 style="font-size:15px;font-weight:500;margin-bottom:22px;letter-spacing:-0.01em;">Profile information</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('patch')

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);display:block;margin-bottom:8px;">Full name *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-dark" required>
                    @error('name')<p style="color:var(--red);font-size:12px;margin-top:5px;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);display:block;margin-bottom:8px;">Email address *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-dark" required>
                    @error('email')<p style="color:var(--red);font-size:12px;margin-top:5px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);display:block;margin-bottom:8px;">Company name</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}" class="input-dark" placeholder="Your company or firm">
                </div>
                <div>
                    <label style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);display:block;margin-bottom:8px;">Country</label>
                    <input type="text" name="country" value="{{ old('country', $user->country) }}" class="input-dark" placeholder="e.g. France">
                </div>
            </div>

            <div style="margin-bottom:22px;">
                <label style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);display:block;margin-bottom:8px;">Bio</label>
                <textarea name="bio" rows="3" class="input-dark" placeholder="Tell clients about your expertise...">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div style="display:flex;align-items:center;gap:14px;">
                <button type="submit" class="btn-primary" style="padding:10px 24px;font-size:13px;">Save changes</button>
                @if(session('status') === 'profile-updated')
                    <div style="display:flex;align-items:center;gap:6px;font-size:13px;color:var(--teal);">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Saved successfully
                    </div>
                @endif
            </div>
        </form>
    </div>

    {{-- Change password --}}
    <div class="reveal card-dark" style="padding:28px;margin-bottom:16px;">
        <h2 style="font-size:15px;font-weight:500;margin-bottom:22px;letter-spacing:-0.01em;">Change password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf @method('put')

            <div style="margin-bottom:16px;">
                <label style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);display:block;margin-bottom:8px;">Current password</label>
                <input type="password" name="current_password" class="input-dark" autocomplete="current-password">
                @error('current_password', 'updatePassword')<p style="color:var(--red);font-size:12px;margin-top:5px;">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:22px;">
                <div>
                    <label style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);display:block;margin-bottom:8px;">New password</label>
                    <input type="password" name="password" class="input-dark" autocomplete="new-password">
                    @error('password', 'updatePassword')<p style="color:var(--red);font-size:12px;margin-top:5px;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);display:block;margin-bottom:8px;">Confirm password</label>
                    <input type="password" name="password_confirmation" class="input-dark" autocomplete="new-password">
                </div>
            </div>

            <div style="display:flex;align-items:center;gap:14px;">
                <button type="submit" class="btn-primary" style="padding:10px 24px;font-size:13px;">Update password</button>
                @if(session('status') === 'password-updated')
                    <div style="display:flex;align-items:center;gap:6px;font-size:13px;color:var(--teal);">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Password updated
                    </div>
                @endif
            </div>
        </form>
    </div>

    {{-- Danger zone --}}
    <div class="reveal card-dark" style="padding:28px;border-color:rgba(255,77,79,0.15);">
        <h2 style="font-size:15px;font-weight:500;margin-bottom:8px;color:var(--red);letter-spacing:-0.01em;">Danger zone</h2>
        <p style="font-size:13px;color:var(--text-2);margin-bottom:20px;">Once you delete your account, all data will be permanently removed. This action cannot be undone.</p>

        <div x-data="{ confirm: false }">
            <button @click="confirm = true" class="btn-danger">Delete my account</button>

            <div x-show="confirm" x-transition style="margin-top:18px;padding:20px;border-radius:12px;background:rgba(255,77,79,0.05);border:1px solid rgba(255,77,79,0.15);">
                <p style="font-size:13px;color:var(--red);margin-bottom:14px;font-weight:500;">⚠ Are you sure? This cannot be undone.</p>
                <form method="POST" action="{{ route('profile.destroy') }}" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                    @csrf @method('delete')
                    <input type="password" name="password" class="input-dark" placeholder="Confirm your password" style="max-width:220px;">
                    <button type="submit" class="btn-danger">Yes, delete</button>
                    <button type="button" @click="confirm = false" class="btn-ghost" style="padding:9px 18px;font-size:13px;">Cancel</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="px-8 py-12 max-w-3xl mx-auto">

    {{-- Header --}}
    <div style="display:flex;align-items:center;gap:20px;margin-bottom:32px;">
        <div style="width:64px;height:64px;border-radius:16px;background:rgba(29,158,117,.12);display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:300;color:#1D9E75;flex-shrink:0;">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>
        <div>
            <h1 style="font-size:24px;font-weight:300;letter-spacing:-0.02em;">{{ $user->name }}</h1>
            <div style="display:flex;align-items:center;gap:8px;margin-top:4px;">
                @if($user->isAdmin())
                    <span class="badge-purple">Admin</span>
                @elseif($user->isFirm())
                    <span class="badge-teal">Expert Firm</span>
                @else
                    <span class="badge-blue">Client</span>
                @endif
                <span style="font-size:13px;color:#8B95A3;">{{ $user->email }}</span>
            </div>
        </div>
    </div>

    {{-- Update profile form --}}
    <div class="card-dark p-7 mb-6">
        <h2 style="font-size:16px;font-weight:500;margin-bottom:20px;">Profile information</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('patch')

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Full name *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-dark" required>
                    @error('name')<p style="color:#F09595;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-dark" required>
                    @error('email')<p style="color:#F09595;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Company name</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}" class="input-dark" placeholder="Your company or firm">
                </div>
                <div>
                    <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Country</label>
                    <input type="text" name="country" value="{{ old('country', $user->country) }}" class="input-dark" placeholder="e.g. France">
                </div>
            </div>

            <div style="margin-bottom:20px;">
                <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Bio</label>
                <textarea name="bio" rows="3" class="input-dark" placeholder="Tell clients about your expertise...">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div style="display:flex;align-items:center;gap:12px;">
                <button type="submit" class="btn-primary">Save changes</button>
                @if(session('status') === 'profile-updated')
                    <span style="font-size:13px;color:#1D9E75;">✓ Saved successfully</span>
                @endif
            </div>
        </form>
    </div>

    {{-- Update password --}}
    <div class="card-dark p-7 mb-6">
        <h2 style="font-size:16px;font-weight:500;margin-bottom:20px;">Change password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf @method('put')

            <div style="margin-bottom:16px;">
                <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Current password</label>
                <input type="password" name="current_password" class="input-dark" autocomplete="current-password">
                @error('current_password', 'updatePassword')<p style="color:#F09595;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                <div>
                    <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">New password</label>
                    <input type="password" name="password" class="input-dark" autocomplete="new-password">
                    @error('password', 'updatePassword')<p style="color:#F09595;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Confirm password</label>
                    <input type="password" name="password_confirmation" class="input-dark" autocomplete="new-password">
                </div>
            </div>

            <div style="display:flex;align-items:center;gap:12px;">
                <button type="submit" class="btn-primary">Update password</button>
                @if(session('status') === 'password-updated')
                    <span style="font-size:13px;color:#1D9E75;">✓ Password updated</span>
                @endif
            </div>
        </form>
    </div>

    {{-- Delete account --}}
    <div class="card-dark p-7" style="border-color:rgba(226,75,74,.15);">
        <h2 style="font-size:16px;font-weight:500;margin-bottom:8px;">Danger zone</h2>
        <p style="font-size:13px;color:#8B95A3;margin-bottom:16px;">Once you delete your account, all data will be permanently removed.</p>

        <div x-data="{ confirm: false }">
            <button @click="confirm = true" class="btn-danger">Delete my account</button>

            <div x-show="confirm" style="margin-top:16px;padding:16px;border-radius:8px;background:rgba(226,75,74,.05);border:1px solid rgba(226,75,74,.15);">
                <p style="font-size:13px;color:#F09595;margin-bottom:12px;">Are you sure? This cannot be undone.</p>
                <form method="POST" action="{{ route('profile.destroy') }}" style="display:inline;">
                    @csrf @method('delete')
                    <input type="password" name="password" class="input-dark" placeholder="Confirm your password" style="width:200px;display:inline-block;margin-right:8px;">
                    <button type="submit" class="btn-danger">Yes, delete</button>
                </form>
                <button @click="confirm = false" class="btn-ghost" style="margin-left:8px;padding:8px 16px;font-size:13px;">Cancel</button>
            </div>
        </div>
    </div>

</div>
@endsection

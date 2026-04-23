@extends('layouts.app')
@section('title', 'Messages')

@section('content')
<div style="display:flex;min-height:calc(100vh - 130px);">

    {{-- ═══ SIDEBAR ═══ --}}
    <aside class="sidebar" style="border-right:1px solid rgba(255,255,255,0.06);padding:28px 12px;background:rgba(255,255,255,0.015);">
        <div style="padding:12px 14px;margin-bottom:20px;">
            <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,rgba(0,200,150,0.2),rgba(0,200,150,0.06));display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:600;color:var(--teal);font-family:'JetBrains Mono',monospace;margin-bottom:12px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div style="font-size:13px;font-weight:500;color:var(--text-1);margin-bottom:2px;">{{ auth()->user()->name }}</div>
            <div style="font-size:11px;color:var(--text-3);">{{ auth()->user()->company_name ?? 'Individual' }}</div>
        </div>

        <div style="height:1px;background:rgba(255,255,255,0.06);margin-bottom:12px;"></div>

        @if(auth()->user()->isClient())
        <a href="{{ route('dashboard') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Overview
        </a>
        @elseif(auth()->user()->isFirm())
        <a href="{{ route('firm.dashboard') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Overview
        </a>
        @endif
        <a href="{{ route('chat.index') }}" class="sidebar-item active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Messages
            @php $unread = auth()->user()->unreadMessagesCount(); @endphp
            @if($unread > 0)
                <span class="badge badge-teal" style="margin-left:auto;padding:2px 8px;font-size:10px;">{{ $unread }}</span>
            @endif
        </a>
        <a href="{{ route('services.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Browse services
        </a>
        <a href="{{ route('profile.edit') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            My profile
        </a>
    </aside>

    {{-- ═══ MAIN ═══ --}}
    <main style="flex:1;padding:36px 44px;min-width:0;">

        {{-- Header --}}
        <div class="reveal" style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:32px;gap:16px;flex-wrap:wrap;">
            <div>
                <div class="label" style="margin-bottom:8px;">Messages</div>
                <h1 style="font-size:28px;margin-bottom:6px;">Your conversations</h1>
                <p style="color:var(--text-2);font-size:14px;">Chat directly with {{ auth()->user()->isFirm() ? 'your clients' : 'expert firms' }}</p>
            </div>
        </div>

        {{-- Empty state --}}
        @if($conversations->isEmpty())
        <div class="reveal card-dark" style="padding:48px 32px;text-align:center;border-color:rgba(0,200,150,0.12);">
            <div style="width:64px;height:64px;border-radius:18px;background:rgba(0,200,150,0.08);border:1px solid rgba(0,200,150,0.18);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            </div>
            <h3 style="font-size:17px;font-weight:500;margin-bottom:8px;letter-spacing:-0.01em;">No conversations yet</h3>
            <p style="color:var(--text-2);font-size:13px;margin-bottom:24px;max-width:360px;margin-left:auto;margin-right:auto;">
                Browse services and contact a firm to start a conversation.
            </p>
            <a href="{{ route('services.index') }}" class="btn-primary" style="font-size:13px;padding:10px 24px;">Browse services</a>
        </div>
        @else

        {{-- Conversations list --}}
        <div class="reveal card-dark" style="overflow:hidden;">
            @foreach($conversations as $conv)
            @php
                $other = $conv->otherParty(auth()->user());
                $unreadCount = $conv->unreadCountFor(auth()->id());
                $last = $conv->latestMessage;
            @endphp
            <a href="{{ route('chat.show', $conv) }}"
               style="display:flex;align-items:center;gap:16px;padding:18px 24px;border-top:1px solid rgba(255,255,255,0.04);text-decoration:none;transition:background 150ms ease;{{ $loop->first ? 'border-top:none;' : '' }}"
               onmouseover="this.style.background='rgba(255,255,255,0.03)'" onmouseout="this.style.background='transparent'">

                {{-- Avatar --}}
                <div style="width:44px;height:44px;border-radius:14px;background:{{ $unreadCount > 0 ? 'linear-gradient(135deg,rgba(0,200,150,0.3),rgba(0,200,150,0.1))' : 'rgba(255,255,255,0.04)' }};border:1px solid {{ $unreadCount > 0 ? 'rgba(0,200,150,0.3)' : 'rgba(255,255,255,0.06)' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="font-size:13px;font-weight:600;color:{{ $unreadCount > 0 ? 'var(--teal)' : 'var(--text-2)' }};font-family:'JetBrains Mono',monospace;">{{ strtoupper(substr($other->name, 0, 2)) }}</span>
                </div>

                {{-- Info --}}
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                        <span style="font-size:14px;font-weight:{{ $unreadCount > 0 ? '600' : '400' }};color:var(--text-1);">{{ $other->company_name ?? $other->name }}</span>
                        @if($other->isFirm())
                            <span class="badge badge-teal" style="font-size:9px;padding:1px 7px;">Firm</span>
                        @else
                            <span class="badge badge-blue" style="font-size:9px;padding:1px 7px;">Client</span>
                        @endif
                    </div>
                    @if($last)
                    <div style="font-size:12px;color:var(--text-3);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        @if($last->sender_id === auth()->id())
                            <span style="color:var(--text-2);">You:</span>
                        @endif
                        {{ Str::limit($last->body, 60) }}
                    </div>
                    @else
                    <div style="font-size:12px;color:var(--text-3);font-style:italic;">No messages yet</div>
                    @endif
                </div>

                {{-- Right side: time + unread --}}
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;flex-shrink:0;">
                    @if($last)
                    <span style="font-size:11px;color:var(--text-3);">{{ $last->created_at->diffForHumans(null, true, true) }}</span>
                    @endif
                    @if($unreadCount > 0)
                    <span style="background:var(--teal);color:#0A0D12;font-size:10px;font-weight:700;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;">{{ $unreadCount }}</span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        @endif

    </main>
</div>
@endsection

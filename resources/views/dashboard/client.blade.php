@extends('layouts.app')
@section('title', 'Dashboard')

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
            <div style="margin-top:8px;"><span class="badge badge-blue" style="font-size:10px;">Client</span></div>
        </div>

        <div style="height:1px;background:rgba(255,255,255,0.06);margin-bottom:12px;"></div>

        <a href="{{ route('dashboard') }}" class="sidebar-item active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Overview
        </a>
        <a href="{{ route('services.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Find experts
        </a>
        <a href="{{ route('orders.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            My orders
        </a>
        <a href="{{ route('chat.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Messages
            @php $chatUnread = auth()->user()->unreadMessagesCount(); @endphp
            @if($chatUnread > 0)
                <span class="badge badge-teal" style="margin-left:auto;padding:2px 8px;font-size:10px;">{{ $chatUnread }}</span>
            @endif
        </a>
        <a href="{{ route('cart.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.83 1.61H19a2 2 0 001.83-1.61l1.5-8.39H5.17"/></svg>
            Cart
            @php $cartCount = count(session('cart', [])); @endphp
            @if($cartCount > 0)
                <span class="badge badge-teal" style="margin-left:auto;padding:2px 8px;font-size:10px;">{{ $cartCount }}</span>
            @endif
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
                <div class="label" style="margin-bottom:8px;">Client dashboard</div>
                <h1 style="font-size:28px;margin-bottom:6px;">Welcome back, {{ auth()->user()->name }}</h1>
                <p style="color:var(--text-2);font-size:14px;">Your Exknot activity at a glance</p>
            </div>
            <a href="{{ route('services.index') }}" class="btn-primary" style="padding:10px 22px;font-size:13px;flex-shrink:0;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="margin-right:6px;"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                Find an expert
            </a>
        </div>

        {{-- KPIs --}}
        <div class="reveal" style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:28px;">
            <div class="metric-card">
                <div class="metric-lbl">Total orders</div>
                <div class="metric-val">{{ auth()->user()->orders()->count() }}</div>
            </div>
            <div class="metric-card">
                <div class="metric-lbl">Pending orders</div>
                <div class="metric-val" style="color:var(--amber);">{{ auth()->user()->orders()->where('status','pending')->count() }}</div>
            </div>
            <div class="metric-card">
                <div class="metric-lbl">Reviews written</div>
                <div class="metric-val">{{ auth()->user()->reviews()->count() }}</div>
            </div>
        </div>

        {{-- Empty state --}}
        @if(auth()->user()->orders()->count() === 0)
        <div class="reveal card-dark" style="padding:48px 32px;text-align:center;border-color:rgba(0,200,150,0.12);margin-bottom:24px;">
            <div style="width:64px;height:64px;border-radius:18px;background:rgba(0,200,150,0.08);border:1px solid rgba(0,200,150,0.18);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </div>
            <h3 style="font-size:17px;font-weight:500;margin-bottom:8px;letter-spacing:-0.01em;">Find your first expert firm</h3>
            <p style="color:var(--text-2);font-size:13px;margin-bottom:24px;max-width:360px;margin-left:auto;margin-right:auto;">Browse 2,400+ verified consulting, audit and inspection firms worldwide.</p>
            <a href="{{ route('services.index') }}" class="btn-primary" style="font-size:13px;padding:10px 24px;">Browse services</a>
        </div>
        @endif

        {{-- Recent orders --}}
        @if($orders->count() > 0)
        <div class="reveal card-dark" style="margin-bottom:20px;overflow:hidden;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px 16px;">
                <h2 style="font-size:14px;font-weight:500;letter-spacing:-0.01em;">Recent orders</h2>
                <a href="{{ route('orders.index') }}" style="font-size:12px;color:var(--teal);text-decoration:none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">View all →</a>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr style="cursor:pointer;" onclick="window.location='{{ route('orders.show', $order) }}'">
                        <td><span class="mono" style="font-size:12px;">#EXK-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></td>
                        <td style="color:var(--text-2);">{{ $order->created_at->format('M d, Y') }}</td>
                        <td style="font-weight:500;">€{{ number_format($order->total, 0) }}</td>
                        <td>
                            @if($order->status === 'validated')<span class="badge badge-teal">Validated</span>
                            @elseif($order->status === 'pending')<span class="badge badge-amber">Pending</span>
                            @else<span class="badge badge-red">Cancelled</span>@endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        {{-- Recent reviews --}}
        @if($reviews->count() > 0)
        <div class="reveal card-dark" style="overflow:hidden;">
            <div style="padding:20px 24px 16px;">
                <h2 style="font-size:14px;font-weight:500;letter-spacing:-0.01em;">Your reviews</h2>
            </div>
            @foreach($reviews as $review)
            <div style="display:flex;align-items:center;gap:14px;padding:14px 24px;border-top:1px solid rgba(255,255,255,0.04);transition:background 150ms ease;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                <div style="flex:1;min-width:0;">
                    <div style="font-size:13px;font-weight:500;color:var(--text-1);margin-bottom:3px;">{{ $review->product->title }}</div>
                    @if($review->comment)
                    <div style="font-size:12px;color:var(--text-2);">{{ Str::limit($review->comment, 80) }}</div>
                    @endif
                </div>
                <div style="display:flex;align-items:center;gap:2px;flex-shrink:0;">
                    @for($s=1;$s<=5;$s++)
                        <span style="font-size:13px;color:{{ $s <= $review->rating ? 'var(--amber)' : 'var(--text-3)' }};">★</span>
                    @endfor
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </main>
</div>
@endsection

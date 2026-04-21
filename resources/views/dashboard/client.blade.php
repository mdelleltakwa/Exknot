@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div style="display:flex;gap:0;min-height:calc(100vh - 130px);">

    {{-- SIDEBAR --}}
    <div class="sidebar" style="border-right:1px solid rgba(255,255,255,.06);padding:28px 16px;">
        <div style="margin-bottom:24px;padding:0 12px;">
            <div style="font-size:11px;color:#8B95A3;font-weight:500;text-transform:uppercase;letter-spacing:.1em;margin-bottom:4px;">Client account</div>
            <div style="font-size:15px;font-weight:500;color:#E8EDF2;">{{ auth()->user()->name }}</div>
            <div style="font-size:12px;color:#8B95A3;margin-top:2px;">{{ auth()->user()->company_name ?? 'Individual' }}</div>
        </div>

        <a href="{{ route('dashboard') }}" class="sidebar-item active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
            Overview
        </a>
        <a href="{{ route('services.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Find experts
        </a>
        <a href="{{ route('orders.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            My orders
        </a>
        <a href="{{ route('cart.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.83 1.61H19a2 2 0 001.83-1.61l1.5-8.39H5.17"/></svg>
            Cart
            @php $cartCount = count(session('cart', [])); @endphp
            @if($cartCount > 0)
                <span class="badge-teal" style="margin-left:auto;padding:1px 7px;">{{ $cartCount }}</span>
            @endif
        </a>
        <a href="{{ route('profile.edit') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            My profile
        </a>
    </div>

    {{-- MAIN --}}
    <div style="flex:1;padding:32px 40px;">

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;">
            <div>
                <h1 style="font-size:26px;font-weight:300;letter-spacing:-0.02em;">Welcome back, {{ auth()->user()->name }} 👋</h1>
                <p style="color:#8B95A3;font-size:14px;margin-top:4px;">Your Exknot activity at a glance</p>
            </div>
            <a href="{{ route('services.index') }}" class="btn-primary">Find an expert</a>
        </div>

        {{-- KPIs --}}
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:28px;">
            <div class="metric-card">
                <div class="metric-lbl">Total orders</div>
                <div class="metric-val">{{ auth()->user()->orders()->count() }}</div>
            </div>
            <div class="metric-card">
                <div class="metric-lbl">Pending orders</div>
                <div class="metric-val" style="color:#EF9F27;">{{ auth()->user()->orders()->where('status','pending')->count() }}</div>
            </div>
            <div class="metric-card">
                <div class="metric-lbl">Reviews written</div>
                <div class="metric-val">{{ auth()->user()->reviews()->count() }}</div>
            </div>
        </div>

        {{-- CTA if no orders --}}
        @if(auth()->user()->orders()->count() === 0)
        <div class="card-dark p-8 mb-6" style="text-align:center;border:1px solid rgba(29,158,117,.15);">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(29,158,117,.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1D9E75" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </div>
            <h3 style="font-size:16px;font-weight:500;margin-bottom:8px;">Find your first expert firm</h3>
            <p style="color:#8B95A3;font-size:13px;margin-bottom:20px;">Browse 2,400+ verified consulting, audit and inspection firms worldwide.</p>
            <a href="{{ route('services.index') }}" class="btn-primary">Browse services</a>
        </div>
        @endif

        {{-- Recent orders --}}
        @if($orders->count() > 0)
        <div class="card-dark p-6 mb-6">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <h2 style="font-size:15px;font-weight:500;">Recent orders</h2>
                <a href="{{ route('orders.index') }}" style="font-size:13px;color:#1D9E75;">View all</a>
            </div>
            @foreach($orders as $order)
            <a href="{{ route('orders.show', $order) }}" style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;border-radius:8px;margin-bottom:4px;text-decoration:none;transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.03)'" onmouseout="this.style.background='transparent'">
                <div>
                    <span style="font-family:monospace;font-size:12px;color:#1D9E75;">#EXK-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span style="font-size:12px;color:#8B95A3;margin-left:8px;">{{ $order->created_at->diffForHumans() }}</span>
                </div>
                <div style="display:flex;align-items:center;gap:10px;">
                    <span style="font-size:14px;font-weight:500;">€{{ number_format($order->total, 0) }}</span>
                    @if($order->status === 'validated')<span class="badge-teal">Validated</span>
                    @elseif($order->status === 'pending')<span class="badge-amber">Pending</span>
                    @else<span class="badge-red">Cancelled</span>@endif
                </div>
            </a>
            @endforeach
        </div>
        @endif

        {{-- Recent reviews --}}
        @if($reviews->count() > 0)
        <div class="card-dark p-6">
            <h2 style="font-size:15px;font-weight:500;margin-bottom:16px;">Your reviews</h2>
            @foreach($reviews as $review)
            <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.05);">
                <div style="flex:1;">
                    <div style="font-size:13px;font-weight:500;color:#E8EDF2;">{{ $review->product->title }}</div>
                    @if($review->comment)
                    <div style="font-size:12px;color:#8B95A3;margin-top:2px;">{{ Str::limit($review->comment, 80) }}</div>
                    @endif
                </div>
                <div style="color:#EF9F27;font-size:13px;">{{ str_repeat('★', $review->rating) }}<span style="color:#444;">{{ str_repeat('★', 5 - $review->rating) }}</span></div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>
@endsection

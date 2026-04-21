@extends('layouts.app')
@section('title', 'Firm Dashboard')

@section('content')
<div style="display:flex;gap:0;min-height:calc(100vh - 130px);">

    {{-- SIDEBAR --}}
    <div class="sidebar" style="border-right:1px solid rgba(255,255,255,.06);padding:28px 16px;">
        <div style="margin-bottom:24px;padding:0 12px;">
            <div style="font-size:11px;color:#1D9E75;font-weight:500;text-transform:uppercase;letter-spacing:.1em;margin-bottom:4px;">Expert Firm</div>
            <div style="font-size:15px;font-weight:500;color:#E8EDF2;">{{ auth()->user()->company_name ?? auth()->user()->name }}</div>
            <div style="font-size:12px;color:#8B95A3;margin-top:2px;">{{ auth()->user()->country }}</div>
        </div>

        <a href="{{ route('firm.dashboard') }}" class="sidebar-item active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
            Overview
        </a>
        <a href="{{ route('services.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4"/></svg>
            Browse catalogue
        </a>
        <a href="{{ route('firm.services.create') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
            Publish service
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
                <h1 style="font-size:26px;font-weight:300;letter-spacing:-0.02em;">Firm dashboard</h1>
                <p style="color:#8B95A3;font-size:14px;margin-top:4px;">Manage your services and incoming orders</p>
            </div>
            <a href="{{ route('firm.services.create') }}" class="btn-primary">+ Publish a service</a>
        </div>

        {{-- KPIs --}}
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:28px;">
            <div class="metric-card">
                <div class="metric-lbl">Active services</div>
                <div class="metric-val">{{ $services->count() }}</div>
            </div>
            <div class="metric-card">
                <div class="metric-lbl">Total revenue</div>
                <div class="metric-val" style="color:#1D9E75;">€{{ number_format($revenue, 0) }}</div>
                <div class="metric-sub">from validated orders</div>
            </div>
            <div class="metric-card">
                <div class="metric-lbl">Avg. rating</div>
                <div class="metric-val" style="color:#EF9F27;">
                    {{ $services->flatMap->reviews->count() > 0 ? number_format($services->flatMap->reviews->avg('rating'), 1) : '—' }}
                    @if($services->flatMap->reviews->count() > 0)
                        <span style="font-size:14px;color:#8B95A3;">/ 5</span>
                    @endif
                </div>
                <div class="metric-sub">{{ $services->flatMap->reviews->count() }} reviews total</div>
            </div>
        </div>

        {{-- My services --}}
        <div class="card-dark p-6 mb-6">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <h2 style="font-size:15px;font-weight:500;">My services</h2>
                <a href="{{ route('firm.services.create') }}" style="font-size:13px;color:#1D9E75;">+ Add new</a>
            </div>

            @forelse($services as $service)
            <div style="display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid rgba(255,255,255,.05);">
                <div style="width:40px;height:40px;border-radius:8px;background:rgba(29,158,117,.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1D9E75" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83"/></svg>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:14px;font-weight:500;color:#E8EDF2;">{{ $service->title }}</div>
                    <div style="font-size:12px;color:#8B95A3;margin-top:2px;">
                        <span class="badge-teal">{{ $service->category->name }}</span>
                        <span style="margin-left:8px;">€{{ number_format($service->price, 0) }}</span>
                        @if($service->reviews->count() > 0)
                            <span style="margin-left:8px;color:#EF9F27;">★ {{ $service->averageRating() }}</span>
                            <span style="color:#8B95A3;">({{ $service->reviews->count() }})</span>
                        @endif
                    </div>
                </div>
                <div style="display:flex;gap:8px;align-items:center;">
                    <a href="{{ route('services.show', $service) }}" style="font-size:12px;color:#1D9E75;padding:4px 10px;border-radius:6px;border:1px solid rgba(29,158,117,.2);">View</a>
                    <a href="{{ route('firm.services.edit', $service) }}" style="font-size:12px;color:#8B95A3;padding:4px 10px;border-radius:6px;border:1px solid rgba(255,255,255,.08);">Edit</a>
                    <form method="POST" action="{{ route('firm.services.destroy', $service) }}" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this service?')" class="btn-danger" style="padding:4px 10px;font-size:12px;">Delete</button>
                    </form>
                </div>
            </div>
            @empty
            <div style="text-align:center;padding:32px 0;color:#8B95A3;">
                <p style="margin-bottom:12px;">No services yet.</p>
                <a href="{{ route('firm.services.create') }}" class="btn-primary" style="font-size:13px;padding:8px 18px;">Publish your first service</a>
            </div>
            @endforelse
        </div>

        {{-- Incoming orders --}}
        <div class="card-dark p-6">
            <h2 style="font-size:15px;font-weight:500;margin-bottom:16px;">Incoming orders</h2>
            @forelse($orderItems as $item)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.05);">
                <div>
                    <div style="font-size:13px;font-weight:500;color:#E8EDF2;">{{ $item->product->title }}</div>
                    <div style="font-size:11px;color:#8B95A3;margin-top:2px;">
                        from <strong style="color:#C8D0DB;">{{ $item->order->user->name }}</strong>
                        · {{ $item->order->created_at->diffForHumans() }}
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:12px;">
                    <span style="font-size:14px;font-weight:500;">€{{ number_format($item->price * $item->quantity, 0) }}</span>
                    <form method="POST" action="{{ route('firm.orders.status', $item->order) }}">
                        @csrf @method('PATCH')
                        <select name="status" onchange="this.form.submit()" class="input-dark" style="font-size:12px;padding:5px 10px;width:130px;">
                            @foreach(['pending' => 'Pending', 'validated' => 'Validated', 'cancelled' => 'Cancelled'] as $val => $label)
                                <option value="{{ $val }}" @selected($item->order->status === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            @empty
            <p style="color:#8B95A3;font-size:13px;text-align:center;padding:24px 0;">No orders received yet.</p>
            @endforelse
        </div>

    </div>
</div>
@endsection

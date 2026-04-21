@extends('layouts.app')
@section('title', 'Firm Dashboard')

@section('content')
<div style="display:flex;min-height:calc(100vh - 130px);">

    {{-- ═══ SIDEBAR ═══ --}}
    <aside class="sidebar" style="border-right:1px solid rgba(255,255,255,0.06);padding:28px 12px;background:rgba(255,255,255,0.015);">
        <div style="padding:12px 14px;margin-bottom:20px;">
            <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,rgba(0,200,150,0.25),rgba(0,200,150,0.08));display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:600;color:var(--teal);font-family:'JetBrains Mono',monospace;margin-bottom:12px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div style="font-size:13px;font-weight:500;color:var(--text-1);margin-bottom:2px;">{{ auth()->user()->company_name ?? auth()->user()->name }}</div>
            <div style="font-size:11px;color:var(--text-3);">{{ auth()->user()->country ?? 'Expert Firm' }}</div>
            <div style="margin-top:8px;"><span class="badge badge-teal" style="font-size:10px;">Expert Firm</span></div>
        </div>

        <div style="height:1px;background:rgba(255,255,255,0.06);margin-bottom:12px;"></div>

        <a href="{{ route('firm.dashboard') }}" class="sidebar-item active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Overview
        </a>
        <a href="{{ route('services.index') }}" class="sidebar-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
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
    </aside>

    {{-- ═══ MAIN ═══ --}}
    <main style="flex:1;padding:36px 44px;min-width:0;">

        {{-- Header --}}
        <div class="reveal" style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:32px;gap:16px;flex-wrap:wrap;">
            <div>
                <div class="label" style="margin-bottom:8px;">Firm dashboard</div>
                <h1 style="font-size:28px;margin-bottom:6px;">Manage your services</h1>
                <p style="color:var(--text-2);font-size:14px;">Track incoming orders and update your service offerings</p>
            </div>
            <a href="{{ route('firm.services.create') }}" class="btn-primary" style="padding:10px 22px;font-size:13px;flex-shrink:0;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="margin-right:6px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Publish a service
            </a>
        </div>

        {{-- KPIs --}}
        <div class="reveal" style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:28px;">
            <div class="metric-card">
                <div class="metric-lbl">Active services</div>
                <div class="metric-val">{{ $services->count() }}</div>
            </div>
            <div class="metric-card">
                <div class="metric-lbl">Total revenue</div>
                <div class="metric-val" style="color:var(--teal);">€{{ number_format($revenue, 0) }}</div>
                <div class="metric-sub">from validated orders</div>
            </div>
            <div class="metric-card">
                <div class="metric-lbl">Avg. rating</div>
                <div class="metric-val" style="color:var(--amber);">
                    @if($services->flatMap->reviews->count() > 0)
                        {{ number_format($services->flatMap->reviews->avg('rating'), 1) }}
                        <span style="font-size:14px;color:var(--text-3);font-weight:300;">/ 5</span>
                    @else
                        <span style="color:var(--text-3);">—</span>
                    @endif
                </div>
                <div class="metric-sub">{{ $services->flatMap->reviews->count() }} reviews total</div>
            </div>
        </div>

        {{-- My services --}}
        <div class="reveal card-dark" style="margin-bottom:20px;overflow:hidden;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px 16px;">
                <h2 style="font-size:14px;font-weight:500;letter-spacing:-0.01em;">My services</h2>
                <a href="{{ route('firm.services.create') }}" style="font-size:12px;color:var(--teal);text-decoration:none;display:flex;align-items:center;gap:4px;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Add new
                </a>
            </div>

            @forelse($services as $service)
            <div style="display:flex;align-items:center;gap:14px;padding:14px 24px;border-top:1px solid rgba(255,255,255,0.04);transition:background 150ms ease;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                <div style="width:38px;height:38px;border-radius:10px;background:rgba(0,200,150,0.08);border:1px solid rgba(0,200,150,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83"/></svg>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:13px;font-weight:500;color:var(--text-1);margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $service->title }}</div>
                    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                        <span class="badge badge-teal" style="font-size:10px;">{{ $service->category->name }}</span>
                        <span style="font-size:12px;color:var(--text-2);" class="mono">€{{ number_format($service->price, 0) }}</span>
                        @if($service->reviews->count() > 0)
                            <span style="font-size:12px;color:var(--amber);">★ {{ $service->averageRating() }}</span>
                            <span style="font-size:11px;color:var(--text-3);">({{ $service->reviews->count() }})</span>
                        @endif
                    </div>
                </div>
                <div style="display:flex;gap:6px;align-items:center;flex-shrink:0;">
                    <a href="{{ route('services.show', $service) }}" style="font-size:12px;color:var(--teal);padding:5px 12px;border-radius:7px;border:1px solid rgba(0,200,150,0.25);text-decoration:none;transition:all 150ms ease;" onmouseover="this.style.background='rgba(0,200,150,0.08)'" onmouseout="this.style.background='transparent'">View</a>
                    <a href="{{ route('firm.services.edit', $service) }}" style="font-size:12px;color:var(--text-2);padding:5px 12px;border-radius:7px;border:1px solid rgba(255,255,255,0.08);text-decoration:none;transition:all 150ms ease;" onmouseover="this.style.color='var(--text-1)';this.style.borderColor='rgba(255,255,255,0.16)'" onmouseout="this.style.color='var(--text-2)';this.style.borderColor='rgba(255,255,255,0.08)'">Edit</a>
                    <form method="POST" action="{{ route('firm.services.destroy', $service) }}" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this service?')" class="btn-danger" style="padding:5px 12px;font-size:12px;">Delete</button>
                    </form>
                </div>
            </div>
            @empty
            <div style="text-align:center;padding:44px 20px;color:var(--text-3);">
                <div style="width:48px;height:48px;border-radius:14px;background:rgba(0,200,150,0.06);border:1px solid rgba(0,200,150,0.12);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
                <p style="font-size:14px;color:var(--text-2);margin-bottom:16px;">No services yet.</p>
                <a href="{{ route('firm.services.create') }}" class="btn-primary" style="font-size:13px;padding:9px 20px;">Publish your first service</a>
            </div>
            @endforelse
        </div>

        {{-- Incoming orders --}}
        <div class="reveal card-dark" style="overflow:hidden;">
            <div style="padding:20px 24px 16px;">
                <h2 style="font-size:14px;font-weight:500;letter-spacing:-0.01em;">Incoming orders</h2>
            </div>

            @forelse($orderItems as $item)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 24px;border-top:1px solid rgba(255,255,255,0.04);gap:12px;flex-wrap:wrap;transition:background 150ms ease;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                <div style="flex:1;min-width:0;">
                    <div style="font-size:13px;font-weight:500;color:var(--text-1);margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->product->title }}</div>
                    <div style="font-size:12px;color:var(--text-3);">
                        from <strong style="color:var(--text-2);font-weight:500;">{{ $item->order->user->name }}</strong>
                        <span style="margin-left:6px;" class="mono" style="font-size:11px;">#EXK-{{ str_pad($item->order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <span style="margin-left:8px;">· {{ $item->order->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:14px;flex-shrink:0;">
                    <span style="font-size:15px;font-weight:500;color:var(--text-1);" class="mono">€{{ number_format($item->price * $item->quantity, 0) }}</span>
                    <form method="POST" action="{{ route('firm.orders.status', $item->order) }}">
                        @csrf @method('PATCH')
                        <select name="status" onchange="this.form.submit()" class="input-dark" style="font-size:12px;padding:7px 12px;width:140px;">
                            @foreach(['pending' => 'Pending', 'validated' => 'Validated', 'cancelled' => 'Cancelled'] as $val => $label)
                                <option value="{{ $val }}" @selected($item->order->status === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            @empty
            <div style="text-align:center;padding:40px 20px;color:var(--text-3);">
                <p style="font-size:14px;">No orders received yet.</p>
            </div>
            @endforelse
        </div>

    </main>
</div>
@endsection

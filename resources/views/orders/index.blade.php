@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
<div style="max-width:900px;margin:0 auto;padding:44px 32px 60px;">

    <div class="reveal" style="margin-bottom:32px;">
        <div class="label" style="margin-bottom:10px;">Order history</div>
        <h1 style="font-size:32px;">My orders</h1>
        <p style="color:var(--text-2);font-size:14px;margin-top:6px;">All your past and ongoing engagements</p>
    </div>

    @if($orders->isEmpty())
        <div class="reveal card-dark" style="text-align:center;padding:72px 32px;">
            <div style="width:64px;height:64px;border-radius:18px;background:rgba(0,200,150,0.06);border:1px solid rgba(0,200,150,0.12);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <h3 style="font-size:18px;font-weight:400;margin-bottom:8px;">No orders yet</h3>
            <p style="color:var(--text-2);margin-bottom:28px;font-size:14px;">Find an expert firm and place your first order.</p>
            <a href="{{ route('services.index') }}" class="btn-primary" style="font-size:14px;">Browse services</a>
        </div>
    @else
        <div>
            @foreach($orders as $order)
            <div class="reveal card-dark" style="margin-bottom:10px;overflow:hidden;transition:border-color 200ms ease,box-shadow 200ms ease;" onmouseover="this.style.borderColor='rgba(0,200,150,0.2)';this.style.boxShadow='0 8px 30px rgba(0,0,0,0.3)'" onmouseout="this.style.borderColor='var(--border)';this.style.boxShadow='none'">
                <div style="padding:18px 22px;">
                    {{-- Top row --}}
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:12px;flex-wrap:wrap;">
                        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                            <span class="mono" style="font-size:13px;">#EXK-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span style="font-size:12px;color:var(--text-3);">{{ $order->created_at->format('M d, Y') }}</span>
                            <span style="font-size:12px;color:var(--text-3);">{{ $order->created_at->format('H:i') }}</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                            <span style="font-size:17px;font-weight:500;" class="mono">€{{ number_format($order->total, 0) }}</span>
                            @if($order->status === 'validated')
                                <span class="badge badge-teal">Validated</span>
                            @elseif($order->status === 'pending')
                                <span class="badge badge-amber">Pending</span>
                            @else
                                <span class="badge badge-red">Cancelled</span>
                            @endif
                        </div>
                    </div>

                    {{-- Services list --}}
                    <div style="font-size:12px;color:var(--text-3);margin-bottom:14px;padding:10px 14px;background:rgba(255,255,255,0.02);border-radius:8px;border:1px solid rgba(255,255,255,0.04);">
                        <span style="color:var(--text-2);font-weight:500;margin-right:8px;">{{ $order->items->count() }} service{{ $order->items->count() > 1 ? 's' : '' }}</span>
                        {{ $order->items->map(fn($i) => $i->product->title)->join(' · ') }}
                    </div>

                    {{-- Actions --}}
                    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                        <a href="{{ route('orders.show', $order) }}" style="font-size:13px;color:var(--teal);text-decoration:none;display:inline-flex;align-items:center;gap:5px;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                            View details
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                        @if($order->status === 'pending')
                        <span style="color:var(--text-3);">·</span>
                        <form method="POST" action="{{ route('orders.cancel', $order) }}" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit" onclick="return confirm('Cancel this order?')" style="font-size:13px;color:var(--red);background:transparent;border:none;cursor:pointer;font-family:'DM Sans',sans-serif;padding:0;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Cancel order</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="display:flex;justify-content:center;margin-top:24px;">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection

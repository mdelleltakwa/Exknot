@extends('layouts.app')
@section('title', 'Your Cart')

@section('content')
<div style="max-width:1100px;margin:0 auto;padding:44px 32px 60px;">

    <div class="reveal" style="margin-bottom:32px;">
        <div class="label" style="margin-bottom:10px;">Checkout</div>
        <h1 style="font-size:32px;">Your cart</h1>
    </div>

    @if($products->isEmpty())
        <div class="reveal card-dark" style="text-align:center;padding:72px 32px;">
            <div style="width:64px;height:64px;border-radius:18px;background:rgba(0,200,150,0.06);border:1px solid rgba(0,200,150,0.12);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.83 1.61H19a2 2 0 001.83-1.61l1.5-8.39H5.17"/></svg>
            </div>
            <h3 style="font-size:18px;font-weight:400;margin-bottom:8px;">Your cart is empty</h3>
            <p style="color:var(--text-2);margin-bottom:28px;font-size:14px;">Browse our expert services and add them here.</p>
            <a href="{{ route('services.index') }}" class="btn-primary" style="font-size:14px;">Browse services</a>
        </div>
    @else
        <div style="display:grid;grid-template-columns:1fr 340px;gap:28px;align-items:start;">

            {{-- Items --}}
            <div>
                @foreach($products as $item)
                <div class="reveal card-dark" style="padding:20px 22px;margin-bottom:10px;display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
                    {{-- Icon --}}
                    <div style="width:44px;height:44px;border-radius:12px;background:rgba(0,200,150,0.07);border:1px solid rgba(0,200,150,0.13);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83"/></svg>
                    </div>

                    {{-- Info --}}
                    <div style="flex:1;min-width:160px;">
                        <div style="font-size:14px;font-weight:500;color:var(--text-1);margin-bottom:3px;">{{ $item['product']->title }}</div>
                        <div style="font-size:12px;color:var(--text-3);">{{ $item['product']->user->company_name ?? $item['product']->user->name }}</div>
                    </div>

                    {{-- Qty --}}
                    <form method="POST" action="{{ route('cart.update', $item['product']->id) }}" style="display:flex;align-items:center;gap:8px;">
                        @csrf @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99"
                            class="input-dark" style="width:68px;padding:8px 10px;text-align:center;">
                        <button type="submit" style="font-size:12px;color:var(--teal);background:transparent;border:none;cursor:pointer;font-family:'DM Sans',sans-serif;padding:0;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Update</button>
                    </form>

                    {{-- Price --}}
                    <div style="font-size:16px;font-weight:500;min-width:80px;text-align:right;" class="mono">
                        €{{ number_format($item['product']->price * $item['quantity'], 0) }}
                    </div>

                    {{-- Remove --}}
                    <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}">
                        @csrf @method('DELETE')
                        <button type="submit" style="display:flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:8px;color:var(--text-3);background:transparent;border:1px solid rgba(255,255,255,0.08);cursor:pointer;transition:all 150ms ease;flex-shrink:0;" onmouseover="this.style.color='var(--red)';this.style.borderColor='rgba(255,77,79,0.3)';this.style.background='rgba(255,77,79,0.06)'" onmouseout="this.style.color='var(--text-3)';this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='transparent'" title="Remove">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </form>
                </div>
                @endforeach

                <div class="reveal" style="margin-top:16px;">
                    <a href="{{ route('services.index') }}" style="font-size:13px;color:var(--text-2);text-decoration:none;display:inline-flex;align-items:center;gap:6px;" onmouseover="this.style.color='var(--teal)'" onmouseout="this.style.color='var(--text-2)'">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                        Continue browsing
                    </a>
                </div>
            </div>

            {{-- Summary card --}}
            <div style="position:sticky;top:84px;">
                <div class="reveal" style="background:rgba(255,255,255,0.03);backdrop-filter:blur(12px) saturate(180%);-webkit-backdrop-filter:blur(12px) saturate(180%);border:1px solid rgba(255,255,255,0.09);border-radius:18px;padding:28px;box-shadow:0 24px 60px rgba(0,0,0,0.4),0 1px 0 rgba(255,255,255,0.05) inset;">

                    <h3 style="font-size:13px;font-weight:500;color:var(--text-2);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:16px;">Order summary</h3>

                    {{-- Line items --}}
                    @foreach($products as $item)
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <span style="font-size:13px;color:var(--text-2);flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding-right:12px;">{{ Str::limit($item['product']->title, 28) }}</span>
                        <span style="font-size:13px;color:var(--text-1);font-family:'JetBrains Mono',monospace;flex-shrink:0;">€{{ number_format($item['product']->price * $item['quantity'], 0) }}</span>
                    </div>
                    @endforeach

                    <div style="border-top:1px solid rgba(255,255,255,0.08);margin:18px 0;"></div>

                    <div style="display:flex;justify-content:space-between;align-items:baseline;margin-bottom:24px;">
                        <span style="font-size:13px;color:var(--text-2);">Total</span>
                        <span style="font-size:28px;font-weight:300;color:var(--text-1);" class="mono">€{{ number_format($total, 0) }}</span>
                    </div>

                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <div style="margin-bottom:14px;">
                            <textarea name="notes" rows="2" class="input-dark" placeholder="Notes for the firm (optional)..." style="font-size:13px;"></textarea>
                        </div>
                        <button type="submit" class="btn-primary pulse" style="width:100%;font-size:14px;padding:14px;justify-content:center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="margin-right:8px;"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                            Place order
                        </button>
                    </form>

                    <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-top:14px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--text-3)" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <span style="font-size:11px;color:var(--text-3);">Secure checkout via escrow</span>
                    </div>
                </div>
            </div>

        </div>
    @endif
</div>
@endsection

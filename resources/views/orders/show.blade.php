@extends('layouts.app')
@section('title', 'Order #EXK-' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div style="max-width:1000px;margin:0 auto;padding:44px 32px 60px;">

    {{-- Breadcrumb --}}
    <div class="reveal" style="display:flex;align-items:center;gap:8px;margin-bottom:28px;font-size:13px;color:var(--text-3);">
        <a href="{{ route('orders.index') }}" style="color:var(--text-3);text-decoration:none;transition:color 150ms ease;" onmouseover="this.style.color='var(--teal)'" onmouseout="this.style.color='var(--text-3)'">Orders</a>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        <span class="mono" style="color:var(--text-2);font-size:12px;">#EXK-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
    </div>

    {{-- Header --}}
    <div class="reveal" style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:36px;gap:16px;flex-wrap:wrap;">
        <div>
            <div class="label" style="margin-bottom:8px;">Order confirmed</div>
            <h1 class="mono" style="font-size:30px;font-weight:400;letter-spacing:-0.02em;margin-bottom:8px;">
                #EXK-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
            </h1>
            <p style="font-size:13px;color:var(--text-3);">Placed {{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
        </div>
        <div style="padding-top:4px;">
            @if($order->status === 'validated')
                <span class="badge badge-teal" style="font-size:13px;padding:7px 16px;">Validated</span>
            @elseif($order->status === 'pending')
                <span class="badge badge-amber" style="font-size:13px;padding:7px 16px;">Pending</span>
            @else
                <span class="badge badge-red" style="font-size:13px;padding:7px 16px;">Cancelled</span>
            @endif
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 300px;gap:28px;align-items:start;">

        {{-- LEFT --}}
        <div>
            {{-- Services ordered --}}
            <div class="reveal card-dark" style="margin-bottom:16px;overflow:hidden;">
                <div style="padding:20px 24px 14px;">
                    <h2 style="font-size:14px;font-weight:500;letter-spacing:-0.01em;">Services ordered</h2>
                </div>
                @foreach($order->items as $item)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 24px;border-top:1px solid rgba(255,255,255,0.04);gap:12px;">
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:14px;font-weight:500;color:var(--text-1);margin-bottom:4px;">{{ $item->product->title }}</div>
                        <div style="font-size:12px;color:var(--text-3);">
                            by {{ $item->product->user->company_name ?? $item->product->user->name }}
                            <span style="margin-left:8px;">· Qty: {{ $item->quantity }}</span>
                        </div>
                    </div>
                    <div style="font-size:15px;font-weight:500;flex-shrink:0;" class="mono">€{{ number_format($item->price * $item->quantity, 0) }}</div>
                </div>
                @endforeach
            </div>

            {{-- Notes --}}
            @if($order->notes)
            <div class="reveal card-dark" style="padding:20px 24px;margin-bottom:16px;">
                <div style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);margin-bottom:10px;">Notes</div>
                <p style="font-size:14px;color:var(--text-2);line-height:1.65;">{{ $order->notes }}</p>
            </div>
            @endif

            {{-- Timeline --}}
            <div class="reveal card-dark" style="padding:20px 24px;margin-bottom:24px;">
                <div style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);margin-bottom:16px;">Status timeline</div>
                <div style="display:flex;flex-direction:column;gap:0;">
                    @foreach([
                        ['Order placed','Your order has been submitted successfully.', 'completed'],
                        ['Firm review','The expert firm is reviewing your request.', $order->status !== 'pending' ? 'completed' : 'active'],
                        ['Confirmed','Order validated and engagement begins.', $order->status === 'validated' ? 'completed' : ($order->status === 'cancelled' ? 'cancelled' : 'pending')],
                    ] as [$step,$desc,$state])
                    <div style="display:flex;gap:14px;padding-bottom:{{ !$loop->last ? '16px' : '0' }};">
                        <div style="display:flex;flex-direction:column;align-items:center;">
                            <div style="width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;
                                {{ $state === 'completed' ? 'background:rgba(0,200,150,0.15);border:1px solid rgba(0,200,150,0.4)' : ($state === 'active' ? 'background:rgba(245,166,35,0.12);border:1px solid rgba(245,166,35,0.4)' : ($state === 'cancelled' ? 'background:rgba(255,77,79,0.12);border:1px solid rgba(255,77,79,0.4)' : 'background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1)')) }}">
                                @if($state === 'completed')
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                                @elseif($state === 'active')
                                    <div style="width:8px;height:8px;border-radius:50%;background:var(--amber);animation:pulse-dot 2s ease-in-out infinite;"></div>
                                @elseif($state === 'cancelled')
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#FF4D4F" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                @else
                                    <div style="width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,0.2);"></div>
                                @endif
                            </div>
                            @if(!$loop->last)
                            <div style="width:1px;flex:1;margin:4px 0;background:rgba(255,255,255,0.07);min-height:16px;"></div>
                            @endif
                        </div>
                        <div style="padding-bottom:4px;padding-top:2px;">
                            <div style="font-size:13px;font-weight:500;color:{{ $state === 'completed' ? 'var(--teal)' : ($state === 'active' ? 'var(--amber)' : ($state === 'cancelled' ? 'var(--red)' : 'var(--text-3)')) }};margin-bottom:2px;">{{ $step }}</div>
                            <div style="font-size:12px;color:var(--text-3);">{{ $desc }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="reveal" style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ route('orders.index') }}" class="btn-ghost" style="font-size:13px;padding:10px 20px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="margin-right:6px;"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                    All orders
                </a>
                @if($order->status === 'pending')
                <form method="POST" action="{{ route('orders.cancel', $order) }}">
                    @csrf @method('PATCH')
                    <button type="submit" onclick="return confirm('Cancel this order?')" class="btn-danger" style="font-size:13px;padding:10px 20px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="margin-right:6px;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        Cancel order
                    </button>
                </form>
                @endif
            </div>
        </div>

        {{-- RIGHT: Summary --}}
        <div style="position:sticky;top:84px;">
            <div class="reveal" style="background:rgba(255,255,255,0.03);backdrop-filter:blur(12px) saturate(180%);-webkit-backdrop-filter:blur(12px) saturate(180%);border:1px solid rgba(255,255,255,0.09);border-radius:18px;padding:26px;box-shadow:0 24px 60px rgba(0,0,0,0.4),0 1px 0 rgba(255,255,255,0.05) inset;">

                <div style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);margin-bottom:12px;">Order total</div>
                <div style="font-size:34px;font-weight:300;margin-bottom:20px;" class="mono">€{{ number_format($order->total, 0) }}</div>

                <div style="border-top:1px solid rgba(255,255,255,0.08);padding-top:18px;">
                    <div style="font-size:12px;font-weight:500;color:var(--text-2);margin-bottom:10px;">What happens next?</div>
                    <div style="font-size:13px;color:var(--text-2);line-height:1.7;">
                        The expert firm will review your order and confirm within 48 hours. You'll receive a notification once validated.
                    </div>
                </div>

                <div style="border-top:1px solid rgba(255,255,255,0.08);margin-top:18px;padding-top:16px;">
                    <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:var(--text-3);">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        Funds held in escrow until delivery
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

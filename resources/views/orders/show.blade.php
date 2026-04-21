@extends('layouts.app')
@section('title', 'Order #EXK-' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div class="px-8 py-12 max-w-4xl mx-auto">

    <div class="flex items-center justify-between mb-8">
        <div>
            <div style="font-size:11px;color:#1D9E75;font-weight:500;letter-spacing:.1em;text-transform:uppercase;margin-bottom:6px;">Order confirmed</div>
            <h1 style="font-size:28px;font-weight:300;letter-spacing:-0.02em;">
                #EXK-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
            </h1>
            <div style="font-size:13px;color:#8B95A3;margin-top:4px;">Placed {{ $order->created_at->format('M d, Y \a\t H:i') }}</div>
        </div>
        <div>
            @if($order->status === 'validated')
                <span class="badge-teal" style="font-size:13px;padding:6px 14px;">Validated</span>
            @elseif($order->status === 'pending')
                <span class="badge-amber" style="font-size:13px;padding:6px 14px;">Pending</span>
            @else
                <span class="badge-red" style="font-size:13px;padding:6px 14px;">Cancelled</span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-3 gap-8">
        <div class="col-span-2">
            <div class="card-dark p-6 mb-6">
                <h2 style="font-size:15px;font-weight:500;margin-bottom:16px;">Services ordered</h2>
                @foreach($order->items as $item)
                <div class="flex items-center justify-between py-3" style="border-bottom:1px solid rgba(255,255,255,.05);">
                    <div style="flex:1;">
                        <div style="font-size:14px;font-weight:500;color:#E8EDF2;">{{ $item->product->title }}</div>
                        <div style="font-size:12px;color:#8B95A3;margin-top:2px;">
                            by {{ $item->product->user->company_name ?? $item->product->user->name }}
                            · Qty: {{ $item->quantity }}
                        </div>
                    </div>
                    <div style="font-size:14px;font-weight:500;">€{{ number_format($item->price * $item->quantity, 0) }}</div>
                </div>
                @endforeach
            </div>

            @if($order->notes)
            <div class="card-dark p-5 mb-6">
                <div style="font-size:12px;color:#8B95A3;margin-bottom:6px;">Notes</div>
                <p style="font-size:14px;color:#E8EDF2;">{{ $order->notes }}</p>
            </div>
            @endif

            <div class="flex gap-3">
                <a href="{{ route('orders.index') }}" class="btn-ghost" style="font-size:13px;padding:9px 18px;">← All orders</a>
                @if($order->status === 'pending')
                <form method="POST" action="{{ route('orders.cancel', $order) }}">
                    @csrf @method('PATCH')
                    <button type="submit" onclick="return confirm('Cancel this order?')"
                        style="font-size:13px;padding:9px 18px;border-radius:8px;border:1px solid rgba(226,75,74,.3);color:#F09595;background:transparent;cursor:pointer;">
                        Cancel order
                    </button>
                </form>
                @endif
            </div>
        </div>

        <div>
            <div class="card-dark p-6">
                <div style="font-size:13px;color:#8B95A3;margin-bottom:4px;">Order total</div>
                <div style="font-size:28px;font-weight:300;color:#E8EDF2;margin-bottom:20px;">€{{ number_format($order->total, 0) }}</div>

                <div style="border-top:1px solid rgba(255,255,255,.06);padding-top:16px;">
                    <div style="font-size:12px;color:#8B95A3;margin-bottom:12px;">What happens next?</div>
                    <div style="font-size:13px;color:#C8D0DB;line-height:1.7;">
                        The expert firm will review your order and confirm within 48 hours. You'll receive a notification once validated.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

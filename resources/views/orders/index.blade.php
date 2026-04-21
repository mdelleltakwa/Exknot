@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
<div class="px-8 py-12 max-w-4xl mx-auto">
    <h1 style="font-size:28px;font-weight:300;letter-spacing:-0.02em;margin-bottom:24px;">Order history</h1>

    @if($orders->isEmpty())
        <div class="text-center py-20 card-dark">
            <p style="color:#8B95A3;margin-bottom:16px;">No orders yet.</p>
            <a href="{{ route('services.index') }}" class="btn-primary">Browse services</a>
        </div>
    @else
        @foreach($orders as $order)
        <div class="card-dark p-5 mb-3">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <span style="font-family:monospace;font-size:13px;color:#1D9E75;">#EXK-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span style="font-size:12px;color:#8B95A3;margin-left:12px;">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <span style="font-size:16px;font-weight:500;">€{{ number_format($order->total, 0) }}</span>
                    @if($order->status === 'validated')
                        <span class="badge-teal">Validated</span>
                    @elseif($order->status === 'pending')
                        <span class="badge-amber">Pending</span>
                    @else
                        <span class="badge-red">Cancelled</span>
                    @endif
                </div>
            </div>

            <div style="font-size:13px;color:#8B95A3;margin-bottom:12px;">
                {{ $order->items->count() }} service(s) —
                {{ $order->items->map(fn($i) => $i->product->title)->join(', ') }}
            </div>

            <div class="flex gap-3">
                <a href="{{ route('orders.show', $order) }}" style="font-size:13px;color:#1D9E75;">View details</a>
                @if($order->status === 'pending')
                <form method="POST" action="{{ route('orders.cancel', $order) }}">
                    @csrf @method('PATCH')
                    <button type="submit" style="font-size:13px;color:#F09595;">Cancel</button>
                </form>
                @endif
            </div>
        </div>
        @endforeach

        {{ $orders->links() }}
    @endif
</div>
@endsection

@extends('layouts.app')
@section('title', 'Your Cart')

@section('content')
<div class="px-8 py-12 max-w-4xl mx-auto">
    <h1 style="font-size:28px;font-weight:300;letter-spacing:-0.02em;margin-bottom:24px;">Your cart</h1>

    @if($products->isEmpty())
        <div class="text-center py-20 card-dark">
            <p style="color:#8B95A3;margin-bottom:16px;">Your cart is empty.</p>
            <a href="{{ route('services.index') }}" class="btn-primary">Browse services</a>
        </div>
    @else
        <div class="grid grid-cols-3 gap-8">
            <div class="col-span-2">
                @foreach($products as $item)
                <div class="card-dark p-5 mb-3 flex items-center gap-4">
                    <div style="flex:1;">
                        <div style="font-size:14px;font-weight:500;color:#E8EDF2;margin-bottom:3px;">{{ $item['product']->title }}</div>
                        <div style="font-size:12px;color:#8B95A3;">{{ $item['product']->user->company_name ?? $item['product']->user->name }}</div>
                    </div>

                    <form method="POST" action="{{ route('cart.update', $item['product']->id) }}" class="flex items-center gap-2">
                        @csrf @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99"
                            class="input-dark text-center" style="width:60px;padding:6px;">
                        <button type="submit" style="font-size:12px;color:#1D9E75;">Update</button>
                    </form>

                    <div style="font-size:15px;font-weight:500;min-width:80px;text-align:right;">
                        €{{ number_format($item['product']->price * $item['quantity'], 0) }}
                    </div>

                    <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}">
                        @csrf @method('DELETE')
                        <button type="submit" style="color:#F09595;font-size:12px;">Remove</button>
                    </form>
                </div>
                @endforeach
            </div>

            <div>
                <div class="card-dark p-6">
                    <div style="font-size:14px;color:#8B95A3;margin-bottom:4px;">Order total</div>
                    <div style="font-size:28px;font-weight:300;color:#E8EDF2;margin-bottom:20px;">€{{ number_format($total, 0) }}</div>

                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <div class="mb-4">
                            <textarea name="notes" rows="2" class="input-dark" placeholder="Notes (optional)..."></textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full text-center" style="width:100%;text-align:center;">
                            Place order
                        </button>
                    </form>

                    <a href="{{ route('services.index') }}" style="display:block;text-align:center;font-size:13px;color:#8B95A3;margin-top:12px;">
                        Continue browsing
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

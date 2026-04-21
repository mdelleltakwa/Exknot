@extends('layouts.app')
@section('title', $product->title)

@section('content')
<div class="px-8 py-12 max-w-5xl mx-auto">

    <div class="grid grid-cols-3 gap-8">

        {{-- LEFT: Main info --}}
        <div class="col-span-2">
            <span class="badge-teal" style="margin-bottom:16px;display:inline-block;">{{ $product->category->name }}</span>
            <h1 style="font-size:30px;font-weight:300;letter-spacing:-0.02em;margin-bottom:12px;">{{ $product->title }}</h1>

            <div class="flex items-center gap-4 mb-8" style="color:#8B95A3;font-size:13px;">
                <span>By <strong style="color:#E8EDF2;">{{ $product->user->company_name ?? $product->user->name }}</strong></span>
                <span>·</span>
                <span>{{ $product->user->country }}</span>
                @if($product->reviews->count() > 0)
                <span>·</span>
                <span style="color:#EF9F27;">★ {{ $product->averageRating() }}</span>
                <span>({{ $product->reviews->count() }} reviews)</span>
                @endif
            </div>

            @if($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}"
                    style="width:100%;height:280px;object-fit:cover;border-radius:12px;margin-bottom:24px;">
            @endif

            <div class="card-dark p-6 mb-8">
                <h2 style="font-size:16px;font-weight:500;margin-bottom:12px;">About this service</h2>
                <p style="color:#8B95A3;line-height:1.7;">{{ $product->description }}</p>
            </div>

            {{-- REVIEWS --}}
            <div class="mb-8">
                <h2 style="font-size:18px;font-weight:300;margin-bottom:16px;">Reviews ({{ $product->reviews->count() }})</h2>

                @foreach($product->reviews as $review)
                <div class="card-dark p-5 mb-3">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-3">
                            <div style="width:32px;height:32px;border-radius:50%;background:rgba(29,158,117,.12);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:500;color:#1D9E75;">
                                {{ strtoupper(substr($review->user->name, 0, 2)) }}
                            </div>
                            <span style="font-size:13px;font-weight:500;">{{ $review->user->name }}</span>
                        </div>
                        <div style="color:#EF9F27;font-size:13px;">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div>
                    </div>
                    @if($review->comment)
                        <p style="font-size:13px;color:#8B95A3;line-height:1.6;">{{ $review->comment }}</p>
                    @endif
                    @if(auth()->check() && (auth()->id() === $review->user_id || auth()->user()->isAdmin()))
                    <form method="POST" action="{{ route('reviews.destroy', $review) }}" class="mt-2">
                        @csrf @method('DELETE')
                        <button type="submit" style="font-size:11px;color:#F09595;">Delete</button>
                    </form>
                    @endif
                </div>
                @endforeach

                {{-- Write a review --}}
                @auth
                    @if(!auth()->user()->isFirm())
                    <div class="card-dark p-6 mt-4">
                        <h3 style="font-size:15px;font-weight:500;margin-bottom:16px;">Write a review</h3>
                        <form method="POST" action="{{ route('reviews.store', $product) }}">
                            @csrf
                            <div class="mb-4">
                                <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Rating</label>
                                <select name="rating" class="input-dark" style="max-width:150px;" required>
                                    @foreach([5,4,3,2,1] as $r)
                                        <option value="{{ $r }}">{{ $r }} star{{ $r > 1 ? 's' : '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Comment (optional)</label>
                                <textarea name="comment" rows="3" class="input-dark" placeholder="Share your experience..."></textarea>
                            </div>
                            <button type="submit" class="btn-primary" style="font-size:13px;padding:9px 20px;">Submit review</button>
                        </form>
                    </div>
                    @endif
                @endauth
            </div>
        </div>

        {{-- RIGHT: Purchase card --}}
        <div>
            <div class="card-dark p-6 sticky top-24">
                <div style="font-size:30px;font-weight:300;color:#E8EDF2;margin-bottom:4px;">€{{ number_format($product->price, 0) }}</div>
                <div style="font-size:12px;color:#8B95A3;margin-bottom:20px;">per engagement</div>

                @auth
                    @if(!auth()->user()->isFirm())
                    <form method="POST" action="{{ route('cart.add', $product) }}">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-primary w-full text-center mb-3" style="width:100%;text-align:center;">Add to cart</button>
                    </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-primary w-full text-center block mb-3" style="text-align:center;">Sign in to hire</a>
                @endauth

                <div style="border-top:1px solid rgba(255,255,255,.06);margin:16px 0;"></div>

                <div style="font-size:13px;color:#8B95A3;">
                    <div class="flex items-center gap-2 mb-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1D9E75" stroke-width="2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Verified firm
                    </div>
                    <div class="flex items-center gap-2 mb-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1D9E75" stroke-width="2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Secure escrow payment
                    </div>
                    <div class="flex items-center gap-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1D9E75" stroke-width="2" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Response within 48h
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

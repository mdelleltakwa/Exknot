@extends('layouts.app')
@section('title', $product->title)

@section('content')
<div style="max-width:1100px;margin:0 auto;padding:52px 32px 80px;">

    {{-- Breadcrumb --}}
    <nav class="reveal" style="display:flex;align-items:center;gap:8px;margin-bottom:32px;font-size:13px;color:var(--text-3);" aria-label="Breadcrumb">
        <a href="{{ route('services.index') }}" style="color:var(--text-3);text-decoration:none;transition:color 0.2s ease;" onmouseover="this.style.color='var(--teal)'" onmouseout="this.style.color='var(--text-3)'">Services</a>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        <span style="color:var(--text-2);">{{ Str::limit($product->title, 40) }}</span>
    </nav>

    <div style="display:grid;grid-template-columns:1fr 360px;gap:36px;align-items:start;">

        {{-- ═══ LEFT: Main content ═══ --}}
        <div>
            <div class="reveal">
                <span class="badge badge-teal" style="margin-bottom:18px;display:inline-flex;">{{ $product->category->name }}</span>
                <h1 style="font-size:clamp(26px,4vw,36px);margin-bottom:16px;">{{ $product->title }}</h1>
                <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:32px;font-size:13px;color:var(--text-2);">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,rgba(0,229,160,0.25),rgba(0,229,160,0.08));display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:700;color:var(--teal);font-family:'JetBrains Mono',monospace;">
                            {{ strtoupper(substr($product->user->name, 0, 2)) }}
                        </div>
                        <span>By <strong style="color:var(--text-1);font-weight:500;">{{ $product->user->company_name ?? $product->user->name }}</strong></span>
                    </div>
                    @if($product->user->country)
                    <span style="color:var(--text-3);">·</span>
                    <span>{{ $product->user->country }}</span>
                    @endif
                    @if($product->reviews->count() > 0)
                    <span style="color:var(--text-3);">·</span>
                    <span style="color:var(--amber);">★ {{ $product->averageRating() }}</span>
                    <span>({{ $product->reviews->count() }} reviews)</span>
                    @endif
                </div>
            </div>

            @if($product->image)
            <div class="reveal" style="border-radius:var(--radius-lg);overflow:hidden;margin-bottom:32px;border:1px solid var(--border);">
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" loading="lazy" style="width:100%;max-height:360px;object-fit:cover;display:block;">
            </div>
            @endif

            {{-- Description --}}
            <div class="reveal glass" style="padding:32px;margin-bottom:32px;">
                <h2 style="font-size:16px;font-weight:500;margin-bottom:16px;">About this service</h2>
                <p style="color:var(--text-2);line-height:1.8;font-size:14px;">{{ $product->description }}</p>
            </div>

            {{-- Reviews --}}
            <div class="reveal">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
                    <h2 style="font-size:22px;">Reviews <span style="color:var(--text-3);font-size:15px;font-weight:300;">({{ $product->reviews->count() }})</span></h2>
                    @if($product->reviews->count() > 0)
                    <div style="display:flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(245,166,35,0.08);border:1px solid rgba(245,166,35,0.2);border-radius:var(--radius-md);">
                        <span style="color:var(--amber);font-size:16px;">★</span>
                        <span style="font-size:15px;font-weight:600;color:var(--text-1);">{{ $product->averageRating() }}</span>
                        <span style="font-size:12px;color:var(--text-2);">/ 5</span>
                    </div>
                    @endif
                </div>

                @forelse($product->reviews as $review)
                <div class="card-dark" style="padding:24px;margin-bottom:12px;">
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;gap:12px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,rgba(0,229,160,0.2),rgba(0,229,160,0.06));display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:var(--teal);font-family:'JetBrains Mono',monospace;flex-shrink:0;">
                                {{ strtoupper(substr($review->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div style="font-size:13px;font-weight:500;color:var(--text-1);">{{ $review->user->name }}</div>
                                <div style="font-size:11px;color:var(--text-3);margin-top:2px;">{{ $review->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:2px;flex-shrink:0;">
                            @for($s=1;$s<=5;$s++)
                                <span style="font-size:14px;color:{{ $s <= $review->rating ? 'var(--amber)' : 'var(--text-3)' }};">★</span>
                            @endfor
                        </div>
                    </div>
                    @if($review->comment)
                        <p style="font-size:13px;color:var(--text-2);line-height:1.7;">{{ $review->comment }}</p>
                    @endif
                    @if(auth()->check() && (auth()->id() === $review->user_id || auth()->user()->isAdmin()))
                    <form method="POST" action="{{ route('reviews.destroy', $review) }}" style="margin-top:12px;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-text" style="font-size:11px;color:var(--red);">Delete review</button>
                    </form>
                    @endif
                </div>
                @empty
                <div style="text-align:center;padding:48px 20px;color:var(--text-3);">
                    <p style="font-size:14px;">No reviews yet. Be the first to review this service.</p>
                </div>
                @endforelse

                {{-- Write a review --}}
                @auth
                    @if(!auth()->user()->isFirm())
                    <div class="glass" style="padding:28px;margin-top:20px;border-color:rgba(0,229,160,0.12);">
                        <h3 style="font-size:15px;font-weight:500;margin-bottom:20px;color:var(--text-1);">Write a review</h3>
                        <form method="POST" action="{{ route('reviews.store', $product) }}">
                            @csrf
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                                <div>
                                    <label style="display:block;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);margin-bottom:8px;">Rating</label>
                                    <select name="rating" class="input-dark" required>
                                        @foreach([5,4,3,2,1] as $r)
                                            <option value="{{ $r }}">{{ $r }} star{{ $r > 1 ? 's' : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div style="margin-bottom:18px;">
                                <label style="display:block;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-3);margin-bottom:8px;">Comment (optional)</label>
                                <textarea name="comment" rows="3" class="input-dark" placeholder="Share your experience..."></textarea>
                            </div>
                            <button type="submit" class="btn-primary" style="font-size:13px;padding:12px 24px;">Submit review</button>
                        </form>
                    </div>
                    @endif
                @endauth
            </div>
        </div>

        {{-- ═══ RIGHT: Purchase card ═══ --}}
        <div style="position:sticky;top:84px;">
            <div class="reveal glass" style="padding:32px;box-shadow:var(--shadow-lg),inset 0 1px 0 rgba(255,255,255,0.06);">
                <div style="margin-bottom:24px;">
                    <div style="font-family:'Outfit',sans-serif;font-size:40px;font-weight:300;color:var(--text-1);letter-spacing:-0.03em;">€{{ number_format($product->price, 0) }}</div>
                    <div style="font-size:12px;color:var(--text-3);margin-top:4px;">per engagement · excl. taxes</div>
                </div>

                @auth
                    @if(!auth()->user()->isFirm())
                    <form method="POST" action="{{ route('cart.add', $product) }}">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-primary magnetic" style="width:100%;text-align:center;font-size:14px;padding:16px;margin-bottom:12px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.83 1.61H19a2 2 0 001.83-1.61l1.5-8.39H5.17"/></svg>
                            Add to cart
                        </button>
                    </form>
                    @else
                    <div style="text-align:center;padding:14px;font-size:13px;color:var(--text-3);">Firms cannot purchase services.</div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-primary magnetic" style="width:100%;text-align:center;font-size:14px;padding:16px;display:flex;justify-content:center;margin-bottom:12px;">Sign in to hire</a>
                @endauth

                <div style="border-top:1px solid var(--border);margin:20px 0;"></div>

                {{-- Trust signals --}}
                <div style="display:flex;flex-direction:column;gap:12px;">
                    @foreach(['Verified firm','Secure escrow payment','Response within 48h'] as $trust)
                    <div style="display:flex;align-items:center;gap:10px;font-size:13px;color:var(--text-2);">
                        <div style="width:20px;height:20px;border-radius:50%;background:rgba(0,229,160,0.1);border:1px solid rgba(0,229,160,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#00E5A0" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        {{ $trust }}
                    </div>
                    @endforeach
                </div>

                <div style="border-top:1px solid var(--border);margin-top:20px;padding-top:18px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,rgba(0,229,160,0.15),rgba(0,229,160,0.05));display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:var(--teal);font-family:'JetBrains Mono',monospace;flex-shrink:0;">
                                {{ strtoupper(substr($product->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div style="font-size:13px;font-weight:500;color:var(--text-1);">{{ $product->user->company_name ?? $product->user->name }}</div>
                                <div style="font-size:11px;color:var(--text-3);">{{ $product->user->country ?? 'Expert Firm' }}</div>
                            </div>
                        </div>
                        @auth
                            @if(auth()->id() !== $product->user_id)
                                <a href="{{ route('chat.start', $product->user) }}" class="btn-ghost" style="padding:8px 14px;font-size:11px;">Message</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

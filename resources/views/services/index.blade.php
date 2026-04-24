@extends('layouts.app')
@section('title', 'Browse Services')

@section('content')
<div style="max-width:1300px;margin:0 auto;padding:52px 32px 80px;">

    {{-- Page header --}}
    <div style="margin-bottom:44px;">
        <div class="label reveal" style="margin-bottom:12px;">Marketplace</div>
        <h1 class="reveal reveal-delay-1" style="font-size:clamp(32px,5vw,44px);margin-bottom:10px;">Expert <span class="gradient-text">services</span></h1>
        <p class="reveal reveal-delay-2" style="color:var(--text-2);font-size:15px;max-width:460px;line-height:1.7;">Browse verified B2B consulting, audit and inspection firms worldwide.</p>
    </div>

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('services.index') }}" class="reveal reveal-delay-3 glass" style="display:flex;gap:12px;margin-bottom:44px;flex-wrap:wrap;align-items:center;padding:20px 24px;">
        <div style="position:relative;flex:1;min-width:220px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--text-3)" stroke-width="1.5" stroke-linecap="round" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);pointer-events:none;">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search services, firms, categories..." class="input-dark" style="padding-left:44px;">
        </div>
        <select name="category" class="input-dark" style="max-width:200px;flex-shrink:0;">
            <option value="">All categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
        <select name="sort" class="input-dark" style="max-width:170px;flex-shrink:0;">
            <option value="newest" @selected(request('sort') == 'newest')>Newest first</option>
            <option value="price_asc" @selected(request('sort') == 'price_asc')>Price: low → high</option>
            <option value="price_desc" @selected(request('sort') == 'price_desc')>Price: high → low</option>
        </select>
        <button type="submit" class="btn-primary" style="padding:14px 24px;flex-shrink:0;">Search</button>
        <a href="{{ route('services.index') }}" class="btn-ghost" style="padding:14px 20px;flex-shrink:0;">Reset</a>
    </form>

    {{-- Grid --}}
    @if($products->isEmpty())
        <div class="reveal" style="text-align:center;padding:100px 32px;">
            <div style="width:72px;height:72px;border-radius:var(--radius-lg);background:rgba(0,229,160,0.06);border:1px solid rgba(0,229,160,0.12);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </div>
            <h3 style="font-size:20px;font-weight:400;margin-bottom:10px;">No services found</h3>
            <p style="color:var(--text-2);margin-bottom:28px;">Try adjusting your search or filters.</p>
            <a href="{{ route('services.index') }}" class="btn-ghost" style="font-size:13px;">Clear filters</a>
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;margin-bottom:44px;">
            @foreach($products as $i => $product)
            <a href="{{ route('services.show', $product) }}" class="reveal reveal-delay-{{ ($i % 4) + 1 }} card-dark" style="display:block;text-decoration:none;padding:0;overflow:hidden;border-radius:var(--radius-lg);">
                {{-- Thumbnail --}}
                @if($product->image)
                    <div style="height:170px;overflow:hidden;background:var(--bg-elevated);position:relative;">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" loading="lazy"
                            style="width:100%;height:100%;object-fit:cover;transition:transform 0.6s var(--ease-out);"
                            onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                @else
                    <div style="height:140px;background:linear-gradient(135deg,rgba(0,229,160,0.06),rgba(212,168,83,0.03));display:flex;align-items:center;justify-content:center;border-bottom:1px solid var(--border);">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(0,229,160,0.25)" stroke-width="1" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
                    </div>
                @endif
                <div style="padding:22px 24px;">
                    <span class="badge badge-teal" style="margin-bottom:14px;display:inline-flex;">{{ $product->category->name }}</span>
                    <h3 style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:500;color:var(--text-1);margin-bottom:8px;line-height:1.45;">{{ $product->title }}</h3>
                    <p style="font-size:13px;color:var(--text-2);line-height:1.6;margin-bottom:20px;">{{ Str::limit($product->description, 90) }}</p>
                    <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid var(--border);padding-top:16px;">
                        <div>
                            <div style="font-family:'Outfit',sans-serif;font-size:22px;font-weight:300;color:var(--text-1);">€{{ number_format($product->price, 0) }}</div>
                            <div style="font-size:11px;color:var(--text-3);margin-top:2px;">{{ $product->user->company_name ?? $product->user->name }}</div>
                        </div>
                        @if($product->reviews->count() > 0)
                        <div style="text-align:right;">
                            <div style="color:var(--amber);font-size:13px;font-weight:600;">★ {{ $product->averageRating() }}</div>
                            <div style="font-size:11px;color:var(--text-3);margin-top:2px;">{{ $product->reviews->count() }} reviews</div>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div style="display:flex;justify-content:center;">{{ $products->links() }}</div>
    @endif
</div>
@endsection

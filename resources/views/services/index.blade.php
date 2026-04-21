@extends('layouts.app')
@section('title', 'Browse Services')

@section('content')
<div style="max-width:1300px;margin:0 auto;padding:44px 32px 60px;">

    {{-- Page header --}}
    <div class="reveal" style="margin-bottom:36px;">
        <div class="label" style="margin-bottom:10px;">Marketplace</div>
        <h1 style="font-size:36px;margin-bottom:8px;">Expert services</h1>
        <p style="color:var(--text-2);font-size:15px;">Browse verified B2B consulting, audit and inspection firms worldwide.</p>
    </div>

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('services.index') }}" class="reveal" style="display:flex;gap:10px;margin-bottom:36px;flex-wrap:wrap;align-items:center;padding:18px 22px;background:rgba(255,255,255,0.025);border:1px solid var(--border);border-radius:14px;backdrop-filter:blur(8px);">
        <div style="position:relative;flex:1;min-width:220px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--text-3)" stroke-width="1.5" stroke-linecap="round" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);pointer-events:none;">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search services, firms, categories..."
                class="input-dark" style="padding-left:40px;">
        </div>

        <select name="category" class="input-dark" style="max-width:200px;flex-shrink:0;">
            <option value="">All categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>

        <select name="sort" class="input-dark" style="max-width:170px;flex-shrink:0;">
            <option value="newest"     @selected(request('sort') == 'newest')>Newest first</option>
            <option value="price_asc"  @selected(request('sort') == 'price_asc')>Price: low → high</option>
            <option value="price_desc" @selected(request('sort') == 'price_desc')>Price: high → low</option>
        </select>

        <button type="submit" class="btn-primary" style="padding:12px 22px;flex-shrink:0;">Search</button>
        <a href="{{ route('services.index') }}" class="btn-ghost" style="padding:12px 18px;flex-shrink:0;">Reset</a>
    </form>

    {{-- Grid --}}
    @if($products->isEmpty())
        <div class="reveal" style="text-align:center;padding:80px 32px;">
            <div style="width:64px;height:64px;border-radius:16px;background:rgba(0,200,150,0.06);border:1px solid rgba(0,200,150,0.12);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="1.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </div>
            <h3 style="font-size:18px;font-weight:400;margin-bottom:8px;">No services found</h3>
            <p style="color:var(--text-2);margin-bottom:24px;">Try adjusting your search or filters.</p>
            <a href="{{ route('services.index') }}" class="btn-ghost" style="font-size:13px;">Clear filters</a>
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:18px;margin-bottom:36px;">
            @foreach($products as $product)
            <a href="{{ route('services.show', $product) }}" class="reveal card-dark" style="display:block;text-decoration:none;padding:0;overflow:hidden;border-radius:16px;transition:border-color 200ms ease,transform 200ms ease,box-shadow 200ms ease;" onmouseover="this.style.borderColor='rgba(0,200,150,0.25)';this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 40px rgba(0,0,0,0.4)'" onmouseout="this.style.borderColor='var(--border)';this.style.transform='translateY(0)';this.style.boxShadow='none'">

                {{-- Thumbnail --}}
                @if($product->image)
                    <div style="height:160px;overflow:hidden;background:var(--bg-elevated);">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}"
                            style="width:100%;height:100%;object-fit:cover;transition:transform 400ms ease;" onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                @else
                    <div style="height:130px;background:linear-gradient(135deg,rgba(0,200,150,0.06),rgba(0,200,150,0.02));display:flex;align-items:center;justify-content:center;border-bottom:1px solid var(--border);">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(0,200,150,0.3)" stroke-width="1" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
                    </div>
                @endif

                <div style="padding:20px 22px 22px;">
                    <span class="badge badge-teal" style="margin-bottom:12px;display:inline-flex;">{{ $product->category->name }}</span>

                    <h3 style="font-size:15px;font-weight:500;color:var(--text-1);margin-bottom:7px;line-height:1.45;letter-spacing:-0.01em;">{{ $product->title }}</h3>
                    <p style="font-size:13px;color:var(--text-2);line-height:1.55;margin-bottom:18px;">{{ Str::limit($product->description, 90) }}</p>

                    <div style="display:flex;align-items:center;justify-content:space-between;border-top:1px solid rgba(255,255,255,0.05);padding-top:14px;">
                        <div>
                            <div style="font-size:20px;font-weight:300;color:var(--text-1);">€{{ number_format($product->price, 0) }}</div>
                            <div style="font-size:11px;color:var(--text-3);margin-top:2px;">{{ $product->user->company_name ?? $product->user->name }}</div>
                        </div>
                        @if($product->reviews->count() > 0)
                        <div style="text-align:right;">
                            <div style="color:var(--amber);font-size:13px;font-weight:500;">★ {{ $product->averageRating() }}</div>
                            <div style="font-size:11px;color:var(--text-3);margin-top:2px;">{{ $product->reviews->count() }} reviews</div>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div style="display:flex;justify-content:center;">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection

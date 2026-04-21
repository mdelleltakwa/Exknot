@extends('layouts.app')
@section('title', 'Browse Services')

@section('content')
<div class="px-8 py-12 max-w-7xl mx-auto">

    <div class="mb-10">
        <h1 style="font-size:32px;font-weight:300;letter-spacing:-0.02em;margin-bottom:6px;">Expert services</h1>
        <p style="color:#8B95A3;">Browse verified B2B consulting, audit and inspection firms worldwide.</p>
    </div>

    {{-- FILTERS --}}
    <form method="GET" action="{{ route('services.index') }}" class="flex gap-3 mb-8 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search services..." class="input-dark" style="max-width:280px;">

        <select name="category" class="input-dark" style="max-width:200px;">
            <option value="">All categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>

        <select name="sort" class="input-dark" style="max-width:180px;">
            <option value="newest" @selected(request('sort') == 'newest')>Newest</option>
            <option value="price_asc" @selected(request('sort') == 'price_asc')>Price ↑</option>
            <option value="price_desc" @selected(request('sort') == 'price_desc')>Price ↓</option>
        </select>

        <button type="submit" class="btn-primary" style="padding:10px 20px;font-size:14px;">Search</button>
        <a href="{{ route('services.index') }}" class="btn-ghost" style="padding:10px 20px;font-size:14px;">Reset</a>
    </form>

    {{-- GRID --}}
    @if($products->isEmpty())
        <div class="text-center py-20" style="color:#8B95A3;">
            <div style="font-size:48px;margin-bottom:16px;">🔍</div>
            <p>No services found. Try adjusting your search.</p>
        </div>
    @else
        <div class="grid grid-cols-3 gap-4 mb-8">
            @foreach($products as $product)
            <a href="{{ route('services.show', $product) }}" class="card-dark p-6 block hover:border-opacity-30 transition-all" style="hover:border-color:rgba(29,158,117,.3);">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}"
                        style="width:100%;height:160px;object-fit:cover;border-radius:8px;margin-bottom:16px;">
                @else
                    <div style="width:100%;height:120px;background:rgba(29,158,117,.06);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#1D9E75" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
                    </div>
                @endif

                <span class="badge-teal" style="margin-bottom:10px;display:inline-block;">{{ $product->category->name }}</span>

                <h3 style="font-size:15px;font-weight:500;color:#E8EDF2;margin-bottom:6px;line-height:1.4;">{{ $product->title }}</h3>
                <p style="font-size:13px;color:#8B95A3;line-height:1.5;margin-bottom:16px;">{{ Str::limit($product->description, 100) }}</p>

                <div class="flex items-center justify-between">
                    <div>
                        <div style="font-size:18px;font-weight:500;color:#E8EDF2;">€{{ number_format($product->price, 0) }}</div>
                        <div style="font-size:11px;color:#8B95A3;">{{ $product->user->company_name ?? $product->user->name }}</div>
                    </div>
                    @if($product->reviews->count() > 0)
                    <div style="text-align:right;">
                        <div style="color:#EF9F27;font-size:13px;font-weight:500;">★ {{ $product->averageRating() }}</div>
                        <div style="font-size:11px;color:#8B95A3;">{{ $product->reviews->count() }} reviews</div>
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        {{ $products->links() }}
    @endif
</div>
@endsection

@extends('layouts.app')
@section('title', 'Publish a service')

@section('content')
<div class="px-8 py-12 max-w-2xl mx-auto">
    <h1 style="font-size:28px;font-weight:300;letter-spacing:-0.02em;margin-bottom:24px;">Publish a new service</h1>

    <form method="POST" action="{{ route('firm.services.store') }}" enctype="multipart/form-data" class="card-dark p-8">
        @csrf

        <div class="mb-5">
            <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Service title *</label>
            <input type="text" name="title" value="{{ old('title') }}" class="input-dark" placeholder="e.g. M&A Due Diligence — Full Scope" required>
            @error('title')<p style="color:#F09595;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div class="mb-5">
            <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Category *</label>
            <select name="category_id" class="input-dark" required>
                <option value="">Select a category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')<p style="color:#F09595;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div class="mb-5">
            <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Description *</label>
            <textarea name="description" rows="5" class="input-dark" placeholder="Describe your service in detail..." required>{{ old('description') }}</textarea>
            @error('description')<p style="color:#F09595;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div class="mb-5">
            <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Price (€) *</label>
            <input type="number" name="price" value="{{ old('price') }}" class="input-dark" placeholder="0.00" min="0" step="0.01" required style="max-width:200px;">
            @error('price')<p style="color:#F09595;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div class="mb-8">
            <label style="font-size:13px;color:#8B95A3;display:block;margin-bottom:6px;">Image (optional)</label>
            <input type="file" name="image" accept="image/*" class="input-dark" style="padding:8px;">
            @error('image')<p style="color:#F09595;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Publish service</button>
            <a href="{{ route('firm.dashboard') }}" class="btn-ghost">Cancel</a>
        </div>
    </form>
</div>
@endsection

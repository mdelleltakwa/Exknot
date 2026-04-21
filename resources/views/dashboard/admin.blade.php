@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="px-8 py-12 max-w-6xl mx-auto">

    <div class="mb-10">
        <h1 style="font-size:28px;font-weight:300;letter-spacing:-0.02em;">Admin Dashboard</h1>
        <p style="color:#8B95A3;margin-top:4px;">Platform overview — Exknot</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-3 gap-4 mb-10">
        @foreach([
            ['Total users', $stats['users'], null],
            ['Expert firms', $stats['firms'], 'teal'],
            ['Clients', $stats['clients'], null],
            ['Services', $stats['products'], null],
            ['Total orders', $stats['orders'], null],
            ['Pending orders', $stats['pending'], 'amber'],
        ] as [$label, $value, $color])
        <div style="background:#111620;border-radius:10px;padding:20px 24px;">
            <div style="font-size:12px;color:#8B95A3;margin-bottom:6px;">{{ $label }}</div>
            <div style="font-size:26px;font-weight:300;color:{{ $color === 'teal' ? '#1D9E75' : ($color === 'amber' ? '#EF9F27' : '#E8EDF2') }};">{{ $value }}</div>
        </div>
        @endforeach
    </div>

    {{-- Users management --}}
    <div class="card-dark p-6 mb-6">
        <h2 style="font-size:16px;font-weight:500;margin-bottom:16px;">Users management</h2>

        <table style="width:100%;font-size:13px;border-collapse:collapse;">
            <thead>
                <tr style="color:#8B95A3;border-bottom:1px solid rgba(255,255,255,.06);">
                    <th style="padding:8px 0;text-align:left;font-weight:400;">Name</th>
                    <th style="padding:8px 0;text-align:left;font-weight:400;">Email</th>
                    <th style="padding:8px 0;text-align:left;font-weight:400;">Role</th>
                    <th style="padding:8px 0;text-align:left;font-weight:400;">Joined</th>
                    <th style="padding:8px 0;text-align:left;font-weight:400;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="border-bottom:1px solid rgba(255,255,255,.04);">
                    <td style="padding:10px 0;color:#E8EDF2;">{{ $user->name }}</td>
                    <td style="padding:10px 0;color:#8B95A3;">{{ $user->email }}</td>
                    <td style="padding:10px 0;">
                        <form method="POST" action="{{ route('admin.users.role', $user) }}" class="inline">
                            @csrf @method('PATCH')
                            <select name="role" onchange="this.form.submit()" class="input-dark" style="font-size:11px;padding:3px 8px;max-width:100px;">
                                @foreach(['client','firm','admin'] as $r)
                                    <option value="{{ $r }}" @selected($user->role === $r)>{{ ucfirst($r) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td style="padding:10px 0;color:#8B95A3;">{{ $user->created_at->format('M d, Y') }}</td>
                    <td style="padding:10px 0;">
                        @if(auth()->id() !== $user->id)
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete user?')" style="font-size:12px;color:#F09595;">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>

</div>
@endsection

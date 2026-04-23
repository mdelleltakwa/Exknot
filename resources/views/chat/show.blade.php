@extends('layouts.app')
@section('title', 'Chat — ' . $otherParty->name)

@section('content')
<div style="display:flex;height:calc(100vh - 65px);overflow:hidden;">

    {{-- ═══ LEFT: CONVERSATION LIST ═══ --}}
    <aside style="width:300px;border-right:1px solid rgba(255,255,255,0.06);background:rgba(255,255,255,0.015);display:flex;flex-direction:column;flex-shrink:0;">
        {{-- Header --}}
        <div style="padding:20px 18px 14px;border-bottom:1px solid rgba(255,255,255,0.06);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
                <span class="label">Messages</span>
                @php $totalUnread = auth()->user()->unreadMessagesCount(); @endphp
                @if($totalUnread > 0)
                    <span class="badge badge-teal" style="font-size:10px;">{{ $totalUnread }} new</span>
                @endif
            </div>
        </div>

        {{-- Conversation items --}}
        <div style="flex:1;overflow-y:auto;">
            @foreach($conversations as $conv)
            @php
                $other = $conv->otherParty(auth()->user());
                $unread = $conv->unreadCountFor(auth()->id());
                $last = $conv->latestMessage;
                $isActive = $conv->id === $conversation->id;
            @endphp
            <a href="{{ route('chat.show', $conv) }}"
               style="display:flex;align-items:center;gap:12px;padding:14px 18px;text-decoration:none;transition:background 150ms ease;border-left:3px solid {{ $isActive ? 'var(--teal)' : 'transparent' }};background:{{ $isActive ? 'rgba(0,200,150,0.06)' : 'transparent' }};"
               onmouseover="if(!{{ $isActive ? 'true' : 'false' }})this.style.background='rgba(255,255,255,0.03)'"
               onmouseout="if(!{{ $isActive ? 'true' : 'false' }})this.style.background='transparent'">

                {{-- Avatar --}}
                <div style="width:38px;height:38px;border-radius:12px;background:{{ $isActive ? 'linear-gradient(135deg,rgba(0,200,150,0.3),rgba(0,200,150,0.1))' : 'rgba(255,255,255,0.04)' }};border:1px solid {{ $isActive ? 'rgba(0,200,150,0.25)' : 'rgba(255,255,255,0.06)' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="font-size:11px;font-weight:600;color:{{ $isActive ? 'var(--teal)' : 'var(--text-2)' }};font-family:'JetBrains Mono',monospace;">{{ strtoupper(substr($other->name, 0, 2)) }}</span>
                </div>

                <div style="flex:1;min-width:0;">
                    <div style="font-size:13px;font-weight:{{ $unread > 0 ? '600' : '400' }};color:var(--text-1);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $other->company_name ?? $other->name }}</div>
                    @if($last)
                    <div style="font-size:11px;color:var(--text-3);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:2px;">
                        {{ Str::limit($last->body, 30) }}
                    </div>
                    @endif
                </div>

                @if($unread > 0)
                <span style="background:var(--teal);color:#0A0D12;font-size:9px;font-weight:700;min-width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">{{ $unread }}</span>
                @endif
            </a>
            @endforeach
        </div>
    </aside>

    {{-- ═══ RIGHT: CHAT PANEL ═══ --}}
    <div style="flex:1;display:flex;flex-direction:column;min-width:0;">

        {{-- Chat header --}}
        <div style="padding:16px 28px;border-bottom:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;gap:14px;background:rgba(255,255,255,0.015);flex-shrink:0;">
            <div style="width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,rgba(0,200,150,0.25),rgba(0,200,150,0.08));display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span style="font-size:13px;font-weight:600;color:var(--teal);font-family:'JetBrains Mono',monospace;">{{ strtoupper(substr($otherParty->name, 0, 2)) }}</span>
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-size:15px;font-weight:500;color:var(--text-1);">{{ $otherParty->company_name ?? $otherParty->name }}</div>
                <div style="display:flex;align-items:center;gap:8px;margin-top:2px;">
                    @if($otherParty->isFirm())
                        <span class="badge badge-teal" style="font-size:9px;padding:1px 7px;">Expert Firm</span>
                    @else
                        <span class="badge badge-blue" style="font-size:9px;padding:1px 7px;">Client</span>
                    @endif
                    @if($otherParty->country)
                        <span style="font-size:11px;color:var(--text-3);">{{ $otherParty->country }}</span>
                    @endif
                </div>
            </div>
            <div style="display:flex;gap:6px;">
                <a href="{{ route('chat.index') }}" class="btn-ghost" style="padding:7px 14px;font-size:12px;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="margin-right:4px;"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    All chats
                </a>
            </div>
        </div>

        {{-- Messages area --}}
        <div id="chat-messages" style="flex:1;overflow-y:auto;padding:28px 32px;display:flex;flex-direction:column;gap:6px;">

            @if($messages->isEmpty())
            <div style="flex:1;display:flex;align-items:center;justify-content:center;">
                <div style="text-align:center;">
                    <div style="width:56px;height:56px;border-radius:16px;background:rgba(0,200,150,0.08);border:1px solid rgba(0,200,150,0.15);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="1.5" stroke-linecap="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    </div>
                    <p style="font-size:14px;color:var(--text-2);margin-bottom:4px;">Start the conversation</p>
                    <p style="font-size:12px;color:var(--text-3);">Send a message to {{ $otherParty->company_name ?? $otherParty->name }}</p>
                </div>
            </div>
            @else

            @php $prevDate = null; @endphp
            @foreach($messages as $msg)
                @php $msgDate = $msg->created_at->format('M d, Y'); @endphp
                @if($msgDate !== $prevDate)
                <div style="display:flex;align-items:center;gap:12px;margin:16px 0 8px;" class="chat-date-divider">
                    <div style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></div>
                    <span style="font-size:11px;color:var(--text-3);white-space:nowrap;">{{ $msgDate }}</span>
                    <div style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></div>
                </div>
                @php $prevDate = $msgDate; @endphp
                @endif

                @if($msg->sender_id === auth()->id())
                {{-- My message --}}
                <div class="chat-bubble-wrap" style="display:flex;justify-content:flex-end;align-items:flex-end;gap:8px;" data-msg-id="{{ $msg->id }}">
                    <div style="max-width:65%;display:flex;flex-direction:column;align-items:flex-end;">
                        <div style="background:linear-gradient(135deg,rgba(0,200,150,0.15),rgba(0,200,150,0.08));border:1px solid rgba(0,200,150,0.2);border-radius:16px 16px 4px 16px;padding:12px 16px;font-size:13px;line-height:1.55;color:var(--text-1);">
                            {{ $msg->body }}
                        </div>
                        <span style="font-size:10px;color:var(--text-3);margin-top:4px;padding-right:4px;">{{ $msg->created_at->format('H:i') }}</span>
                    </div>
                </div>
                @else
                {{-- Their message --}}
                <div class="chat-bubble-wrap" style="display:flex;justify-content:flex-start;align-items:flex-end;gap:8px;" data-msg-id="{{ $msg->id }}">
                    <div style="width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <span style="font-size:9px;font-weight:600;color:var(--text-2);font-family:'JetBrains Mono',monospace;">{{ strtoupper(substr($msg->sender->name, 0, 2)) }}</span>
                    </div>
                    <div style="max-width:65%;display:flex;flex-direction:column;align-items:flex-start;">
                        <div style="background:var(--bg-elevated);border:1px solid var(--border);border-radius:16px 16px 16px 4px;padding:12px 16px;font-size:13px;line-height:1.55;color:var(--text-1);">
                            {{ $msg->body }}
                        </div>
                        <span style="font-size:10px;color:var(--text-3);margin-top:4px;padding-left:4px;">{{ $msg->created_at->format('H:i') }}</span>
                    </div>
                </div>
                @endif
            @endforeach
            @endif
        </div>

        {{-- Input bar --}}
        <div style="padding:16px 28px;border-top:1px solid rgba(255,255,255,0.06);background:rgba(255,255,255,0.015);flex-shrink:0;">
            <form method="POST" action="{{ route('chat.store', $conversation) }}" id="chat-form" style="display:flex;gap:10px;align-items:flex-end;">
                @csrf
                <div style="flex:1;position:relative;">
                    <textarea name="body" id="chat-input"
                        placeholder="Type a message..."
                        rows="1"
                        class="input-dark"
                        style="resize:none;min-height:44px;max-height:120px;padding-right:16px;font-size:14px;border-radius:14px;"
                        required></textarea>
                </div>
                <button type="submit" class="btn-primary" style="padding:11px 20px;border-radius:14px;flex-shrink:0;height:44px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="margin-right:4px;"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Send
                </button>
            </form>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatContainer = document.getElementById('chat-messages');
    const chatInput     = document.getElementById('chat-input');
    const chatForm      = document.getElementById('chat-form');
    const convId        = {{ $conversation->id }};
    const myId          = {{ auth()->id() }};
    const pollUrl       = "{{ route('chat.poll', $conversation) }}";
    const csrfToken     = document.querySelector('meta[name="csrf-token"]').content;

    // Auto-scroll to bottom
    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
    scrollToBottom();

    // Auto-resize textarea
    chatInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    // Submit with Enter (Shift+Enter for new line)
    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (this.value.trim()) {
                chatForm.dispatchEvent(new Event('submit', { cancelable: true }));
            }
        }
    });

    // AJAX submit instead of full reload
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const body = chatInput.value.trim();
        if (!body) return;

        // Optimistic insert
        appendMessage({
            id: Date.now(),
            body: escapeHtml(body),
            mine: true,
            initials: '{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}',
            time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit', hour12: false}),
        });
        chatInput.value = '';
        chatInput.style.height = 'auto';
        scrollToBottom();

        // Send to server
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ body: body }),
        }).catch(err => console.error('Send error:', err));
    });

    // Get last known message ID
    function getLastMsgId() {
        const bubbles = chatContainer.querySelectorAll('[data-msg-id]');
        if (bubbles.length === 0) return 0;
        return parseInt(bubbles[bubbles.length - 1].dataset.msgId) || 0;
    }

    // Append a message bubble
    function appendMessage(msg) {
        // Remove empty state if present
        const emptyState = chatContainer.querySelector('[style*="flex:1;display:flex;align-items:center;justify-content:center"]');
        if (emptyState) emptyState.remove();

        const wrap = document.createElement('div');
        wrap.className = 'chat-bubble-wrap';
        wrap.dataset.msgId = msg.id;
        wrap.style.cssText = 'display:flex;align-items:flex-end;gap:8px;animation:msgIn 200ms cubic-bezier(0.16,1,0.3,1);';

        if (msg.mine) {
            wrap.style.justifyContent = 'flex-end';
            wrap.innerHTML = `
                <div style="max-width:65%;display:flex;flex-direction:column;align-items:flex-end;">
                    <div style="background:linear-gradient(135deg,rgba(0,200,150,0.15),rgba(0,200,150,0.08));border:1px solid rgba(0,200,150,0.2);border-radius:16px 16px 4px 16px;padding:12px 16px;font-size:13px;line-height:1.55;color:var(--text-1);">
                        ${msg.body}
                    </div>
                    <span style="font-size:10px;color:var(--text-3);margin-top:4px;padding-right:4px;">${msg.time}</span>
                </div>`;
        } else {
            wrap.style.justifyContent = 'flex-start';
            wrap.innerHTML = `
                <div style="width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="font-size:9px;font-weight:600;color:var(--text-2);font-family:'JetBrains Mono',monospace;">${msg.initials}</span>
                </div>
                <div style="max-width:65%;display:flex;flex-direction:column;align-items:flex-start;">
                    <div style="background:var(--bg-elevated);border:1px solid var(--border);border-radius:16px 16px 16px 4px;padding:12px 16px;font-size:13px;line-height:1.55;color:var(--text-1);">
                        ${msg.body}
                    </div>
                    <span style="font-size:10px;color:var(--text-3);margin-top:4px;padding-left:4px;">${msg.time}</span>
                </div>`;
        }

        chatContainer.appendChild(wrap);
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Poll for new messages
    let polling = true;
    async function pollMessages() {
        if (!polling) return;
        try {
            const lastId = getLastMsgId();
            const res = await fetch(`${pollUrl}?after=${lastId}`, {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            });
            if (res.ok) {
                const data = await res.json();
                const wasAtBottom = chatContainer.scrollHeight - chatContainer.scrollTop - chatContainer.clientHeight < 80;
                data.messages.forEach(msg => {
                    // Skip if already rendered
                    if (chatContainer.querySelector(`[data-msg-id="${msg.id}"]`)) return;
                    // Skip optimistic own messages (they have timestamp-based IDs)
                    if (msg.mine) {
                        // Replace the optimistic bubble with the real one
                        const optimistic = chatContainer.querySelectorAll('[data-msg-id]');
                        for (const el of optimistic) {
                            if (parseInt(el.dataset.msgId) > 1000000000000) {
                                el.dataset.msgId = msg.id;
                                return;
                            }
                        }
                    }
                    appendMessage(msg);
                });
                if (wasAtBottom && data.messages.length > 0) scrollToBottom();
            }
        } catch (e) { /* ignore polling errors */ }
        setTimeout(pollMessages, 5000);
    }
    setTimeout(pollMessages, 5000);

    // Focus input
    chatInput.focus();
});
</script>

<style>
    @keyframes msgIn {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    #chat-messages::-webkit-scrollbar { width: 5px; }
    #chat-messages::-webkit-scrollbar-track { background: transparent; }
    #chat-messages::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 10px; }
    #chat-messages::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.14); }
</style>
@endsection

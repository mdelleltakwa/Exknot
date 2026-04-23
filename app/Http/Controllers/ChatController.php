<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * List all conversations for the current user.
     */
    public function index()
    {
        $user = auth()->user();

        $conversations = Conversation::where('client_id', $user->id)
            ->orWhere('firm_id', $user->id)
            ->with(['client', 'firm', 'latestMessage.sender'])
            ->get()
            ->sortByDesc(fn($c) => $c->latestMessage?->created_at ?? $c->created_at)
            ->values();

        return view('chat.index', compact('conversations'));
    }

    /**
     * Show a conversation thread.
     */
    public function show(Conversation $conversation)
    {
        $user = auth()->user();
        abort_unless($conversation->client_id === $user->id || $conversation->firm_id === $user->id, 403);

        // Mark messages from the other party as read
        $conversation->messages()
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = $conversation->messages()
            ->with('sender')
            ->orderBy('created_at')
            ->get();

        // Load all conversations for sidebar
        $conversations = Conversation::where('client_id', $user->id)
            ->orWhere('firm_id', $user->id)
            ->with(['client', 'firm', 'latestMessage.sender'])
            ->get()
            ->sortByDesc(fn($c) => $c->latestMessage?->created_at ?? $c->created_at)
            ->values();

        $otherParty = $conversation->otherParty($user);

        return view('chat.show', compact('conversation', 'messages', 'conversations', 'otherParty'));
    }

    /**
     * Send a message in a conversation.
     */
    public function store(Request $request, Conversation $conversation)
    {
        $user = auth()->user();
        abort_unless($conversation->client_id === $user->id || $conversation->firm_id === $user->id, 403);

        $request->validate(['body' => 'required|string|max:5000']);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => $user->id,
            'body'            => $request->body,
        ]);

        return redirect()->route('chat.show', $conversation);
    }

    /**
     * AJAX: Poll for new messages since a given ID.
     */
    public function poll(Request $request, Conversation $conversation)
    {
        $user = auth()->user();
        abort_unless($conversation->client_id === $user->id || $conversation->firm_id === $user->id, 403);

        $afterId = $request->query('after', 0);

        // Mark incoming messages as read
        $conversation->messages()
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = $conversation->messages()
            ->with('sender')
            ->where('id', '>', $afterId)
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'id'        => $m->id,
                'body'      => e($m->body),
                'sender_id' => $m->sender_id,
                'sender'    => $m->sender->name,
                'initials'  => strtoupper(substr($m->sender->name, 0, 2)),
                'mine'      => $m->sender_id === $user->id,
                'time'      => $m->created_at->format('H:i'),
                'date'      => $m->created_at->format('M d'),
            ]);

        return response()->json(['messages' => $messages]);
    }

    /**
     * Start or resume a conversation with a firm.
     */
    public function start(User $firm)
    {
        $user = auth()->user();

        // Determine client/firm based on roles
        if ($user->isFirm() && $firm->isClient()) {
            // Firm initiating chat with a client
            $conversation = Conversation::findOrStart($firm->id, $user->id);
        } else {
            // Client (or anyone) initiating chat with a firm
            abort_unless($firm->isFirm(), 404, 'You can only message firms.');
            $conversation = Conversation::findOrStart($user->id, $firm->id);
        }

        return redirect()->route('chat.show', $conversation);
    }
}

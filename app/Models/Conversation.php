<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['client_id', 'firm_id'];

    public function client()   { return $this->belongsTo(User::class, 'client_id'); }
    public function firm()     { return $this->belongsTo(User::class, 'firm_id'); }
    public function messages() { return $this->hasMany(Message::class); }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function otherParty(User $user): User
    {
        return $user->id === $this->client_id ? $this->firm : $this->client;
    }

    public function unreadCountFor(int $userId): int
    {
        return $this->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->count();
    }

    /**
     * Find or create a conversation between a client and a firm.
     */
    public static function findOrStart(int $clientId, int $firmId): self
    {
        return self::firstOrCreate([
            'client_id' => $clientId,
            'firm_id'   => $firmId,
        ]);
    }
}

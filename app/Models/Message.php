<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;
    public function userMessages(): HasMany
    {
        return $this->hasMany(UserMessage::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'user_messages' , 'message_id' , 'sender_id')
            ->withTimestamps();
    }

}

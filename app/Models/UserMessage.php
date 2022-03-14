<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMessage extends Model
{
    use HasFactory;
    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}

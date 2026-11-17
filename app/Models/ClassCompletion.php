<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassCompletion extends Model
{
    protected $fillable = [
        'user_id',
        'google_event_id',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

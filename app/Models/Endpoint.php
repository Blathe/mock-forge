<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endpoint extends Model
{
    /** @use HasFactory<\Database\Factories\EndpointFactory> */
    use HasFactory;

    protected $fillable = [
        'slug',
        'method',
        'user_id',
        'require_auth',
        'auth_token',
        'status_code',
        'delay_ms',
        'is_public',
        'payload',
        'description',
    ];

    protected $casts = [
        'require_auth' => 'boolean',
        'is_public' => 'boolean',
        'status_code' => 'integer',
        'delay_ms' => 'integer',
        'payload' => 'json',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function getVisibility(): string
    {
        return $this->is_public ? 'Active' : 'Disabled';
    }

    public function getVisibilityColor(): string
    {
        return $this->is_public ? 'green' : 'red';
    }

    public function getUrlSuffix(): string
    {
        return "/api/{$this->user_id}/{$this->slug}";
    }

    public function getFullUrl(): string
    {
        $domain = env('APP_URL');
        return url($domain . $this->getUrlSuffix());
    }

    public function getMethodColor(): string
    {
        return match ($this->method) {
            'GET' => 'blue',
            'POST' => 'green',
            'PUT' => 'yellow',
            'DELETE' => 'red',
            default => 'gray',
        };
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function histories(): HasMany {
        return $this->hasMany(EndpointHistory::class);
    }
}

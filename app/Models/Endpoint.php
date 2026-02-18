<?php

namespace App\Models;

use Database\Factories\EndpointFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Endpoint extends Model
{
    /** @use HasFactory<EndpointFactory> */
    use HasFactory, SoftDeletes;

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

    public function getVisibilityLabel(): string
    {
        return $this->is_public ? "Listening" : "Not Listening";
    }

    public function getVisibilityColor(): string
    {
        return $this->is_public ? "green" : "red";
    }

    public function getUrlSuffix(): string
    {
        return "/api/{$this->user_id}/{$this->slug}";
    }

    public function getFullUrl(): string
    {
        $domain = env('APP_URL');
        return url($domain .  $this->getUrlSuffix());
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

    /**
     * Efficiently retrieves the single most recent history record.
     * Use this for eager loading instead of histories()->latest()->first().
     */
    public function latestHistory(): HasOne {
        return $this->hasOne(EndpointHistory::class)->latestOfMany();
    }

    /**
     * The endpoint is expired if it is over 7 days old.
     */
    public function isExpired(): bool {
        return $this->created_at->diffInDays(Carbon::now()) > 7;
    }

    /**
     * Scope for querying expired endpoints in bulk (avoids N+1 vs isExpired()).
     */
    public function scopeExpired($query)
    {
        return $query->where('created_at', '<=', Carbon::now()->subDays(7));
    }
}

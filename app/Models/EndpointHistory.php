<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EndpointHistory extends Model
{
    /** @use HasFactory<\Database\Factories\EndpointHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'endpoint_id',
        'status_code',
        'response_time_ms',
    ];

    protected function responseTimeMs(): Attribute {
        return Attribute::make(
            set: fn($value) => (int) round($value),
        );
    }

    public function endpoint(): BelongsTo {
        return $this->belongsTo(Endpoint::class);
    }
}

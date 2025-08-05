<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EndpointHistory extends Model
{
    /** @use HasFactory<\Database\Factories\EndpointHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'status_code',
        'response_time_ms',
    ];

    public function endpoint(): BelongsTo {
        return $this->belongsTo(Endpoint::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EndpointHistory extends Model
{
    /** @use HasFactory<\Database\Factories\EndpointHistoryFactory> */
    use HasFactory;

    public function endpoint(): BelongsTo {
        return $this->belongsTo(Endpoint::class);
    }
}

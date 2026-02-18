<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add missing indexes:
     *
     * endpoints:
     *   - (user_id, slug)    — every public API hit queries by both columns
     *   - is_public          — used in dashboard active/inactive filtering
     *
     * endpoint_histories:
     *   - (endpoint_id, created_at) — all history queries filter by endpoint
     *                                  and order by date; foreignIdFor() only
     *                                  creates a FK constraint, not an index
     *                                  (especially on SQLite)
     */
    public function up(): void
    {
        Schema::table('endpoints', function (Blueprint $table) {
            $table->index(['user_id', 'slug'], 'endpoints_user_id_slug_index');
            $table->index('is_public', 'endpoints_is_public_index');
        });

        Schema::table('endpoint_histories', function (Blueprint $table) {
            $table->index(['endpoint_id', 'created_at'], 'endpoint_histories_endpoint_id_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('endpoints', function (Blueprint $table) {
            $table->dropIndex('endpoints_user_id_slug_index');
            $table->dropIndex('endpoints_is_public_index');
        });

        Schema::table('endpoint_histories', function (Blueprint $table) {
            $table->dropIndex('endpoint_histories_endpoint_id_created_at_index');
        });
    }
};

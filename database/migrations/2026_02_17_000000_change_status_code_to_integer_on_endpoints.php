<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Change status_code from a restrictive enum([200, 404, 500]) to an
     * unsignedSmallInteger so any valid HTTP status code can be used.
     */
    public function up(): void
    {
        Schema::table('endpoints', function (Blueprint $table) {
            $table->unsignedSmallInteger('status_code')->default(200)->change();
        });
    }

    public function down(): void
    {
        Schema::table('endpoints', function (Blueprint $table) {
            $table->enum('status_code', [200, 404, 500])->default(200)->change();
        });
    }
};

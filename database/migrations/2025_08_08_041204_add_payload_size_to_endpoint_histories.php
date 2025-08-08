<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('endpoint_histories', function (Blueprint $table) {
            $table->integer('payload_size')->nullable()->after('endpoint_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('endpoint_histories', function (Blueprint $table) {
            $table->dropColumn('payload_size');
        });
    }
};

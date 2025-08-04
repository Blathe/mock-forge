<?php

use App\Models\User;
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
        Schema::create('endpoints', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('slug', 255);
            $table->enum('method', ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])
                ->default('GET');
            $table->enum('status_code', [200, 404, 500])
                ->default(200)
                ->comment('HTTP status code to return');
            $table->integer('delay_ms')
                ->default(0)
                ->comment('Delay in milliseconds');
            $table->boolean('is_public')
                ->default(false);
            $table->boolean('require_auth')
                ->default(false)
                ->comment('Require authentication to access this endpoint');
            $table->string('auth_token', 255)
                ->nullable()
                ->comment('Token required for authentication');
            $table->json('payload')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endpoints');
    }
};

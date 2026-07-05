<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_logs', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('campaign_id');

            $table->unsignedBigInteger('platform_id')->nullable();

            $table->string('session_id')->nullable();

            $table->string('ip_address')->nullable();

            $table->string('country')->nullable();

            $table->string('city')->nullable();

            $table->string('device')->nullable();

            $table->string('browser')->nullable();

            $table->string('operating_system')->nullable();

            $table->string('referrer')->nullable();

            $table->boolean('completed')->default(false);

            $table->timestamp('clicked_at')->nullable();

            $table->timestamps();

            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns')
                ->onDelete('cascade');

            $table->foreign('platform_id')
                ->references('id')
                ->on('platforms')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};

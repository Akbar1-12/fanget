<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaign_platform', function (Blueprint $table) {

            $table->id();

            $table->foreignId('campaign_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('platform_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // The actual Spotify/Apple/etc link
            $table->string('destination_url');

            // Enable/disable for this campaign
            $table->boolean('enabled')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_platform');
    }
};

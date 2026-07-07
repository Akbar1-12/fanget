<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->string('song_title');
            $table->string('slug')->unique();
            $table->text('promo')->nullable();
            $table->string('artwork');
            $table->string('youtube_video_id')->nullable();
            $table->string('youtube_channel_url')->nullable();
            $table->string('youtube_button_text')->default('Subscribe');
            $table->string('youtube_button_url')->nullable();
            $table->boolean('show_video')->default(true);
            $table->boolean('autoplay_video')->default(true);
            $table->integer('autoplay_seconds')->default(10);
            $table->date('release_date')->nullable();
            $table->boolean('published')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};

<?php

use App\Models\Video;
use App\Models\Playlist;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('playlist_video', function (Blueprint $table) {
            // по идее тут надо делать пивот как в пивоте видеоКанал, но я так не хочу,
            // при таком подходе надо проверять на уникальность добавленные строки или получишь в джойне дубль
            $table->id();
            $table->foreignIdFor(Playlist::class)->constrained();
            $table->foreignIdFor(Video::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist_video');
    }
};

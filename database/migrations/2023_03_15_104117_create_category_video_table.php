<?php

use App\Models\Category;
use App\Models\Video;

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
        // делаю таблицу пивот для связи категорий и видео
        Schema::create('category_video', function (Blueprint $table) {

            // $table->id();

            // первичный ключ, состоящий из двух столбцов
            $table->primary(['category_id', 'video_id']);

            // создать столбец foreignIdFor и навесить внешний ключ на нее, с id который есть во внешней таблице constrained
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Video::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_video');
    }
};

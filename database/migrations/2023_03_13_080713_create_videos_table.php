<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Channel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();

            # 3 варианта записи внешнего ключа
            //constrained - channel_id только те, которые есть в таблице chennels
            // 1 $table->foreignId('channel_id')->constrained();
            // 2 тоже самое можно написать так
            $table->foreignIdFor(Channel::class)->contrained();
            // 3 old style
            // $table->unsignedBigInteger('channel_id');
            // $table->foreign('channel_id')->references('id')->on('channels');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

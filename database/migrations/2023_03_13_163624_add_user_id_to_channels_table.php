<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // У меня 3 записи в пользователях, та что столбец с внешним ключем добавить нельзя (нельзя, чтобы столбец юзерайди был пустой), поэтому:
        // Временно отключу проверку внешнйх ключей
        Schema::disableForeignKeyConstraints();

        Schema::table('channels', function (Blueprint $table) {
            // after('name') вставить ее после столбца нейм... constrained -> значит сюда можно вставлять только те значения,
            // которые есть в таблице юзеров
            $table->foreignIdFor(User::class)->after('name')->constrained();
        });

        // Включаю проверку внешних ключей
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ::table для альтер модификации таблицы нужен (вместо create)
        Schema::table('channels', function (Blueprint $table) {
            // удаляю столбец ... так как у него есть внешний ключ, то перед удалением столбца снесу внешний ключ
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};

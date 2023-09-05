<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('showtimes', function (Blueprint $table) {
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms');
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('showtimes', function (Blueprint $table) {
            $table->dropForeign('showtimes_room_id_foreign');
            $table->dropForeign('showtimes_movie_id_foreign');
        });
    }
};

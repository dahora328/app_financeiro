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
        Schema::table('lancamentos', function (Blueprint $table){
            $table->unsignedBigInteger('user_id');
        });

        DB::statement('update lancamentos set user_id = 1');

        Schema::table('lancamentos', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lancamentos', function (Blueprint $table){
            $table->dropForeign('lancamentos_user_id_foreign');
        });
        Schema::table('lancamentos', function (Blueprint $table){
            $table->dropColumn('user_id');
        });
    }
};

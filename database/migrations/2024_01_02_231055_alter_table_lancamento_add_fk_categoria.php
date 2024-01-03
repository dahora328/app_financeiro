<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lancamentos', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id');
        });


        DB::statement('update lancamentos set categoria_id = 1');

        //criando fk na tabela
        Schema::table('lancamentos', function (Blueprint $table) {
            $table->foreign('categoria_id')->references('id')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lancamentos', function (Blueprint $table){
            $table->dropForeign('lancamentos_categoria_id_foreign');
        });
        Schema::table('lancamentos', function (Blueprint $table) {
            $table->dropColumn('categoria_id');
        });
    }
};

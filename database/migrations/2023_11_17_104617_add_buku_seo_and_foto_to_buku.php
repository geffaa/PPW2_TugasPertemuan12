<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->string('buku_seo')->nullable(); 
            $table->string('foto')->nullable(); 
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn('buku_seo');
            $table->dropColumn('foto');
        });
    }
};

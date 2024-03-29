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
        Schema::create('fdr', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->unsignedBigInteger("id_agency");
            $table->unsignedBigInteger("id_vehicle");
            $table->unsignedBigInteger("id_agent");
            $table->integer("tonnage");
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fdr');
    }
};

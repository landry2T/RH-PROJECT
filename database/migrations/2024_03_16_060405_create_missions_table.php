<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id');
            $table->date('date_depart')->nullable();
            $table->date('date_retour')->nullable();
            $table->string('ville_depart')->nullable();
            $table->string('ville_retour')->nullable();
            $table->string('motif')->nullable();
            $table->float('total_mission')->nullable();
            $table->string('files')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
};

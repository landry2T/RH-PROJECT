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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Fname');
            $table->string('Lname');
            $table->string('sexe');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('adresse');
            $table->integer('poste_id');
            $table->date('date_contrat');
            $table->string('sm');
            $table->string('numero_cnps')->nullable();
            $table->string('numero_compte')->nullable();
            $table->string('mode_pay')->nullable();
            $table->string('nbre_enfant');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('identifiant');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

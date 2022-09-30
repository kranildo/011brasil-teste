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
        //
        Schema::create('carros', function (Blueprint $table) {
            $table->id();
            $table->string('placa')->unique();
            $table->text('marca');
            $table->text('modelo');
            $table->text('ano');
            $table->text('fabricacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('carros');
    }
};
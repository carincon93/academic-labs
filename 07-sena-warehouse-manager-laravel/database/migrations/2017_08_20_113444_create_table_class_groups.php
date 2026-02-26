<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClassGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ficha')->unique()->unsigned();
            $table->string('nombre_ficha', 100);
            $table->string('especialidad', 100)->nullable();
            $table->string('instructor', 100)->nullable();
            $table->integer('instructor_id')->nullable()->unsigned();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_lectiva')->nullable();
            $table->date('fecha_final')->nullable();
            $table->text('horario')->nullable();
            $table->string('tipo_formacion', 91);
            $table->string('disponibilidad', 15)->default('disponible')->nullable();
            $table->foreign('instructor_id')->references('id')->on('instructors');
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
        Schema::dropIfExists('class_groups');
    }
}

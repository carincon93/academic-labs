<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClassrooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_ambiente', 128);
            $table->string('descripcion', 128)->nullable();
            $table->text('centro')->nullable();
            $table->string('tipo_ambiente', 64);
            $table->string('movilidad', 15);
            $table->string('estado', 15)->default('activo');
            $table->integer('cupo');
            $table->string('imagen', 191)->default('/images/sin_foto.png')->nullable();
            $table->string('disponibilidad', 15)->default('disponible')->nullable();
            $table->dateTime('prestado_en')->nullable();
            $table->integer('instructor_id')->nullable()->unsigned();
            $table->foreign('instructor_id')->references('id')->on('instructors');
            $table->integer('class_group_id')->nullable()->unsigned();
            $table->foreign('class_group_id')->references('id')->on('class_groups');
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
        Schema::dropIfExists('classrooms');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInstructors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 64);
            $table->string('apellidos', 64);
            $table->string('especialidad', 64)->nullable();
            $table->string('vinculacion1', 100);
            $table->string('tipoplanta', 100)->nullable();
            $table->string('tipocontrato', 100)->nullable();
            $table->string('cantidadhoras', 100)->nullable();
            $table->string('actadministrativas', 50)->nullable();
            $table->string('area', 128);
            $table->text('centro', 128)->nullable();
            $table->integer('numero_documento')->unique()->unsigned();
            $table->integer('ip')->nullable();
            $table->bigInteger('celular');
            $table->string('email', 64)->unique();
            $table->string('imagen', 191)->default('/images/perdefault.png')->nullable();
            $table->string('disponibilidad', 15)->default('disponible')->nullable();
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
        Schema::dropIfExists('instructors');

    }
}

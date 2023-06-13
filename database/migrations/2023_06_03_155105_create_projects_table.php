<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('objetivo');
            $table->string('color');
            $table->string('image');
            $table->double('monto',8,2);
            $table->text('description');
            $table->text('coordenadas');
            $table->text('ubigeo');

            $table->unsignedBigInteger('continent_id');
            $table->unsignedBigInteger('country_id');
            
            $table->unsignedBigInteger('sector_type_id');

            $table->unsignedBigInteger('sector_id');

            $table->timestamps();

            $table->index('continent_id');
            $table->foreign('continent_id')->references('id')->on('continents')->onDelete('cascade');

            $table->index('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

            $table->index('sector_type_id');
            $table->foreign('sector_type_id')->references('id')->on('sector_types')->onDelete('cascade');

            $table->index('sector_id');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}

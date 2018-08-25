<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->integer('city_id');
            $table->integer('province_id')->unsigned()->nullable();
            $table->string('province');
            $table->string('type');
            $table->string('city_name');
            $table->string('postal_code');
            $table->timestamps();
            $table->primary('city_id');
            $table->foreign('province_id')->on('provinces')->references('province_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cities');
    }
}

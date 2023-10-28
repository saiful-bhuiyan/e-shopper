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
        Schema::create('upazila_informations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('country_informations');
            $table->bigInteger('division_id')->unsigned();
            $table->foreign('division_id')->references('id')->on('division_informations');
            $table->bigInteger('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('district_informations');
            $table->string('upazila_name')->nullable();
            $table->integer('status')->default('1');
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('upazila_informations');
    }
};

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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('division_id')->unsigned();
            $table->foreign('division_id')->references('id')->on('division_informations');
            $table->bigInteger('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('district_informations');
            $table->bigInteger('upazila_id')->unsigned();
            $table->foreign('upazila_id')->references('id')->on('upazila_informations');
            $table->double('charge',10,2)->nullable();
            $table->integer('status')->default(1)->comment('0 = inactive , 1 = active');
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
        Schema::dropIfExists('shippings');
    }
};

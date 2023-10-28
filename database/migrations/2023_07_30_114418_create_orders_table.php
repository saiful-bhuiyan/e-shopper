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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->bigInteger('division_id')->unsigned();
            $table->foreign('division_id')->references('id')->on('division_informations');
            $table->bigInteger('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('district_informations');
            $table->bigInteger('upazila_id')->unsigned();
            $table->foreign('upazila_id')->references('id')->on('upazila_informations');
            $table->string('address')->nullable();
            $table->double('total',11,2)->nullable();
            $table->double('shipping_cost',11,2)->nullable();
            $table->double('cuppon_amount',11,2)->nullable();
            $table->string('payment_method')->nullable();
            $table->integer('status')->default('1');
            $table->integer('guest_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories');
            $table->bigInteger('sub_cat_id')->unsigned();
            $table->foreign('sub_cat_id')->references('id')->on('sub_categories');
            $table->string('product_name_en',250)->nullable();
            $table->string('product_name_bn',250)->nullable();
            $table->double('regular_price',10,2)->nullable();
            $table->double('discount_amount',10,2)->nullable();
            $table->integer('min_quantity')->nullable();
            $table->text('short_details')->nullable();
            $table->longText('description')->nullable();
            $table->longText('information')->nullable();
            $table->integer('status')->default(1)->comment('0= Inactive & 1 = Active');
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
        Schema::dropIfExists('products');
    }
};

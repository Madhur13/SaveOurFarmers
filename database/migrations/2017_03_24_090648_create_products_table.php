<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
                $table->string('name', 100);
                $table->integer('category_id');
                $table->integer('base_price');
                $table->integer('buyer_id')->nullable();
                $table->integer('seller_id');
                $table->integer('winning_price')->nullable();
                $table->integer('quantity');
                $table->date('date');
                $table->time('time');
                $table->timestamps();

                $table->foreign('category_id')->references('id')->on('categories');
                $table->foreign('buyer_id')->references('id')->on('users');
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
}
